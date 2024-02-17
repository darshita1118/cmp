<?php

use App\Models\ApplicationModel;

function getStudentInfo($sid)
{
    $departmentModel = new ApplicationModel('student_info_' . session('year'), 'si_id', 'sso_' . session('suffix'));
    return $departmentModel->where(['sid' => $sid])->first() ?? [];
}
function getDepartments($id = false)
{
    $departmentModel = new ApplicationModel('departments', 'dept_id', 'sso_' . session('suffix'));
    $detail = $departmentModel->select(['dept_id', 'dept_name'])->where(['dept_id' => $id])->first() ?? [];
    return $detail['dept_name'] ?? '';
}

function getProgram($id)
{
    $programModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', 'sso_' . session('suffix'));
    $detail =  $programModel->select(['course_code', 'course_name', 'sc_id as coi_id', 'validation_level', 'course_type', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_delete' => 0])->where(['sc_id' => $id])->first() ?? [];
    return $detail['course_name'] ?? '';
}
function getReligionById($id)
{
    $religionModel = new ApplicationModel('religions', 'r_id', 'sso_' . session('suffix'));
    $detail = $religionModel->select(['r_name', 'r_id'])->where(['r_id' => $id])->first() ?? [];
    return $detail['r_name'] ?? '';
}

function getCasteById($id)
{
    $casteModel = new ApplicationModel('castes', 'cid', 'sso_' . session('suffix'));
    $detail = $casteModel->select(['c_name', 'cid'])->where(['cid' => $id])->first() ?? [];
    return $detail['c_name'] ?? '';
}
function getStudentContact($sid)
{
    $contactModel = new ApplicationModel('student_contact_info_' . session('year'), 'sci_id', 'sso_' . session('suffix'));
    return $contactModel->where(['sid' => $sid])->first() ?? [];
}
function getStudentOther($sid)
{
    $studentOtherModel = new ApplicationModel('student_other_info_' . session('year'), 'soi_id', 'sso_' . session('suffix'));
    return $studentOtherModel->where(['sid' => $sid])->first() ?? [];
}
function getParentInfo($sid)
{
    $departmentModel = new ApplicationModel('student_family_info_' . session('year'), 'sfi_id', 'sso_' . session('suffix'));
    return $departmentModel->where(['sid' => $sid])->first() ?? [];
}
function getAddress($sid)
{
    $studentAdderssModel = new ApplicationModel('student_address_' . session('year'), 'sa_id', 'sso_' . session('suffix'));
    return $studentAdderssModel->join('addresses_' . session('year'), 'addresses_' . session('year') . '.a_id=student_address_' . session('year') . '.address_id')->where(['sid' => $sid])->findAll() ?? [];
}
function getStudentEducation($sid)
{
    $academicModel = new ApplicationModel('student_education_' . session('year'), 'se_id', 'sso_' . session('suffix'));
    $academic = $academicModel->join('education_level', 'education_level.el_id=student_education_' . session('year') . '.education_level')->where('sid', $sid)->orderBy('education_level', 'ASC');
    return $academic->findAll() ?? [];
}
function getStudentDocument($sid)
{
    $academicModel = new ApplicationModel('student_document_' . session('year'), 'sd_id', 'sso_' . session('suffix'));
    $academic = $academicModel->select(['document_type', 'sd_url', 'dt_name', 'sd_id'])->join('document_type', 'document_type.dt_id=student_document_' . session('year') . '.document_type')->where('sd_url!=', '')->where('sid', $sid)->orderBy('document_type', 'ASC');
    return $academic->findAll() ?? [];
}

function getEnrollment($sid)
{
    $departmentModel = new ApplicationModel('student_enrollments', 'sen_id', 'sso_' . session('suffix'));
    return $departmentModel->where(['sid' => $sid])->first() ?? [];
}

function getSpecialization($id)
{
    if ($id == null) {
        return '---';
    }
    $casteModel = new ApplicationModel('specializations', 'sz_id', 'sso_' . session('suffix'));
    $detail = $casteModel->select(['sz_name'])->where(['sz_id' => $id])->first() ?? [];
    return $detail['sz_name'] ?? '--';
}
function getGroup($id)
{
    if ($id == null) {
        return '---';
    }
    $casteModel = new ApplicationModel('stream_groups', 'sg_id', 'sso_' . session('suffix'));
    $detail = $casteModel->select(['sg_name'])->where(['sg_id' => $id])->first() ?? [];
    return $detail['sg_name'] ?? '--';
}
function getStream($id)
{
    if ($id == null) {
        return [];
    }
    $id = json_decode($id, true);
    $casteModel = new ApplicationModel('course_streams', 'cs_id', 'sso_' . session('suffix'));
    $detail = $casteModel->select(['cs_name'])->whereIn('cs_id', $id)->findAll() ?? [];
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
$url = 'sso.gyanvihar.org/';
$photo_key = array_search('1', array_column($student_docs, 'document_type')) ?? '';
$photoUrl = isset($student_docs[$photo_key]) ? $student_docs[$photo_key]['sd_url'] : '//';
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <style>
        .form-control.form-control-solid {
            border: 0;
            border-bottom: 1px solid #000;
            border-radius: 0;
            background: transparent;
            padding: .2rem .2rem;
        }

        .form-control.form-control-solid:focus {
            border: 0 !important;
            border-bottom: 1px solid #000 !important;
            border-radius: 0 !important;
            background: transparent !important;
            padding: .2rem .2rem !important;
        }
    </style>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="flex-row mx-0-fluid">
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">
                    <!--Begin::Header-->
                    <div class="card-header card-header-tabs-line px-2">
                        <div class="card-title">
                            <h1>Your Application under process</h1>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
                                <li class="nav-item mr-2">
                                    <a class="nav-link mx-0" target="_blank" href="<?= base_url('admin/print/' . $lid . '/' . $sid) ?>">
                                        <span class="nav-icon">
                                            <span class="svg-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                        <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="nav-text font-weight-bold">Print Form</span>
                                    </a>
                                </li>
                                <li class="nav-item mr-2">
                                    <a class="nav-link active mx-0" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
                                        <span class="nav-icon">
                                            <span class="svg-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                        <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="nav-text font-weight-bold">Personal</span>
                                    </a>
                                </li>
                                <li class="nav-item mr-2">
                                    <a class="nav-link mx-0" data-toggle="tab" href="#st_academics">
                                        <span class="nav-icon">
                                            <span class="svg-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Devices/Display1.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z" fill="#000000" opacity="0.3"></path>
                                                        <path d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z" fill="#000000"></path>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="nav-text font-weight-bold">Academics</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mx-0" data-toggle="tab" href="#st_document">
                                        <span class="nav-icon">
                                            <span class="svg-icon">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6">
                                                        </circle>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </span>
                                        <span class="nav-text font-weight-bold">Documents</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--Begin::Body-->
                    <div class="card-body px-2 py-4">
                        <div class="tab-content">
                            <!--begin::Tab Content-->
                            <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                                <form class="form">
                                    <!--begin::Heading-->
                                    <div class="row mx-0 my-2">
                                        <div class="col-lg-12">
                                            <h3 class="font-size-h6 mb-5">Student Details:</h3>
                                        </div>
                                    </div>

                                    <!--end::Heading-->
                                    <div class="row mx-0">
                                        <div class="form-group col-lg-2 order-md-1 order-lg-2 order-xl-2">
                                            <label class="">Photo</label>
                                            <div class="col-lg-2 col-xl-2 text-center">
                                                <div class="image-input image-input-outline image-input-circle">
                                                    <div class="image-input-wrapper" style="background-image: url('//<?= $url . substr($photoUrl, 1) ?>')">
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 row mx-0 order-md-2 order-lg-1 order-xl-1">
                                            <div class="form-group col-lg-4">
                                                <label for="name">Name:</label>
                                                <input disabled type="text" id="name" name="name" class="form-control form-control-solid" value="<?= ucwords(trim($sidInfo['si_first_name'] . ' ' . $sidInfo['si_middle_name'] . ' ' . $sidInfo['si_last_name'])); ?>" placeholder="Name" required="">

                                            </div>

                                            <div class="form-group col-lg-4">
                                                <label for="">Mobile No.</label>
                                                <input disabled type="text" class="form-control form-control-lg form-control-solid px-2" value="<?= $contact['sci_country_code']; ?>-<?= $contact['sci_mobile']; ?>" placeholder="Mobile No." required="">


                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="email">Email
                                                </label>


                                                <input disabled type="text" class="form-control form-control-lg form-control-solid px-2" id="email" name="email" value="<?= $contact['sci_email']; ?>" placeholder="Email" required="">


                                            </div>

                                            <div class="form-group col-lg-4">
                                                <label for="gender">Gender:</label>
                                                <input disabled type="text" id="gender" name="gender" class="form-control form-control-solid" value="<?php if ($other['gender'] == 0) echo 'Male'; ?><?php if ($other['gender'] == 1) echo 'Female'; ?><?php if ($other['gender'] == 2) echo 'Other'; ?>" placeholder="Gender" required="">

                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="dob">Date Of Birth:</label>
                                                <input disabled type="text" id="dob" name="dob" class="form-control form-control-solid" placeholder="<?= $other['dob']; ?>" required="">

                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="cat">Category:</label>
                                                <input disabled type="text" id="cat" name="cat" class="form-control form-control-solid" placeholder="Category" value="<?= getCasteById($other['caste_id']) ?>" required="">

                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="religion">Religions:</label>
                                                <input disabled type="text" id="religion" name="religion" class="form-control form-control-solid" placeholder="Religions" value="<?= getReligionById($other['religion_id']); ?>" required="">

                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label for="religion">Aadhar No.:</label>
                                                <input disabled type="text" id="aadhar" name="aadhar" class="form-control form-control-solid" value="<?= $other['aadhar']; ?>" required="">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mx-0 my-2">
                                        <div class="col-lg-12">
                                            <h3 class="font-size-h6 mb-5">Program and Enrollment Details:</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 row mx-0 order-md-2">
                                        <div class="form-group col-lg-3">
                                            <label for="sid">Sid</label>
                                            <input readonly type="text" id="sid" name="sid" class="form-control form-control-solid" value="<?php
                                                                                                                                            echo $sid;
                                                                                                                                            ?>" placeholder="SID" required="">

                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="name">Enrollment No.</label>
                                            <input readonly type="text" id="name" name="name" class="form-control form-control-solid" value="<?php
                                                                                                                                                if (!empty($enrollment)) {
                                                                                                                                                    if ($enrollment['sen_status'] == 2) {
                                                                                                                                                        echo 'PRO';
                                                                                                                                                    }
                                                                                                                                                    echo $enrollment['enrollment_no'];
                                                                                                                                                } else {
                                                                                                                                                    echo 'Pending';
                                                                                                                                                }
                                                                                                                                                ?>" placeholder="Name" required="">

                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="program">Program:</label>
                                            <input readonly type="text" id="program" name="program" class="form-control form-control-solid" placeholder="Program name" value="<?= getProgram($sidInfo['program_id']); ?>" required="">

                                        </div>
                                        <div class="form-group col-xl-3">

                                            <label for="course_type"><?php if ($sidInfo['si_course_nature'] == 1) echo 'Stream';
                                                                        elseif ($sidInfo['si_course_nature'] == 2) echo 'Subjects';
                                                                        elseif ($sidInfo['si_course_nature'] == 3) echo 'Specialization';
                                                                        else echo "Stream/Group/Specailization"; ?></label>
                                            <input type="text" class="form-control form-control-solid" disabled value="<?php if ($sidInfo['si_course_nature'] == 1) : echo getGroup($sidInfo['si_stream_group']);
                                                                                                                        elseif ($sidInfo['si_course_nature'] == 2) : $stream = getStream($sidInfo['si_stream_group']);
                                                                                                                            echo !empty($stream) ? implode(',', array_column($stream, 'cs_name')) : 'Stream Not Selected Yet';
                                                                                                                        elseif ($sidInfo['si_course_nature'] == 3) : echo getSpecialization($sidInfo['si_stream_group']);
                                                                                                                        else : echo "Not Selected Yet";
                                                                                                                        endif; ?>">

                                        </div>
                                    </div>
                                    <div class="row mx-0 my-2">
                                        <div class="col-lg-12">
                                            <h3 class="font-size-h6 mb-5">Parent's Detail:</h3>
                                        </div>
                                    </div>
                                    <div class="row mx-0">

                                        <div class="form-group col-lg-3">
                                            <label for="father_name">Father Name:</label>
                                            <input disabled type="text" id="father_name" name="father_name" class="form-control form-control-solid" value="<?= $parentDetail['father_name']; ?>" placeholder="Father Name">

                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="mother_name">Mother Name:</label>
                                            <input disabled type="text" id="mother_name" name="mother_name" class="form-control form-control-solid" value="<?= $parentDetail['mother_name']; ?>" placeholder="Father Name">

                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="parent_mobile">Parent's Mobile:</label>
                                            <input disabled type="text" id="parent_mobile" name="parent_mobile" class="form-control form-control-solid" value="<?= $parentDetail['parent_mobile']; ?>" placeholder="Parent's Mobile">

                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="parent_email">Parent's Email:</label>
                                            <input disabled type="text" id="parent_email" name="parent_email" class="form-control form-control-solid" value="<?= $parentDetail['parent_email']; ?>" placeholder="Parent's Mobile">

                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="father_income">Father's Annual Income:</label>
                                            <input disabled type="text" id="father_income" name="father_income" class="form-control form-control-solid" value="<?= $parentDetail['father_income']; ?>" placeholder="Father's Annual Income">

                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="mother_income">Mother's Annual Income:</label>
                                            <input disabled type="text" id="mother_income" name="mother_income" class="form-control form-control-solid" value="<?= $parentDetail['mother_income']; ?>" placeholder="Mother's Annual Income">

                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="landline">Landline No.:</label>
                                            <input disabled type="text" id="landline" name="landline" class="form-control form-control-solid" value="<?= $other['landline']; ?>" placeholder="Landline No.">

                                        </div>
                                    </div>
                                    <?php $i = 0;
                                    foreach ($address as $row) : ?>
                                        <div class="row mx-0 my-2">
                                            <div class="col-lg-12">
                                                <h3 class="font-size-h6 mb-5">
                                                    <?php if (count($address) < 2) {
                                                        echo 'Permanent and Current';
                                                    } else {
                                                        if ($i == 1) echo 'Permanent';
                                                        else echo 'Current';
                                                    } ?>
                                                    Address:
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="row mx-0">
                                            <div class="col-lg-5">
                                                <div class="form-group mb-4">
                                                    <label>Street Name</label>
                                                    <input disabled type="text" class="form-control form-control-solid form-control-lg" name="street_address" value="<?= $row['street_address']; ?>" placeholder="House or Flat No, Street Name/Village Name" />
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group mb-4">
                                                    <label>Country</label>
                                                    <input disabled type="text" class="form-control form-control-solid form-control-lg" name="country" value="<?= $row['country']; ?>" placeholder="Country" />
                                                </div>
                                            </div>


                                            <div class="col-lg-2">
                                                <!--begin::Select-->
                                                <div class="form-group mb-4">
                                                    <label>State</label>
                                                    <input disabled type="text" id="state" name="state" value="<?= $row['state']; ?>" class="form-control form-control-solid form-control-lg" placeholder="State">
                                                </div>
                                                <!--end::Select-->
                                            </div>
                                            <div class="col-lg-2">
                                                <!--begin::Select-->
                                                <div class="form-group mb-4">
                                                    <label>District</label>
                                                    <input disabled type="text" id="district" name="district" value="<?= $row['district']; ?>" class="form-control form-control-solid form-control-lg" placeholder="District">
                                                </div>
                                                <!--end::Select-->
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group mb-4">
                                                    <label>Pincode</label>
                                                    <input disabled type="text" class="form-control form-control-solid form-control-lg" name="zipcode" value="<?= $row['zipcode']; ?>" placeholder="Pincode" />
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++;
                                    endforeach; ?>

                                </form>
                            </div>
                            <!--end::Tab Content-->
                            <!--begin::Tab Content-->
                            <div class="tab-pane" id="st_academics" role="tabpanel">
                                <form class="form">
                                    <div class="row mx-0 my-2">
                                        <div class="col-lg-12">

                                            <h3 class="font-size-h6 mb-5">Academic Details:</h3>

                                        </div>
                                    </div>
                                    <div class="row mx-0">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="thead-dark">
                                                        <tr class="" style="width: 100%">
                                                            <th style="width:20%">Class</th>
                                                            <th style="width:20%">Board/University</th>
                                                            <th style="width:20%">Institute/School Name</th>
                                                            <th style="width:10%">Passing Year</th>
                                                            <th style="width:5%">Max Marks</th>
                                                            <th style="width:5%">Obtained Marks</th>
                                                            <th style="width:10%">Result</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($education as $row) : ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $row['el_name']; ?>
                                                                </td>
                                                                <td>
                                                                    <?= $row['board_university']; ?>
                                                                </td>
                                                                <td>
                                                                    <?= $row['institute_school']; ?>
                                                                </td>
                                                                <td>
                                                                    <?= $row['year']; ?>
                                                                </td>
                                                                <td>
                                                                    <?= $row['total_marks']; ?>
                                                                </td>
                                                                <td>
                                                                    <?= $row['obtain_marks']; ?>
                                                                </td>
                                                                <td>
                                                                    <?= $row['grade_precentage']; ?>(
                                                                    <?php if ($row['grade_type'] == 1) echo "Grade";
                                                                    else echo "%"; ?>)
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Tab Content-->
                            <!--begin::Tab Content-->
                            <div class="tab-pane" id="st_document" role="tabpanel">
                                <form class="form">
                                    <div class="row mx-0 my-2">
                                        <div class="col-lg-12">

                                            <h3 class="font-size-h6 mb-5">Uploaded Documents:</h3>

                                        </div>
                                    </div>

                                    <div class="row mx-0 mb-3">
                                        <?php foreach ($student_docs as $student) :
                                            if ($student['sd_url'] == $photoUrl) :
                                                continue;
                                            endif;
                                        ?>
                                            <div class="col-lg-3 my-3">
                                                <h6 class="mb-2 text-center" style="border-bottom: 1px solid #ebedf3;">
                                                    <?= $student['dt_name'] ?>
                                                </h6>
                                                <div class="card">
                                                    <?php if (pathinfo($student['sd_url'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                                        <iframe class="card-img" src="https://docs.google.com/gview?url=<?= $url . substr($student['sd_url'], '1') ?>&embedded=true"></iframe>
                                                    <?php else : ?>
                                                        <a href="//<?= $url . substr($student['sd_url'], '1') ?>"><img class="card-img" src="//<?= $url . substr($student['sd_url'], '1') ?>" alt=""></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </form>
                            </div>
                            <!--end::Tab Content-->

                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>