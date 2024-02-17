<?php

use App\Models\ApplicationModel;

$studentInfoModel = new ApplicationModel('student_info_' . session('year'), 'si_id', 'sso_' . session('suffix'));
$sidInfo = $studentInfoModel->where(['sid' => $sid])->first() ?? [];

$contactModel = new ApplicationModel('student_contact_info_' . session('year'), 'sci_id', 'sso_' . session('suffix'));
$contact = $contactModel->where(['sid' => $sid])->first() ?? [];


$studentOtherModel = new ApplicationModel('student_other_info_' . session('year'), 'soi_id', 'sso_' . session('suffix'));
$other = $studentOtherModel->select(['student_other_info_' . session('year') . '.*', 'id_name'])->join('st_id_proof', 'student_other_info_' . session('year') . '.sip_type=st_id_proof.sip_id', 'left')->where(['sid' => $sid])->first() ?? [];


$studentParentModel = new ApplicationModel('student_family_info_' . session('year'), 'sfi_id', 'sso_' . session('suffix'));
$parentDetail = $studentParentModel->where(['sid' => $sid])->first() ?? [];


$studentAdderssModel = new ApplicationModel('student_address_' . session('year'), 'sa_id', 'sso_' . session('suffix'));
$address = $studentAdderssModel->join('addresses_' . session('year'), 'addresses_' . session('year') . '.a_id=student_address_' . session('year') . '.address_id')->where(['sid' => $sid])->findAll() ?? [];


$studentEducationModel = new ApplicationModel('student_education_' . session('year'), 'se_id', 'sso_' . session('suffix'));
$education = $studentEducationModel->join('education_level', 'education_level.el_id=student_education_' . session('year') . '.education_level')->where('sid', $sid)->orderBy('education_level', 'ASC')->findAll() ?? [];



$studentDocumentModel = new ApplicationModel('student_document_' . session('year'), 'sd_id', 'sso_' . session('suffix'));
$student_docs = $studentDocumentModel->select(['document_type', 'sd_url', 'dt_name', 'sd_id'])->join('document_type', 'document_type.dt_id=student_document_' . session('year') . '.document_type')->where('sd_url!=', '')->where('sid', $sid)->orderBy('document_type', 'ASC')->findAll() ?? [];

$studentEnrollment = new ApplicationModel('student_enrollments', 'sen_id', 'sso_' . session('suffix'));
$enrollment = $studentEnrollment->where(['sid' => $sid])->first() ?? [];


$casteModel = new ApplicationModel('castes', 'cid', 'sso_' . session('suffix'));
$detail = $casteModel->select(['c_name', 'cid'])->where(['cid' => $other['caste_id'] ?? ''])->first() ?? [];
$studentCategory = $detail['c_name'] ?? '';

$departmentModel = new ApplicationModel('departments', 'dept_id', 'sso_' . session('suffix'));
$detail = $departmentModel->select(['dept_id', 'dept_name'])->where(['dept_id' => $sidInfo['dept_id'] ?? ''])->first() ?? [];
$studentDepartment = $detail['dept_name'] ?? '';

$programModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', 'sso_' . session('suffix'));
$detail =  $programModel->select(['course_code', 'course_name', 'sc_id as coi_id', 'validation_level', 'course_type', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_delete' => 0])->where(['sc_id' => $sidInfo['program_id'] ?? ''])->first() ?? [];
$studentProgram = $detail['course_name'] ?? '';

$religionModel = new ApplicationModel('religions', 'r_id', 'sso_' . session('suffix'));
$detail = $religionModel->select(['r_name', 'r_id'])->where(['r_id' => $other['religion_id'] ?? ''])->first() ?? [];
$studentReligion = $detail['r_name'] ?? '';


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
                            <a href="<?= base_url($controller . '/' . 'print/' . $lid . '/' . $sid) ?>" class="nav-link " onclick="printPage()">Print Form </a>
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
                <img src="<?= base_url('assets/img/user/user-1.jpg') ?>" alt="">
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
                                    <input class="form-control border-0 border-bottom" type="text" id="name" name="name" readonly value="<?= ucwords(trim(($sidInfo['si_first_name'] ?? '') . ' ' . ($sidInfo['si_middle_name'] ?? '') . ' ' . ($sidInfo['si_last_name'] ?? ''))); ?>" placeholder="Name" required="" />

                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Mobile No.</label>
                                    <input type="text" class="form-control border-0 border-bottom" readonly value="<?= $contact['sci_country_code'] ?? ''; ?>-<?= $contact['sci_mobile'] ?? ''; ?>" placeholder="Mobile No." required="" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Email:</label>
                                    <input class="form-control border-0 border-bottom" type="email" readonly id="email" name="email" value="<?= $contact['sci_email'] ?? ''; ?>" placeholder="Email" required="" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Gender:</label>
                                    <input class="form-control border-0 border-bottom" type="type" readonly id="gender" name="gender" class="form-control form-control-solid" value="<?php if (($other['gender'] ?? '') == 0) echo 'Male'; ?><?php if (($other['gender'] ?? '') == 1) echo 'Female'; ?><?php if (($other['gender'] ?? '') == 2) echo 'Other'; ?>" placeholder="Gender" required="" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">DOB</label>
                                    <input type="text" class="form-control border-0 border-bottom" readonly id="dob" name="dob" value="<?= $other['dob'] ?? ''; ?>" required="" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Category:</label>
                                    <input class="form-control border-0 border-bottom" id="cat" name="cat" type="type" readonly placeholder="Category" value="<?= $studentCategory ?>" required="" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Religion:</label>
                                    <input class="form-control border-0 border-bottom" type="type" id="religion" name="religion" readonly value="<?= $studentReligion; ?>" required="" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label"><?= $other['id_name'] ?? '' ?>:</label>
                                    <input class="form-control border-0 border-bottom" type="text" readonly id="aadhar" name="aadhar" value="<?= $other['sip_no'] ?? ''; ?>" required="" />
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
                                    <input class="form-control border-0 border-bottom" type="text" id="sid" name="sid" readonly value="<?php echo $sid; ?>" placeholder="SID" required="" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Enrollment No.</label>
                                    <input class="form-control border-0 border-bottom" id="name" name="name" type="text" readonly value="<?php if (!empty($enrollment)) {
                                                                                                                                                if ($enrollment['sen_status'] == 2) {
                                                                                                                                                    echo 'PRO';
                                                                                                                                                }
                                                                                                                                                echo $enrollment['enrollment_no'] ?? '';
                                                                                                                                            } else {
                                                                                                                                                echo 'Pending';
                                                                                                                                            }
                                                                                                                                            ?>" required="" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Program</label>
                                    <input class="form-control border-0 border-bottom" id="program" name="program" type="text" readonly placeholder="Program name" value="<?= $studentProgram; ?>" required="" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="course_type"><?php if ($sidInfo['si_course_nature'] == 1) echo 'Stream';
                                                                                elseif ($sidInfo['si_course_nature'] == 2) echo 'Subjects';
                                                                                elseif ($sidInfo['si_course_nature'] == 3) echo 'Specialization';
                                                                                else echo "Stream/Group/Specailization"; ?></label>
                                    <input type="text" class="form-control border-0 border-bottom" value="<?php if ($sidInfo['si_course_nature'] == 1) : echo getGroup($sidInfo['si_stream_group']);
                                                                                                            elseif ($sidInfo['si_course_nature'] == 2) : $stream = getStream($sidInfo['si_stream_group']);
                                                                                                                echo !empty($stream) ? implode(',', array_column($stream, 'cs_name')) : 'Stream Not Selected Yet';
                                                                                                            elseif ($sidInfo['si_course_nature'] == 3) : echo getSpecialization($sidInfo['si_stream_group']);
                                                                                                            else : echo "Not Selected Yet";
                                                                                                            endif; ?>" />
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
                                    <input class="form-control border-0 border-bottom" type="text" readonly id="father_name" name="father_name" value="<?= $parentDetail['father_name'] ?? ''; ?>" placeholder="Father Name" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Mother's Name</label>
                                    <input class="form-control border-0 border-bottom" type="text" id="mother_name" name="mother_name" readonly value="<?= $parentDetail['mother_name'] ?? ''; ?>" placeholder="Father Name" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Parent's Email:</label>
                                    <input class="form-control border-0 border-bottom" type="text" id="parent_email" name="parent_email" readonly value="<?= $parentDetail['parent_email'] ?? ''; ?>" placeholder="Parent's Mobile" />
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="" class="form-label">Parent's Mobile No.</label>
                                    <input type="text" id="parent_mobile" name="parent_mobile" class="form-control border-0 border-bottom" readonly value="<?= $parentDetail['parent_mobile'] ?? ''; ?>" placeholder="Parent's Mobile" />
                                </div>
                                <div class=" col-md-3 mb-3">
                                    <label class="form-label">Father's Annual Income</label>
                                    <input class="form-control border-0 border-bottom" type="text" id="father_income" name="father_income" readonly value="<?= $parentDetail['father_income'] ?? ''; ?>" placeholder="Father's Annual Income" />
                                </div>
                                <div class=" col-md-3 mb-3">
                                    <label class="form-label">mother's Annual Income</label>
                                    <input class="form-control border-0 border-bottom" type="text" id="mother_income" name="mother_income" readonly value="<?= $parentDetail['mother_income'] ?? ''; ?>" placeholder="Mother's Annual Income" />
                                </div>
                                <div class=" col-md-3 mb-3">
                                    <label class="form-label">Landline No.:</label>
                                    <input class="form-control border-0 border-bottom" id="landline" name="landline" value="<?= $other['landline'] ?? ''; ?>" placeholder="Landline No." />
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php $i = 0;
                    foreach ($address as $row) : ?>
                        <div class="current-address">
                            <h4 class="pb-4"> <?php if (count($address) < 2) {
                                                    echo 'Permanent and Current';
                                                } else {
                                                    if ($i == 1) echo 'Permanent';
                                                    else echo 'Current';
                                                } ?> Address: </h4>
                            <form action="">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Street Name: </label>
                                        <input class="form-control border-0 border-bottom" type="text" readonly name="street_address" value="<?= $row['street_address'] ?? ''; ?>" placeholder="House or Flat No, Street Name/Village Name" />
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Country</label>
                                        <input class="form-control border-0 border-bottom" type="text" readonly name="country" value="<?= $row['country'] ?? ''; ?>" placeholder="Country" />
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">State</label>
                                        <input class="form-control border-0 border-bottom" type="text" readonly id="state" name="state" value="<?= $row['state'] ?? ''; ?>" />
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="" class="form-label">District</label>
                                        <input type="text" class="form-control border-0 border-bottom" readonly id="district" name="district" value="<?= $row['district'] ?? ''; ?>" />
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Pincode</label>
                                        <input class="form-control border-0 border-bottom" type="text" readonly name="zipcode" value="<?= $row['zipcode'] ?? ''; ?>" />
                                    </div>
                                </div>
                            <?php $i++;
                        endforeach; ?>
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
                                <?php foreach ($education as $row) : ?>
                                    <tr>
                                        <td>
                                            <?= $row['el_name'] ?? ''; ?>
                                        </td>
                                        <td>
                                            <?= $row['board_university'] ?? ''; ?>
                                        </td>
                                        <td>
                                            <?= $row['institute_school'] ?? ''; ?>
                                        </td>
                                        <td>
                                            <?= $row['year'] ?? ''; ?>
                                        </td>
                                        <td>
                                            <?= $row['total_marks'] ?? ''; ?>
                                        </td>
                                        <td>
                                            <?= $row['obtain_marks'] ?? ''; ?>
                                        </td>
                                        <td>
                                            <?= $row['grade_precentage'] ?? ''; ?>(
                                            <?php if ($row['grade_type'] ?? '' == 1) echo "Grade";
                                            else echo "%"; ?>)
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="p-3 tab-content ">

                <div class=" tab-pane fade show" id="nav-tab-3">
                    <h3>Uploaded Documents: </h3>

                    <div class="d-flex justify-content-between p-4">
                        <?php foreach ($student_docs as $student) :
                            if ($student['sd_url'] == $photoUrl) :
                                continue;
                            endif;
                        ?>
                            <div class="h5 text-center">
                                <h6><?= $student['dt_name'] ?></h6>
                                <?php if (pathinfo($student['sd_url'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                    <iframe class="card-img" src="https://docs.google.com/gview?url=<?= $url . substr($student['sd_url'] ?? './', '1') ?>&embedded=true"></iframe>
                                <?php else : ?>
                                    <a href="//<?= $url . substr($student['sd_url'] ?? './', '1') ?>" target="_blank"><img class="card-img" src="//<?= $url . substr($student['sd_url'] ?? './', '1') ?>"></a>
                                <?php endif; ?>
                            </div>

                        <?php endforeach; ?>
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