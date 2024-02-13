<?php

namespace App\Controllers;

use App\Models\ApplicationModel;
use CodeIgniter\Database\BaseBuilder;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends BaseController
{
    protected $ssoDb;
    protected $lmsDb;
    function __construct()
    {
        $this->ssoDb = SSODB . session('suffix');
        $this->lmsDb = CMPDB . '_' . session('suffix');
    }

    public function index()
    {
        if (!session('isLoggedInAdmin')) {
            return redirect()->to('/super-login');
        }
        $handlersModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
        $handlers = $handlersModel->select('lu_id')->where('user_report_to', session('id'))->Orwhere('lu_id', session('id'))->findAll() ?? [];
        $handlers = array_column($handlers, 'lu_id') ?? [];
        $data = [];
        $enrollmentModel =  new ApplicationModel('student_enrollments', 'sen_id', $this->ssoDb);
        /*
        $model = new ApplicationModel('lms_db_reference_'.session('year'), 'lr_id', $this->ssoDb);
        
        $modelLists = $model->select(['sid'])->where(['admin_type'=>session('db_priffix')])->findAll();
        */
        $sidModel = new ApplicationModel('student_login_' . session('year'), 'sl_id', $this->ssoDb);

        $data = $sidModel->select(['student_login_' . session('year') . '.sid', 'password', 'sl_session', 'form_step', 'admisn_status', "CONCAT(si_first_name,' ',si_middle_name,' ',si_last_name) as name", 'program_id', 'student_info_' . session('year') . '.dept_id', 'si_course_level', 'yy', 'sci_mobile', 'sci_email', 'sci_country_code', 'father_name', 'mother_name', 'parent_mobile', 'dob', 'sl_created_at', 'user_name', 'user_mobile', 'course_full_name', 'fs_name'])
            ->join('lms_db_reference_' . session('year'), 'lms_db_reference_' . session('year') . '.sid=student_login_' . session('year') . '.sid')
            ->join('form_steps', 'student_login_' . session('year') . '.form_step=form_steps.position', 'left')
            ->join('reg_setting_db.lms_users_' . session('year'), 'reg_setting_db.lms_users_' . session('year') . '.lu_id=lms_db_reference_' . session('year') . '.handler_id')
            ->join('student_info_' . session('year'), 'student_info_' . session('year') . '.sid=student_login_' . session('year') . '.sid')
            ->join('student_family_info_' . session('year'), 'student_family_info_' . session('year') . '.sid=student_login_' . session('year') . '.sid')
            ->join('student_other_info_' . session('year'), 'student_other_info_' . session('year') . '.sid=student_login_' . session('year') . '.sid')
            ->join('student_contact_info_' . session('year'), 'student_contact_info_' . session('year') . '.sid=student_login_' . session('year') . '.sid')
            ->join('session_courses_' . session('year'), 'session_courses_' . session('year') . '.sc_id=student_info_' . session('year') . '.program_id')
            ->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')
            ->join($this->lmsDB . '.lead_profile_' . session('year'), $this->lmsDB . '.lead_profile_' . session('year') . '.lid=lms_db_reference_' . session('year') . '.lead_id');
        /*
	$data = $sidModel->select(['student_login_'.session('year').'.sid','password','sl_session','form_step','admisn_status',"CONCAT(si_first_name,' ',si_middle_name,' ',si_last_name) as name",'program_id','student_info_'.session('year').'.dept_id','si_course_level','yy','sci_mobile','sci_email','sci_country_code','father_name','mother_name','parent_mobile','dob', 'sl_created_at', 'user_name','user_mobile', 'course_full_name'])
        ->join('lms_db_reference_'.session('year'), 'student_login_'.session('year').'.sid=lms_db_reference_'.session('year').'.sid')
        ->join('reg_setting_db.lms_users_'.session('year'), 'lms_db_reference_'.session('year').'.handler_id=reg_setting_db.lms_users_'.session('year').'.lu_id')
        ->join('student_info_'.session('year'), 'student_login_'.session('year').'.sid=student_info_'.session('year').'.sid', "left")
        ->join('student_family_info_'.session('year'), 'student_login_'.session('year').'.sid=student_family_info_'.session('year').'.sid', "left")
        ->join('student_other_info_'.session('year'), 'student_login_'.session('year').'.sid=student_other_info_'.session('year').'.sid', "left")
        ->join('student_contact_info_'.session('year'), 'student_login_'.session('year').'.sid=student_contact_info_'.session('year').'.sid', "left")
        ->join('session_courses_'.session('year'), 'student_info_'.session('year').'.program_id=session_courses_'.session('year').'.sc_id', "left")
        ->join('course_info', 'session_courses_'.session('year').'.course_id=course_info.coi_id', "left")
        ->join($this->lmsDB.'.lead_profile_'.session('year'),'lms_db_reference_'.session('year').'.lead_id='.$this->lmsDB.'.lead_profile_'.session('year').'.lid');
        */
        $whereInSources = $whereInProgram  = $whereDate = $whereInHandler = false;


        if (!empty($_GET['to']) && isset($_GET['to'])) {
            $whereDate['sl_created_at<'] = date('Y-m-d H:i:s', strtotime($_GET['to'] . ' 23:59:59'));
        }
        if (!empty($_GET['from']) && isset($_GET['from'])) {
            $whereDate['sl_created_at>'] = date('Y-m-d H:i:s', strtotime($_GET['from'] . ' 00:00:00'));
        }

        if (array_filter($_GET['handlers'] ?? []) != []  && isset($_GET['handlers'])) {
            $whereInHandler = $_GET['handlers'] ?? [];
            $data = $data->whereIn('lu_id', $whereInHandler);
        }

        if (array_filter($_GET['source'] ?? []) != []  && isset($_GET['source'])) {
            $whereInSources = $_GET['source'] ?? [];
            $data = $data->whereIn('lead_source', $whereInSources);
        }

        if (array_filter($_GET['program'] ?? []) != []  && isset($_GET['program'])) {
            $whereInProgram = $_GET['program'] ?? [];
            $data = $data->whereIn('program_id', $whereInProgram);
        }

        if (!empty($_GET['mobile']) && isset($_GET['mobile']))
            $whereDate['lead_mobile'] = $_GET['mobile'];

        if ($whereDate)
            $data = $data->where($whereDate);
        $data = $data->where(['sci_delete_status!=' => 1, 'lead_delete_status' => '0'])->whereIn('lu_id', $handlers)->orderBy('student_login_' . session('year') . '.sid', 'DESC')->findAll();


        if (empty($data)) {
            session()->setFlashdata('toastr', ['error' => "Data Not available"]);
            return redirect()->back();
        }

        $fileName = 'assets/data.xls';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'S.No.');
        $sheet->setCellValue('B1', 'Session');
        $sheet->setCellValue('C1', 'Sid');
        $sheet->setCellValue('D1', 'Password');
        $sheet->setCellValue('E1', 'Handler Name');
        $sheet->setCellValue('F1', 'Handler Mobile');
        $sheet->setCellValue('G1', 'Student Name');
        $sheet->setCellValue('H1', 'Father Name');

        $sheet->setCellValue('I1', 'Mother Name');
        $sheet->setCellValue('J1', 'Date Of Birth');

        $sheet->setCellValue('K1', 'Course');
        $sheet->setCellValue('L1', 'Specialization');
        $sheet->setCellValue('M1', 'Semester');
        $sheet->setCellValue('N1', 'Email');
        $sheet->setCellValue('O1', 'Mobile');
        $sheet->setCellValue('P1', 'Application Form Status');
        $sheet->setCellValue('Q1', 'Admission Status');
        $sheet->setCellValue('R1', 'Enrollement No.');

        $sheet->setCellValue('S1', 'Register Date');

        /*
            $sheet->setCellValue('S1', '');
            $sheet->setCellValue('T1', '');
            $sheet->setCellValue('U1', '');
            $sheet->setCellValue('V1', '');
            $sheet->setCellValue('W1', '');
            $sheet->setCellValue('X1', '');
            $sheet->setCellValue('Y1', '');
            $sheet->setCellValue('Z1', '');
            
            $sheet->setCellValue('AA1', '');
            $sheet->setCellValue('AB1', '');
            $sheet->setCellValue('AC1', '');
            $sheet->setCellValue('AD1', '');
            $sheet->setCellValue('AE1', '');
            $sheet->setCellValue('AF1', '');
            $sheet->setCellValue('AG1', '');
            $sheet->setCellValue('AH1', '');
            $sheet->setCellValue('AI1', '');
            $sheet->setCellValue('AJ1', '');
            $sheet->setCellValue('AK1', '');
            $sheet->setCellValue('AL1', '');
            $sheet->setCellValue('AM1', '');
            $sheet->setCellValue('AN1', '');
            $sheet->setCellValue('AO1', '');
            $sheet->setCellValue('AP1', '');
            $sheet->setCellValue('AQ1', '');
            $sheet->setCellValue('AR1', '');
            $sheet->setCellValue('AS1', '');
            $sheet->setCellValue('AT1', '');
            $sheet->setCellValue('AU1', '');
         
        $formStep = [
            '1'=>'Payment',
            '2'=>'Payment Done and now in Profile Step.',
            '3'=>'Profile Done and now in Academic Step.',
            '4'=>'Academic Step done and Document Upload step.',
            '5'=>'Document Uploaded and now in Review step.',
            '6'=>'Review is Done and now in Scrutinizer Desk.',
            '7'=>'Scutinizer Desk given status Cleared then now go to Senior Desk.',
            '8'=>'Senior Desk given status cleared then go to Finance Desk.',
            '9'=>'Finance Desk cleared status then go to Verify Desk.',
            '10'=>'Verify Desk cleared status then go to Enrollment Desk.',
            '11'=>'Enrollment Desk cleared then your Admission done.',
        ];
        */

        $admissionStatus = [
            'Open For Student.',
            'Application Submited by student.',
            'Application Under Process.',
            'Application Reject by Respected Desk.',
            'Application is a span type given by Respected Desk.',
            'Application Admission process done.'
        ];
        $gender = ['0' => 'Male', '1' => 'Female', '2' => 'Other'];
        $count = 2;
        $sn = 1;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $count, $sn);
            $sheet->setCellValue('B' . $count, $row['sl_session']);
            $sheet->setCellValue('C' . $count, $row['sid']);
            $sheet->setCellValue('D' . $count, base64_decode($row['password']));
            $sheet->setCellValue('E' . $count, $row['user_name']);

            $sheet->setCellValue('F' . $count, $row['user_mobile']);
            $sheet->setCellValue('G' . $count, $row['name']);
            $sheet->setCellValue('H' . $count, $row['father_name']);



            $sheet->setCellValue('I' . $count, $row['mother_name']);
            $sheet->setCellValue('J' . $count, $row['dob']);

            $sheet->setCellValue('K' . $count, $row['course_full_name']);
            $sheet->setCellValue('L' . $count, $row['specialization'] ?? '-');
            $sheet->setCellValue('M' . $count, $row['semester'] ?? '-');
            $sheet->setCellValue('N' . $count, $row['sci_email']);
            $sheet->setCellValue('O' . $count, $row['sci_mobile']);

            $sheet->setCellValue('P' . $count, $row['fs_name']);
            $sheet->setCellValue('Q' . $count, $admissionStatus[$row['admisn_status']]);
            if ($row['admisn_status'] == 5) {
                $enrollmentNo = $enrollmentModel->select(['enrollment_no'])->where(['sid' => $row['sid']])->first();
                $sheet->setCellValue('R' . $count, $enrollmentNo['enrollment_no'] ?? 'N/A');
            } else {
                $sheet->setCellValue('R' . $count, $row['enrollmennt'] ?? 'N/A');
            }


            $sheet->setCellValue('S' . $count, $row['sl_created_at']);
            /*
            $sheet->setCellValue('S'.$count, '');
            $sheet->setCellValue('T'.$count, '');
            $sheet->setCellValue('U'.$count, '');
            $sheet->setCellValue('V'.$count, '');
            $sheet->setCellValue('W'.$count, '');
            $sheet->setCellValue('X'.$count, '');
            $sheet->setCellValue('Y'.$count, '');
            $sheet->setCellValue('Z'.$count, '');
            
            $sheet->setCellValue('AA'.$count, '');
            $sheet->setCellValue('AB'.$count, '');
            
            $sheet->setCellValue('AC'.$count, '');
            $sheet->setCellValue('AD'.$count, '');
            $sheet->setCellValue('AE'.$count, '');
            $sheet->setCellValue('AF'.$count, '');
            $sheet->setCellValue('AG'.$count, '');
            
            $sheet->setCellValue('AH'.$count, '');
            $sheet->setCellValue('AI'.$count, '');
            $sheet->setCellValue('AJ'.$count, '');
            $sheet->setCellValue('AK'.$count, '');
            $sheet->setCellValue('AL'.$count, '');
            
            $sheet->setCellValue('AM'.$count, '');
            $sheet->setCellValue('AN'.$count, '');
            $sheet->setCellValue('AO'.$count, '');
            $sheet->setCellValue('AP'.$count, '');
            $sheet->setCellValue('AQ'.$count, '');
            $sheet->setCellValue('AR'.$count, '');
            $sheet->setCellValue('AS'.$count, '');
            $sheet->setCellValue('AT'.$count, '');
            $sheet->setCellValue('AU'.$count, '');
            */
            $count++;
            $sn++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($fileName);
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($fileName));
        flush();
        readfile($fileName);
        exit;
    }
}
