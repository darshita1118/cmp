<?php

use App\Models\ApplicationModel;

$studentInfoModel = new ApplicationModel('student_info_' . session('year'), 'si_id', 'sso_' . session('suffix'));
$sidInfo = $studentInfoModel->where(['sid' => $sid])->first() ?? [];

$contactModel = new ApplicationModel('student_contact_info_' . session('year'), 'sci_id', 'sso_' . session('suffix'));
$contact = $contactModel->where(['sid' => $sid])->first() ?? [];

$studentOtherModel = new ApplicationModel('student_other_info_' . session('year'), 'soi_id', 'sso_' . session('suffix'));
$other = $studentOtherModel->where(['sid' => $sid])->first() ?? [];

$studentParentModel = new ApplicationModel('student_family_info_' . session('year'), 'sfi_id', 'sso_' . session('suffix'));
$parentDetail = $studentParentModel->where(['sid' => $sid])->first() ?? [];

$studentAdderssModel = new ApplicationModel('student_address_' . session('year'), 'sa_id', 'sso_' . session('suffix'));
$address = $studentAdderssModel->join('addresses_' . session('year'), 'addresses_' . session('year') . '.a_id=student_address_' . session('year') . '.address_id')->where(['sid' => $sid])->findAll() ?? [];


$studentEducationModel = new ApplicationModel('student_education_' . session('year'), 'se_id', 'sso_' . session('suffix'));
$education = $studentEducationModel->join('education_level', 'education_level.el_id=student_education_' . session('year') . '.education_level')->where('sid', $sid)->orderBy('education_level', 'ASC')->findAll() ?? [];


$studentDocumentModel = new ApplicationModel('student_document_' . session('year'), 'sd_id', 'sso_' . session('suffix'));
$student_docs = $studentDocumentModel->select(['document_type', 'sd_url', 'dt_name', 'sd_id'])->join('document_type', 'document_type.dt_id=student_document_' . session('year') . '.document_type')->where('sd_url!=', '')->where('sid', $sid)->orderBy('document_type', 'ASC')->findAll() ?? [];

$departmentModel = new ApplicationModel('departments', 'dept_id', 'sso_' . session('suffix'));
$detail = $departmentModel->select(['dept_id', 'dept_name'])->where(['dept_id' => $sidInfo['dept_id'] ?? ''])->first() ?? [];
$studentDepartment = $detail['dept_name'] ?? '';

$programModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', 'sso_' . session('suffix'));
$detail =  $programModel->select(['course_code', 'course_name', 'sc_id as coi_id', 'validation_level', 'course_type', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_delete' => 0])->where(['sc_id' => $sidInfo['program_id'] ?? ''])->first() ?? [];
$studentProgram = $detail['course_name'] ?? '';

$religionModel = new ApplicationModel('religions', 'r_id', 'sso_' . session('suffix'));
$detail = $religionModel->select(['r_name', 'r_id'])->where(['r_id' => $other['religion_id'] ?? ''])->first() ?? [];
$studentReligion = $detail['r_name'] ?? '';

$casteModel = new ApplicationModel('castes', 'cid', 'sso_' . session('suffix'));
$detail = $casteModel->select(['c_name', 'cid'])->where(['cid' => $other['caste_id'] ?? ''])->first() ?? [];
$studentCaste = $detail['c_name'] ?? '';

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

$previousPositionKey  = array_search($currentPosition - 1, array_column($formSteps, 'position'));
$previous = $formSteps[$previousPositionKey ?? '']['slug'] ?? '';

$url = '//sso.gyanvihar.org/';
?>
<div id="upload" class="mb-4 pb-3 pb-3 form-step active show">
    <div class="card border-0">
        <div class="card-header bg-none p-3 h3 m-0 d-flex align-items-center">
            <i class="fa fa-credit-card fa-lg me-2 text-gray text-opacity-50"></i>
            7. Review Your Application
        </div>
        <!--begin::Wizard Step 1-->
        <div class="px-4 py-2">
            <div class="form" id="review_form">

                <!--begin::Wizard Step 1-->
                <div class="pb-5">
                    <div class="d-flex">
                        <h3 class=" font-weight-bold text-left text-success">Program Details:</h3>
                        <div class="ml-auto" style="cursor: pointer;"><a href="<?= base_url($route . $lid . '/' . $sid . '/profile') ?>"><i class="flaticon-edit icon-lg text-primary"></i></a></div>
                    </div>

                    <hr class="my-3" style="border-top: 1px solid #000;">
                    <div class="row">
                        <div class="col-xl-2">
                            <div class="form-group mb-4">
                                <label for="Medium">Medium</label>
                                <input disabled type="text" id="medium" class="form-control" name="medium" value="<?= (($sidInfo['medium'] ?? '') === '0' ? 'English' : (($sidInfo['medium'] ?? '') === '1' ? 'Hindi' : null)) ?>" />
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Select-->
                            <div class="form-group mb-4">
                                <label for="discipline">Discipline</label>
                                <input disabled type="text" id="discipline" class="form-control" name="discipline" value="<?= $studentDepartment ?? ''; ?>" placeholder="Discipline" />
                            </div>
                            <!--end::Select-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Select-->
                            <div class="form-group mb-4">
                                <label for="program">Program</label>
                                <input disabled type="text" id="program" class="form-control" name="program" value="<?= $studentProgram ?? ''; ?>" placeholder="Program" />
                            </div>
                            <!--end::Select-->
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group" id="program_nature">
                                <label for="course_type"><?php if ($sidInfo['si_course_nature'] == 1) echo 'Stream';
                                                            elseif ($sidInfo['si_course_nature'] == 2) echo 'Subjects';
                                                            elseif ($sidInfo['si_course_nature'] == 3) echo 'Specialization';
                                                            else echo "Stream/Group/Specailization"; ?></label>
                                <input type="text" class="form-control" disabled value="<?php if ($sidInfo['si_course_nature'] == 1) : echo getGroup($sidInfo['si_stream_group']);
                                                                                        elseif ($sidInfo['si_course_nature'] == 2) : $stream = getStream($sidInfo['si_stream_group']);
                                                                                            echo !empty($stream) ? implode(',', array_column($stream, 'cs_name')) : 'Stream Not Selected Yet';
                                                                                        elseif ($sidInfo['si_course_nature'] == 3) : echo getSpecialization($sidInfo['si_stream_group']);
                                                                                        else : echo "Not Selected Yet";
                                                                                        endif; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <h3 class=" font-weight-bold text-left text-success">Profile Details: </h3>
                        <div class="ml-auto" style="cursor: pointer;"><a href="<?= base_url($route . $lid . '/' . $sid . '/profile') ?>"><i class="flaticon-edit icon-lg text-primary"></i></a></div>
                    </div>

                    <hr class="my-3" style="border-top: 1px solid #000;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4 fv-plugins-icon-container">
                                <label for="firstname" data-toggle="tooltip" data-theme="dark" data-html="true" title="Please enter your first name exactly as stated in official documents such as your 10th Marksheet.">First
                                    Name </label>
                                <input disabled type="text" id="firstname" class="form-control" name="firstname" value="<?= $sidInfo['si_first_name'] ?? ''; ?>" placeholder="First Name">

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="middlename" data-toggle="tooltip" data-theme="dark" data-html="true" title="Please enter your middle name exactly as stated in official documents such as your 10th Marksheet.">Middle
                                    Name </label>
                                <input disabled type="text" id="middlename" class="form-control" name="middlename" value="<?= $sidInfo['si_middle_name'] ?? ''; ?>" placeholder="Middle Name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="lastname" data-toggle="tooltip" data-theme="dark" data-html="true" title="Please enter your last name exactly as stated in official documents such as your 10th Marksheet.">Last
                                    Name </label>
                                <input disabled type="text" id="lastname" class="form-control" name="lastname" value="<?= $sidInfo['si_last_name'] ?? ''; ?>" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group mb-4 fv-plugins-icon-container">
                                <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Please select your Gender.">Gender </label>
                                <div class="radio-inline my-3">
                                    <label class="radio radio-lg">
                                        <input disabled id="gender" type="radio" <?php if (($other['gender'] ?? null) == 0) {
                                                                                        echo 'checked';
                                                                                    } ?> name="sex">
                                        <span></span>
                                        Male
                                    </label>
                                    <label class="radio radio-lg">
                                        <input disabled type="radio" name="sex" <?php if (($other['gender'] ?? null) == 1) {
                                                                                    echo 'checked';
                                                                                } ?>>
                                        <span></span>
                                        Female
                                    </label>
                                    <label class="radio radio-lg">
                                        <input disabled type="radio" name="sex" <?php if (($other['gender'] ?? null) == 2) {
                                                                                    echo 'checked';
                                                                                } ?>>
                                        <span></span>
                                        Other
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group mb-4 fv-plugins-icon-container">
                                <label for="kt_datepicker" data-toggle="tooltip" data-theme="dark" data-html="true" title="Please enter your date of birth exactly as stated in official documents such as your 10th marksheet.">Date
                                    of Birth </label>
                                <div class="input-group">
                                    <input disabled type="text" class="form-control" name="dob" value="<?= $other['dob'] ?? ''; ?>" placeholder="Select date">
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group mb-4 fv-plugins-icon-container">
                                <label for="religion" data-toggle="tooltip" data-theme="dark" data-html="true" title="Select your religion">Religion </label>
                                <input disabled type="text" id="religion" name="religion" value="<?= $studentReligion; ?>" class="form-control" placeholder="Hindu">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group mb-4 fv-plugins-icon-container">
                                <label for="cat" data-toggle="tooltip" data-theme="dark" data-html="true" title="Select the category to which you belong.">Category </label>
                                <input disabled type="text" id="cat" name="cat" value="<?= $studentCaste ?>" class="form-control" placeholder="OBC">


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4 fv-plugins-icon-container">
                                <label for="email" data-toggle="tooltip" data-theme="dark" data-html="true" title="Please enter your personal email id. Further communication with the university will be done on this email id.">Student's Email </label>
                                <input disabled type="text" id="email" class="form-control" name="email" value="<?= $contact['sci_email'] ?? ''; ?>" placeholder="Student's Email">

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4 fv-plugins-icon-container">
                                <label for="student_mobile" data-toggle="tooltip" data-theme="dark" data-html="true" title="Please enter your personal mobile number. Your Unique Student ID and Password will be sent to this number via a text message. Kindly ensure that the number is working and is available at all times.">Student's Mobile No </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><?= $contact['sci_country_code'] ?? ''; ?></span>
                                    </div>
                                    <input disabled type="text" class="form-control" name="student_mobile" value="<?= $contact['sci_mobile'] ?? ''; ?>" placeholder="Student's Mobile No. ">
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label data-toggle="tooltip" data-theme="dark" data-html="true" title="" data-original-title="Kindly mention your residence landline number, if available.">Landline No. </label>
                                <input disabled type="text" class="form-control" name="landline" value="<?= $other['landline'] ?? ''; ?>" placeholder="Landline No.">
                            </div>
                        </div>

                    </div>

                    <div class="d-flex">
                        <h3 class=" font-weight-bold text-left text-success">Parent's Details:</h3>
                        <div class="ml-auto" style="cursor: pointer;"><a href="<?= base_url($route . $lid . '/' . $sid . '/profile/parent') ?>"><i class="flaticon-edit icon-lg text-primary"></i></a></div>
                    </div>

                    <hr class="my-3" style="border-top: 1px solid #000;">

                    <!--begin::Input-->
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label for="father_name" data-toggle="tooltip" data-theme="dark" data-html="true" title="Enter your father's name">Father's Name </label>
                                <input disabled type="text" id="father_name" class="form-control" name="father_name" value="<?= $parentDetail['father_name'] ?? '' ?>" placeholder="Father's Name" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Kindly fill your father's occupation">Father's Occupation </label>
                                <input disabled type="text" id="father_occupation" class="form-control" name="father_occupation" value="<?= $parentDetail['father_occupation'] ?? ''; ?>" placeholder="Father's Occupation" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Kindly fill your father's annual income as per the documents of Income Tax Return/Income Certificate.">Annual Income </label>
                                <input disabled type="text" class="form-control" name="father_anuual_income" value="<?= $parentDetail['father_income'] ?? ''; ?>" placeholder="Annual Income" />
                            </div>
                        </div>
                    </div>
                    <!--end::Input-->
                    <!--begin::Input-->
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Enter your mother's name">Mother's Name </label>
                                <input disabled type="text" class="form-control" name="mother_name" value="<?= $parentDetail['mother_name'] ?? ''; ?>" placeholder="Mother's Name" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Kindly fill your mother's occupation">Mother's Occupation </label>
                                <input disabled type="text" class="form-control" name="mother_occupation" value="<?= $parentDetail['mother_occupation'] ?? ''; ?>" placeholder="Mother's Occupation" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Kindly fill your mother's annual income as per the documents of Income Tax Return/Income Certificate.">Annual Income </label>
                                <input disabled type="text" class="form-control" name="mother_income" value="<?= $parentDetail['mother_income'] ?? ''; ?>" placeholder="Annual Income" />
                            </div>
                        </div>
                    </div>
                    <!--end::Input-->
                    <!--begin::Input-->
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Kindly mention your parent's email id, if any.">Parent's Email </label>
                                <input disabled type="text" class="form-control" name="parent_email" value="<?= $parentDetail['parent_email'] ?? ''; ?>" placeholder="Parent's Email" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mb-4">
                                <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Kindly mention your parent's or guardian's mobile number for future reference.">Parent's Mobile No. </label>
                                <input disabled type="text" class="form-control" name="parent_mobile" value="<?= $parentDetail['parent_mobile'] ?? ''; ?>" placeholder="Parent's Mobile No. " />
                            </div>
                        </div>
                    </div>
                    <!--end::Input-->
                    <?php $i = 0;
                    foreach ($address as $row) : ?>
                        <div class="d-flex">
                            <h3 class=" font-weight-bold text-left text-success"><?php if (count($address) < 2) {
                                                                                        echo 'Permanent and Current';
                                                                                    } else {
                                                                                        if ($i == 1) echo 'Permanent';
                                                                                        else echo 'Current';
                                                                                    } ?> Address</h3>
                            <div class="ml-auto" style="cursor: pointer;"><a href="<?= base_url($route . $lid . '/' . $sid . '/profile/address') ?>"><i class="flaticon-edit icon-lg text-primary"></i></a></div>
                        </div>

                        <hr class="my-3" style="border-top: 1px solid #000;">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Here you are required to mention your House or Flat No, Name of the Society, Street Name/Village Name">Address Line </label>
                                    <input type="text" class="form-control" name="street_address" value="<?= $row['street_address'] ?? ''; ?>" placeholder="House or Flat No, Street Name/Village Name" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Mention the exact pincode to your area of residence.">Pincode </label>
                                    <input type="text" class="form-control" name="zipcode" value="<?= $row['zipcode'] ?? ''; ?>" placeholder="Pincode" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <!--begin::Select-->
                                <div class="form-group mb-4">
                                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Select the name of the State corresponding to your address.">State </label>
                                    <input type="text" id="state" name="state" value="<?= $row['state'] ?? ''; ?>" class="form-control" placeholder="State">
                                </div>
                                <!--end::Select-->
                            </div>
                            <div class="col-lg-6">
                                <!--begin::Select-->
                                <div class="form-group mb-4">
                                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Select the name of the District to which you belong to.">District </label>
                                    <input type="text" id="district" name="district" value="<?= $row['district'] ?? ''; ?>" class="form-control" placeholder="District">
                                </div>
                                <!--end::Select-->
                            </div>

                        </div>
                    <?php $i++;
                    endforeach; ?>




                    <div class="d-flex">
                        <h3 class=" font-weight-bold text-left text-success">Academic Details:</h3>
                        <div class="ml-auto" style="cursor: pointer;"><a href="<?= base_url($route . $lid . '/' . $sid . '/academic') ?>"><i class="flaticon-edit icon-lg text-primary"></i></a></div>
                    </div>
                    <hr class="mt-0 mb-3" style="border-top: 1px solid #000;">
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
                                        <td><?= $row['el_name'] ?? ''; ?></td>
                                        <td><?= $row['board_university'] ?? ''; ?></td>
                                        <td><?= $row['institute_school'] ?? ''; ?></td>
                                        <td><?= $row['year'] ?? ''; ?></td>
                                        <td><?= $row['total_marks'] ?? ''; ?></td>
                                        <td><?= $row['obtain_marks'] ?? ''; ?></td>
                                        <td><?= $row['grade_precentage'] ?? ''; ?>(<?php if ($row['grade_type'] ?? '' == 1) echo "Grade";
                                                                                    else echo "%"; ?>)</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex">
                        <h3 class=" font-weight-bold text-left text-success">Uploaded Documents</h3>
                        <div class="ml-auto" style="cursor: pointer;"><a href="<?= base_url($route . $lid . '/' . $sid . '/document') ?>"><i class="flaticon-edit icon-lg text-primary"></i></a></div>
                    </div>

                    <hr class="my-3" style="border-top: 1px solid #000;">
                    <div class="row mb-3">
                        <?php foreach ($student_docs as $student) : ?>
                            <div class="col-lg-3 my-3">
                                <h6 class="mb-2 text-center" style="border-bottom: 1px solid #ebedf3;"><?= $student['dt_name'] ?></h6>
                                <div class="card">
                                    <?php if (pathinfo($student['sd_url'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                        <iframe class="card-img" src="https://docs.google.com/gview?url=https:<?= $url . substr($student['sd_url'] ?? './', 1) ?>&embedded=true"></iframe>
                                    <?php else : ?>
                                        <img class="card-img" src="<?= base_url() . 'sso.gyanvihar.org' . substr($student['sd_url'] ?? './', 1) ?>" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <hr class="my-3" style="border-top: 1px solid #000;">
                    <div class="form-group mb-4 fv-plugins-icon-container">
                        <form id='final_form' method="post" action="<?= base_url($actionUrl . $lid . '/' . $sid) ?>">
                            <?= csrf_field() ?>
                            <div class="checkbox-inline my-3">
                                <label class="checkbox checkbox-lg">
                                    <input id="final_submit" type="checkbox" onclick="ch()" <?php if (old('final_submit') == 1) echo 'checked'; ?> name="final_submit" value="1">
                                    <span></span>
                                    This Final Submit.
                                </label>
                            </div>
                        </form>
                    </div>

                </div>
                <!--begin::Wizard Actions-->
                <div class="d-flex justify-content-between border-top mt-5 pt-5">
                    <div class="mr-2">
                        <a href="<?= base_url($route . $lid . '/' . $sid . '/' . $previous) ?>" class="btn btn-light-primary font-weight-bolder text-uppercase">Previous</a>
                    </div>
                    <div>

                        <button type="submit" id='btn' form='final_form' disabled name="btn" value="review" class="btn btn-primary font-weight-bolder text-uppercase">Final Submit</button>

                    </div>
                </div>
                <!--end::Wizard Actions-->
            </div>
        </div>
    </div>
</div>
<script>
    function ch() {
        if ($('#final_submit').is(':checked')) {
            $('#btn').prop('disabled', false)
        } else {
            $('#btn').prop('disabled', true)
        }
    }
</script>