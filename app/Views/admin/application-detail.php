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
<style>
    input {
        outline: 0;
        border-width: 0 0 2px;
        border-color: blue
    }

    input:focus {
        border-color: green;
        outline: 1px dotted #000
    }

    .profile img {
        width: 50px;
        height: 50px;
        margin-top: -5px;
        margin-bottom: -5px;
        border-radius: 30px;
        margin-right: 10px;
    }

    .form-control:focus {
        border-color: transparent;
        box-shadow: none;
    }
</style>
<!--4. Personal Details -->
<div class="details">
    <div class="card border-0 mb-4 pb-3">
        <div class="card-header bg-none p-3 h3 m-0 d-flex align-items-center justify-content-between">
            <span><i class="fa fa-shopping-bag fa-lg me-2 text-gray text-opacity-50"></i>
                Your Application under process</span>
            <div class="panel panel-inverse panel-with-tabs">
                <div class="panel-heading p-0">
                    <ul class="nav nav-tabs nav-tabs-inverse h6">
                        <li class="nav-item">
                            <a href="#" class="nav-link " onclick="printPage()">Print Form </a>
                        </li>
                        <li class="nav-item">
                            <a href="#nav-tab-1" data-bs-toggle="tab" class="nav-link active">Person Detail</a>
                        </li>
                        <li class="nav-item">
                            <a href="#nav-tab-2" data-bs-toggle="tab" class="nav-link ">Academics</a>
                        </li>
                        <li class="nav-item">
                            <a href="#nav-tab-3" data-bs-toggle="tab" class="nav-link ">Documents</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="profile float-end">
                <img src="<?= base_url('assets/img/user/user-13.jpg') ?>" alt="">
            </div>

        </div>
        <div class=" p-3 panel-body  ">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="nav-tab-1">
                    <div class="student-details">
                        <h4 class="pb-4">Student Details:</h4>
                        <form action="">
                            <div class=" row">
                                <div class="col-md-3 mb-3">

                                    <label class="form-label">Name</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />

                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Mobile No.</label>
                                    <input type="text" class="form-control border-0 border-bottom" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Email:</label>
                                    <input class="form-control border-0 border-bottom" type="email" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Gender:</label>
                                    <input class="form-control border-0 border-bottom" type="type" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">DOB</label>
                                    <input type="text" class="form-control border-0 border-bottom" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Category:</label>
                                    <input class="form-control border-0 border-bottom" type="type" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Religion:</label>
                                    <input class="form-control border-0 border-bottom" type="type" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Citizenship No:</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="program-details">
                        <h4 class="pb-4">Program and Enrollment Details:</h4>
                        <form action="">
                            <div class="row">
                                <div class="col-md-3 mb-3 form-group">
                                    <label class="form-label">Sid</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Enrollment No.</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Program</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Parent's Mobile No.</label>
                                    <input type="text" class="form-control border-0 border-bottom" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="parent-details">
                        <h4 class="pb-4">Parent's Details:</h4>
                        <form action="">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Father's Name</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Mother's Name</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Parent's Email:</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Parent's Mobile No.</label>
                                    <input type="text" class="form-control border-0 border-bottom" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Father's occupation</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class=" col-md-3 mb-3">
                                    <label class="form-label">Father's Annual Income</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class=" col-md-3 mb-3">
                                    <label class="form-label">mother's Annual Income</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class=" col-md-3 mb-3">
                                    <label class="form-label">Landline No.:</label>
                                    <input class="form-control border-0 border-bottom" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="current-address">
                        <h4 class="pb-4">Current Address: </h4>
                        <form action="">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Permanent Address: </label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Country</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">State</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="" class="form-label">District</label>
                                    <input type="text" class="form-control border-0 border-bottom" readonly />
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Pincode</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="permanent-address">
                        <h4 class="pb-4">Permanent-Address </h4>
                        <form action="">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Street Name</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Country</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">State</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="" class="form-label">District</label>
                                    <input type="text" class="form-control border-0 border-bottom" readonly />
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Pincode</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="p-3  tab-content ">
                <div class="tab-pane fade  show" id="nav-tab-2">
                    <div class="student-details">
                        <h4 class="pb-4">Student Details:</h4>
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
                                <tr>
                                    <td>
                                        10th or Equivalent </td>
                                    <td>
                                        garba jahumpa </td>
                                    <td>
                                        garba jahumpa </td>
                                    <td>
                                        2019 </td>
                                    <td>
                                        70 </td>
                                    <td>
                                        70 </td>
                                    <td>
                                        70.00(
                                        %)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        10+2 or Equivalent </td>
                                    <td>
                                        sukuta senior secondary school </td>
                                    <td>
                                        sukuta senior secondary school </td>
                                    <td>
                                        2023 </td>
                                    <td>
                                        70 </td>
                                    <td>
                                        70 </td>
                                    <td>
                                        70.00(
                                        %)
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="p-3 tab-content ">
                <div class=" tab-pane fade show" id="nav-tab-3">
                    <h3>Uploaded Documents: </h3>
                    <div class="d-flex justify-content-between p-4">
                        <div class="h5 text-center">Aadhar Card </div>
                        <div class="h5 text-center">10th or Equivalent Marksheet </div>
                        <div class="h5 text-center">12th or Equivalent Marksheet</div>
                        <div class="h5 text-center">Other 1 </div>
                        <div class="h5 text-center">Signature</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    function printPage() {
        // Trigger the browser's print functionality
        window.print();
    }
</script>