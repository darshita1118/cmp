<?php 
use App\Models\ApplicationModel;
function getStudentInfo($sid)
{
    $departmentModel = new ApplicationModel('student_info_'.session('year'),'si_id', 'sso_'.session('suffix'));
    return $departmentModel->where(['sid'=>$sid])->first()??[];
}
function getDepartments($id=false)
{
    $departmentModel = new ApplicationModel('departments','dept_id', 'sso_'.session('suffix'));
    $detail = $departmentModel->select(['dept_id','dept_name'])->where(['dept_id'=>$id])->first()??[];
    return $detail['dept_name']??'';
}

function getProgram($id)
{
    $programModel = new ApplicationModel('session_courses_'.session('year'), 'sc_id', 'sso_' . session('suffix'));
    $detail =  $programModel->select(['course_code','course_name','sc_id as coi_id','validation_level','course_type','dept_id','level_id'])->join('course_info', 'course_info.coi_id=session_courses_'. session('year') . '.course_id')->where(['sc_course_delete'=>0])->where(['sc_id'=>$id])->first()??[];
    return $detail['course_name']??'';
}
function getReligionById($id)
{
    $religionModel = new ApplicationModel('religions','r_id', 'sso_'.session('suffix'));
    $detail = $religionModel->select(['r_name','r_id'])->where(['r_id'=>$id])->first()??[];
    return $detail['r_name']??'';
    
}

function getCasteById($id)
{
    $casteModel = new ApplicationModel('castes','cid', 'sso_'.session('suffix'));
    $detail = $casteModel->select(['c_name','cid'])->where(['cid'=>$id])->first()??[];
    return $detail['c_name']??'';
}
function getStudentContact($sid)
{
    $contactModel = new ApplicationModel('student_contact_info_'.session('year'),'sci_id', 'sso_'.session('suffix'));
    return $contactModel->where(['sid'=>$sid])->first()??[];
}
function getStudentOther($sid)
{
    $studentOtherModel = new ApplicationModel('student_other_info_'.session('year'),'soi_id', 'sso_'.session('suffix'));
    return $studentOtherModel->where(['sid'=>$sid])->first()??[];
}
function getParentInfo($sid)
{
    $departmentModel = new ApplicationModel('student_family_info_'.session('year'),'sfi_id', 'sso_'.session('suffix'));
    return $departmentModel->where(['sid'=>$sid])->first()??[];
}
function getAddress($sid)
{
    $studentAdderssModel = new ApplicationModel('student_address_' . session('year'), 'sa_id', 'sso_' . session('suffix'));
    return $studentAdderssModel->join('addresses_' . session('year'), 'addresses_' . session('year') . '.a_id=student_address_' . session('year') . '.address_id')->where(['sid' => $sid])->findAll() ?? [];
}
function getStudentEducation($sid)
{
    $academicModel = new ApplicationModel('student_education_' . session('year'), 'se_id', 'sso_' . session('suffix'));
    $academic = $academicModel->join('education_level', 'education_level.el_id=student_education_'.session('year').'.education_level')->where('sid', $sid)->orderBy('education_level', 'ASC');
    return $academic->findAll() ?? [];
}
function getStudentDocument($sid)
{
    $academicModel = new ApplicationModel('student_document_' . session('year'), 'sd_id', 'sso_' . session('suffix'));
    $academic = $academicModel->select(['document_type','sd_url','dt_name','sd_id'])->join('document_type','document_type.dt_id=student_document_' . session('year').'.document_type')->where('sd_url!=','')->where('sid', $sid)->orderBy('document_type', 'ASC');
    return $academic->findAll() ?? [];
}
function getEnrollment($sid)
{
    $departmentModel = new ApplicationModel('student_enrollments','sen_id', 'sso_'.session('suffix'));
    return $departmentModel->where(['sid'=>$sid])->first()??[];
}

function getSpecialization($id)
{
    if($id == null){
        return '---';
    }
    $casteModel = new ApplicationModel('specializations','sz_id', 'sso_'.session('suffix'));
    $detail = $casteModel->select(['sz_name'])->where(['sz_id'=>$id])->first()??[];
    return $detail['sz_name']??'--';
}
function getGroup($id)
{
    if($id == null){
        return '---';
    }
    $casteModel = new ApplicationModel('stream_groups','sg_id', 'sso_'.session('suffix'));
    $detail = $casteModel->select(['sg_name'])->where(['sg_id'=>$id])->first()??[];
    return $detail['sg_name']??'--';
}
function getStream($id)
{
    if($id == null){
        return [];
    }
    $id = json_decode($id, true);
    $casteModel = new ApplicationModel('course_streams','cs_id', 'sso_'.session('suffix'));
    $detail = $casteModel->select(['cs_name'])->whereIn('cs_id',$id)->findAll()??[];
    return $detail;
}

