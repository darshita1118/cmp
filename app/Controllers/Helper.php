<?php

namespace App\Controllers;

use App\Models\ApplicationModel;
use CodeIgniter\API\ResponseTrait;


class Helper extends BaseController
{
    use ResponseTrait;
    protected $ssoDb;
    protected $lmsDb;
    function __construct()
    {
        $this->ssoDb = SSODB . session('suffix');
        $this->lmsDb = CMPDB . '_' . session('suffix');
    }
    public function get_program_by_dept($dept = false)
    {

        if ($this->request->isAJAX() || $dept !== false) {
            $dept = $dept !== false ? $dept : $this->request->getVar('deptm');
            $suffix = session('suffix') ?? '2021_25';
            $year = session('year') ?? '2022';
            $programModel = new ApplicationModel('session_courses_' . $year, 'sc_id', $this->ssoDb);
            $data = [
                'isOk' => false,
            ];
            $getProgram = $programModel->select(['sc_id as id', 'course_name as name', 'course_code', 'level_id', 'course_nature'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['dept_id' => $dept, 'course_delete_status' => 0, 'sc_course_delete' => 0, 'sc_course_status' => 1])->findAll();
            if ($getProgram) {
                $data['isOk'] = true;
                $data['data'] = $getProgram;
            } else {
                $data['error'] = 'There may no Program is Added to this Department';
            }
            //return 'Hi';
            return $this->respond($data, 200);
        }

        return redirect()->to('/');
    }

    public function getInfoForm($statusType = false)
    {
        $validType = ['1', '2'];
        if ($statusType === false || in_array($statusType, $validType) === false) {
            return 'Something Went Wrong';
        }
        $data = [];
        $data['type'] = $statusType;
        $data['message'] = $this->request->getVar('m') ?? '';
        $data['time'] = $this->request->getVar('t') ?? '';
        $data['date'] = $this->request->getVar('d') ?? '';
        return view('ajax/getinfo', $data);
    }

    public function getInfoFormProfile($statusType = false)
    {
        $validType = ['1', '2'];
        if ($statusType === false || in_array($statusType, $validType) === false) {
            return 'Something Went Wrong';
        }
        $data = [];
        $data['type'] = $statusType;
        $data['message'] = $this->request->getVar('m') ?? '';
        $data['time'] = $this->request->getVar('t') ?? '';
        $data['date'] = $this->request->getVar('d') ?? '';
        return view('ajax/getinfoProfile', $data);
    }
    public function getTeamLeaderList()
    {
        if (!session('isLoggedInAdmin')) {
            return 'Something Went Wrong';
        }
        $data = [];
        $handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);

        $data['teamLeaders'] = $handlerModel->select(['lu_id', 'user_name'])->where('user_deleted_status', 0)->where('user_role', 1)->where(['user_report_to' => session('id')])->findAll();
        return view('ajax/team-list', $data);
    }

    public function countrySelect()
    {

        $data = [];
        $data['type'] = $this->request->getVar('country') == 'India' ? 1 : 0;
        $data['dist'] = $this->request->getVar('dist') ?? '';
        return view('ajax/country', $data);
    }

    public function getHandler()
    {
        if (!session('isLoggedInAdmin')) {
            return 'Something Went Wrong';
        }
        $data = [];
        $handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);

        $data['handlers'] = $handlerModel->select(['lu_id', 'user_name'])->where('user_deleted_status', 0)->whereIn('user_role', [0, 1])->where(['user_report_to' => session('id')])->findAll();
        return view('ajax/handler-list-single-allocation', $data);
    }

    public function roastr()
    {
        if (!session('isLoggedInAdmin')) {
            return 'Something Went Wrong';
        }
        $data = [];
        $option = $this->request->getVar('option') ?? '';
        if ($option == 'group') {
        } else if ($option == 'team') {
            $handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);

            $data['teamLeaders'] = $handlerModel->select(['lu_id', 'user_name'])->where('user_deleted_status', 0)->where('user_role', 1)->where(['user_report_to' => session('id')])->findAll();
        } else if ($option == 'specific-persons') {
            $handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', SETTINGDB);
            $data['handlers'] = $handlerModel->select(['lu_id', 'user_name'])->where('user_deleted_status', 0)->where('user_role', 0)->where(['user_report_to' => session('id')])->findAll();
        }



        $data['option'] = $option;

        return view('ajax/roastr', $data);
    }

    public function index($slug)
    {
        return $slug;
    }

    public function course_natures()
    {
        if ($this->request->isAJAX()) {
            $data = [];
            $data['year'] = session('current')['s2'] ?? session('year');
            $data['session'] = session('current')['s1'] ?? 'sso_' . session('suffix');
            $data['nature'] = $this->request->getVar('nature') ?? '';
            $data['default'] = $this->request->getVar('default') ?? '';
            $data['courseId'] = $this->request->getVar('course') ?? '';
            return view('ajax/select-apply-now', $data);
        }
        return "Something went Wrong";
    }
}