$parentDetail = getParentInfo($sid);
$sidInfo = getStudentInfo($sid);
$enrollment = getEnrollment($sid);
$contact = getStudentContact($sid);
$other = getStudentOther($sid);
$address = getAddress($sid);
$education = getStudentEducation($sid);
$student_docs = getStudentDocument($sid);
$url = '//sso.gyanvihar.org/';
$photo_key = array_search('1', array_column($student_docs, 'document_type'))??'';
$photoUrl = isset($student_docs[$photo_key])?$student_docs[$photo_key]['sd_url']:'//';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $sid ?>
    </title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/global/plugins.bundle.css">
    <style>
        tr {
            line-height: 22px !important;
        }
    </style>

</head>

<body>
    <script type="text/javascript">
        function PrintDiv() {
            var divContents = document.getElementById("form_print").innerHTML;
            var printWindow = window.open();
            printWindow.document.write('<html><head><title><?= $sid ?></title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

    <div width="800px" align="center" id="form_print">
        <table cellpadding="0" cellspacing="0" width="800px" align="center">
            <tbody>
                <tr>
                    <td align="center">
                        <img src="<?= base_url() ?>/assets/media/logos/sgvu-distance.png" style=" height: 65px; width: 190px; ">
                    </td>
                </tr>
                <tr>
                    <td>
                        <font color="#000000"><b>Program Details</b></font>
                        <hr>
                        <table cellpadding="0" cellspacing="0" width="100%" class="">
                            <tbody>
                                <tr>
                                    <td width="70%" valign="top">
                                        <table cellpadding="0" cellspacing="0" width="100%">
                                            <tbody>
                                                <tr style="line-height:35px">
                                                    <td width="40%"><strong>Session</strong></td>
                                                    <td width="60%">
                                                        <?php if (!empty($enrollment)) {
                                                          echo (substr($enrollment['enrollment_no'],9,1)=='1')?'July-':'January-';
                                                        }?><?=session('year') ?>
                                                    </td>
                                                </tr>
                                                <tr style="line-height:35px">
                                                    <td width="40%"><strong>SID</strong></td>
                                                    <td width="60%">
                                                        <?= $sid ?>
                                                    </td>
                                                </tr>
                                                 <tr style="line-height:35px">
                                                    <td width="40%"><strong>Medium</strong></td>
                                                    <td width="60%">
                                                        <?= ($sidInfo['medium'] == '0') ? 'English' : (($sidInfo['medium'] == '1') ? 'Hindi' : null) ?>
                                                    </td>
                                                </tr>
                                                <tr style="line-height:35px">
                                                    <td width="40%">
                                                        <strong>Program</strong>
                                                    </td>
                                                    <td width="60%">
                                                        <?= getProgram($sidInfo['program_id']); ?>
                                                    </td>
                                                </tr>
                                                <tr style="line-height:35px">
                                                    <td width="40%">
                                                        <strong><?php if ($sidInfo['si_course_nature']== 1) echo 'Stream'; elseif ($sidInfo['si_course_nature'] == 2) echo 'Subjects'; elseif($sidInfo['si_course_nature'] == 3) echo 'Specialization'; else echo "Stream/Group/Specailization"; ?></strong>
                                                    </td>
                                                    <td width="60%">
                                                        <?php if($sidInfo['si_course_nature']== 1): echo getGroup($sidInfo['si_stream_group']); elseif($sidInfo['si_course_nature']== 2): $stream = getStream($sidInfo['si_stream_group']); echo !empty($stream)?implode(', ',array_column($stream, 'cs_name')):'Stream Not Selected Yet'; elseif($sidInfo['si_course_nature']== 3): echo getSpecialization($sidInfo['si_stream_group']);  else: echo "Not Selected Yet"; endif; ?>
                                                    </td>
                                                </tr>
                                                <tr style="line-height:35px">
                                                    <td width="40%"><strong>Enrollment No.</strong></td>
                                                    <td width="60%">
                                                        <?php
                                                        if (!empty($enrollment)) {
                                                            if ($enrollment['sen_status'] == 2) {
                                                                echo 'PRO';
                                                            }
                                                            echo $enrollment['enrollment_no'];
                                                        } else {
                                                            echo 'Pending';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </td>
                                    <td width="30%" align="right"> <img id="ContentPlaceHolder2_Image1" src="//<?= $url.substr($photoUrl,1) ?>" style="height:130px;width:130px; padding:4px; background:#E9E9E9" class="img-rounded"></td>
                                </tr>

                            </tbody>
                        </table>

                    </td>
                </tr>

                <tr>
                    <td style="padding-top:25px">
                        <font color="#000000"><b>Student's Details</b></font>
                        <hr>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr style="line-height:35px">
                                    <td width="20%"><strong>Name</strong></td>
                                    <td width="30%">
                                    <?= ucwords(trim($sidInfo['si_first_name'].' '.$sidInfo['si_middle_name'].' '.$sidInfo['si_last_name'])); ?>
                                    </td>
                                    <td width="20%"><strong>Gender</strong></td>
                                    <td width="30%">
                                        <?php if ($other['gender'] == 0) echo 'Male'; ?>
                                        <?php if ($other['gender'] == 1) echo 'Female'; ?>
                                        <?php if ($other['gender'] == 2) echo 'Other'; ?>
                                    </td>
                                </tr>
                                <tr style="line-height:35px">
                                    <td width="20%"><strong>Date of Birth</strong></td>
                                    <td width="30%">
                                    <?= $other['dob']; ?> <small>(dd/mm/yyyy)</small>
                                    </td>
                                    <td width="20%"><strong>Religion</strong></td>
                                    <td width="30%">
                                    <?= getReligionById($other['religion_id']); ?>
                                    </td>
                                </tr>
                                <tr style="line-height:35px">
                                    <td width="20%"><strong>Category</strong></td>
                                    <td width="30%">
                                        <?= getCasteById($other['caste_id']) ?>
                                    </td>
                                    <td width="20%"><strong>Mobile No.</strong></td>
                                    <td width="30%">
                                        <?= $contact['sci_country_code']; ?>-<?= $contact['sci_mobile']; ?>
                                    </td>
                                </tr>
                                <tr style="line-height:35px">

                                    <td width="20%"><strong>Email Id</strong></td>
                                    <td width="30%">
                                        <?= $contact['sci_email']; ?>
                                    </td>
                                    <td width="20%"><strong>Aadhar No.</strong></td>
                                    <td width="30%">
                                        <?= $other['aadhar']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top:25px">
                        <font color="#000000"><b>Parent's Details</b></font>
                        <hr>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr style="line-height:35px">
                                    <td width="20%"><strong>Father's Name</strong></td>
                                    <td width="30%">
                                        <?= $parentDetail['father_name']; ?>
                                    </td>
                                    <td width="20%"><strong>Mother's Name</strong></td>
                                    <td width="30%">
                                        <?= $parentDetail['mother_name']; ?>
                                    </td>
                                </tr>
                                <tr style="line-height:35px">
                                    <td width="20%"><strong>Father's Occupation</strong></td>
                                    <td width="30%">
                                        <?= $parentDetail['father_occupation']; ?>
                                    </td>
                                    <td width="20%"><strong>Mother's Occupation</strong></td>
                                    <td width="30%">
                                        <?= $parentDetail['mother_occupation']; ?>
                                    </td>
                                </tr>
                                <tr style="line-height:35px">
                                    <td width="20%"><strong>Father's Annual Income</strong></td>
                                    <td width="30%">
                                        <?= $parentDetail['father_income']; ?>
                                    </td>
                                    <td width="20%"><strong>Mother's Annual Income</strong></td>
                                    <td width="30%">
                                        <?=$parentDetail['mother_income']; ?>
                                    </td>
                                </tr>
                                <tr style="line-height:35px">
                                    <td width="20%"><strong>Parent's Mobile No.</strong></td>
                                    <td width="30%">
                                        <?= $parentDetail['parent_mobile']; ?>
                                    </td>
                                    <td width="20%"><strong>Parent's Email Id</strong></td>
                                    <td width="30%">
                                        <?= $parentDetail['parent_email']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <?php $i = 0;
                foreach ($address as $row) : ?>
                    <tr>
                        <td style="padding-top:25px">
                            <font color="#000000"><b>
                                    <?php if (count($address) < 2) {
                                        echo 'Permanent and Current';
                                    } else {
                                        if ($row['address_type'] == 0) echo 'Permanent';
                                        else echo 'Current';
                                    } ?>
                                    Address
                                </b></font>
                            <hr>
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr style="line-height:35px">
                                        <td width="20%"><strong>Address</strong></td>
                                        <td width="30%">
                                            <?= $row['street_address']; ?>
                                        </td>
                                        <td width="20%"><strong>District</strong></td>
                                        <td width="30%">
                                            <?= $row['district']; ?>
                                        </td>
                                    </tr>
                                    <tr style="line-height:35px">
                                        <td width="20%"><strong>State</strong></td>
                                        <td width="30%">
                                            <?= $row['state']; ?>
                                        </td>
                                        <td width="20%"><strong>Pincode </strong></td>
                                        <td width="30%">
                                            <?= $row['zipcode']; ?>
                                        </td>
                                    </tr>
                                    <tr style="line-height:35px">
                                        <td width="20%"><strong>Country</strong></td>
                                        <td width="30%">
                                            <?= $row['country']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php $i++;
                endforeach; ?>

                <tr>
                    <td style="padding-top:25px">
                        <font color="#000000"><b>Academic Details</b></font>
                        <hr>
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr height="35" bgcolor="#f5f5f5">

                                    <td width="15%" style="border:1px #000000 solid; padding:5px">
                                        <strong>Class</strong>
                                    </td>
                                    <td width="20%" style="border:1px #000000 solid; padding:5px">
                                        <strong>Board/University</strong>
                                    </td>
                                    <td width="20%" style="border:1px #000000 solid; padding:5px">
                                        <strong>Institute/School Name</strong>
                                    </td>
                                    <td width="10%" style="border:1px #000000 solid; padding:5px"><strong>Passing
                                            Year</strong></td>
                                    <td width="10%" style="border:1px #000000 solid; padding:5px"><strong>Max Marks</strong>
                                    </td>
                                    <td width="10%" style="border:1px #000000 solid; padding:5px"><strong>Obtained
                                            Marks</strong></td>
                                    <td width="15%" style="border:1px #000000 solid; padding:5px">
                                        <strong>Result</strong>

                                </tr>
                                <?php foreach ($education as $edrow) : ?>
                                    <tr height="35">
                                        <td style="border:1px #000000 solid; padding:5px">
                                            <?= @$edrow['el_name']; ?>
                                        </td>
                                        <td style="border:1px #000000 solid; padding:5px">
                                            <?= @$edrow['board_university']; ?>
                                        </td>
                                        <td style="border:1px #000000 solid; padding:5px">
                                            <?= @$edrow['institute_school']; ?>
                                        </td>
                                        <td style="border:1px #000000 solid; padding:5px">
                                            <?= @$edrow['year']; ?>
                                        </td>
                                        <td style="border:1px #000000 solid; padding:5px">
                                            <?= @$edrow['total_marks']; ?>
                                        </td>
                                        <td style="border:1px #000000 solid; padding:5px">
                                            <?= @$edrow['obtain_marks']; ?>
                                        </td>
                                        <td style="border:1px #000000 solid; padding:5px">
                                            <?= @$edrow['grade_precentage']; ?>
                                            <?php if ($edrow['grade_type'] == 1) echo "(Grade)";
                                            else echo "%"; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>


                            </tbody>
                        </table>
                    </td>
                </tr>




                <tr>
                    <td style="padding-top:25px" class="dontprint">
                        <font color="#000000"><b>Documents</b></font>
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table>
                            <tr>
                                <?php foreach ($student_docs as $student) : ?>
                                    <td align="center">
                                        <small><b>
                                                <?= $student['dt_name'] ?>
                                            </b></small><br>
                                        <?php if (pathinfo($student['sd_url'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                            <a style="text-decoration:none" href="//<?= $url.substr($student['sd_url'],'1') ?>"><img src="<?= base_url() ?>/assets/media/logos/icon-pdf.png" height="120" width="120" class="img-rounded"></a>
                                        <?php else : ?>
                                            <img src="//<?= $url.substr($student['sd_url'],'1') ?>" height="120" width="120" class="img-rounded">
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>

                        </table>
                    </td>
                </tr>


            </tbody>
        </table>
    </div>
    <div align="center" style="margin-top: 10px;">
        <button style="color: #fff; background-color: #3699ff; border-color: #3699ff;padding: .65rem 1rem; font-size: 1rem; line-height: 1.5;outline: 0!important;transition: color .15s ease,background-color .15s ease,border-color .15s ease,box-shadow .15s ease,-webkit-box-shadow .15s ease;border: 0; border-radius: 5px;" type="button" onclick="PrintDiv()">Print Form</button>
    </div>

</body>

</html>