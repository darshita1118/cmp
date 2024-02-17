<?php

use App\Models\ApplicationModel;

$leadModel = new ApplicationModel('lead_profile_' . session('year'), 'lid', session('db_priffix') . '_' . session('suffix'));
$leadInfo = $leadModel->where(['lid' => $lid])->first() ?? [];

$studentInfoModel = new ApplicationModel('student_info_' . session('year'), 'si_id', 'sso_' . session('suffix'));
$studentInfo = $studentInfoModel->where(['sid' => $sid])->first() ?? [];

$departmentModel = new ApplicationModel('departments', 'dept_id', 'sso_' . session('suffix'));
$departments =  $departmentModel->select(['dept_id', 'dept_name'])->where(['dept_status' => 1, 'dept_delete_status' => 0])->findAll() ?? [];

$programModel = new ApplicationModel('session_courses_' . session('year'), 'sc_id', 'sso_' . session('suffix'));
$programs = $programModel->select(['course_code', 'course_name', 'course_nature', 'sc_id as coi_id', 'validation_level', 'course_type', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_' . session('year') . '.course_id')->where(['sc_course_delete' => 0])->where(['sc_course_status' => 1, 'course_delete_status' => 0, 'dept_id' => $studentInfo['dept_id']])->findAll() ?? [];

$religionModel = new ApplicationModel('religions', 'r_id', 'sso_' . session('suffix'));
$religions = $religionModel->select(['r_name', 'r_id'])->where(['r_status' => 1])->findAll() ?? [];

$casteModel = new ApplicationModel('castes', 'cid', 'sso_' . session('suffix'));
$castes = $casteModel->select(['c_name', 'cid'])->where(['c_status' => 1])->findAll() ?? [];

$contactModel = new ApplicationModel('student_contact_info_' . session('year'), 'sci_id', 'sso_' . session('suffix'));
$studentContact = $contactModel->where(['sid' => $sid])->first() ?? [];

$studentOtherModel = new ApplicationModel('student_other_info_' . session('year'), 'soi_id', 'sso_' . session('suffix'));
$studentOther = $studentOtherModel->where(['sid' => $sid])->first() ?? [];

$sipModel = new ApplicationModel('st_id_proof', 'sip_id', 'sso_' . session('suffix'));
$idProof = $sipModel->select(['sip_id', 'id_name'])->where(['sip_status' => 1])->findAll() ?? [];
$index = array_search($subStep, $validSubSlug);
?>

<div class="tab-pane fade active show" id="person-detail">
    <!--begin::Form-->
    <form class="px-1" method="post" id="personal" action="<?= base_url($actionUrl . $lid . '/' . $sid) ?>">
        <?= csrf_field() ?>
        <div class="row">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label col-form-label" for="medium" data-toggle="tooltip" data-theme="dark" data-html="true" title="Please select your Medium for examination.">Medium<span style="color:red">*</span>:</label>
                    <select id="medium" name="medium" class="form-select">
                        <option value="">---Select---</option>
                        <option value="0" <?= ((old('medium') ?? ($studentInfo['medium'] ?? '')) == '0') ? "selected" : null ?>>English</option>
                        <option value="1" <?= ((old('medium') ?? ($studentInfo['medium'] ?? '')) == '1') ? "selected" : null ?>>Hindi</option>
                    </select>
                    <span class="form-text text-danger "><?= \Config\Services::validation()->showError('medium'); ?></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label col-form-label">Discipline:</label>
                    <select id="discipline" name="discipline" onchange="change(this.value)" class="form-select">
                        <option value="">Select</option>
                        <?php foreach ($departments ?? [] as $key) : ?>
                            <option value="<?= $key['dept_id']; ?>" <?php if ((old('discipline') ?? ($studentInfo['dept_id'] ?? ($leadInfo['lead_department'] ?? ''))) == $key['dept_id']) echo "selected"; ?>>
                                <?= $key['dept_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-text text-danger "><?= \Config\Services::validation()->showError('discipline'); ?></span>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label col-form-label">Program</label>
                    <select id="program" name="program" onchange="getNature($(this).val(),$(this).find(':selected').attr('data-nature'));$('#level').val($(this).find(':selected').attr('data-level')); $('#nature').val($(this).find(':selected').attr('data-nature'));" class="form-control">
                        <option value="">Select</option>
                        <?php foreach ($programs as $key) : ?>
                            <option value="<?= $key['coi_id']; ?>" data-nature="<?= $key['course_nature'] ?>" data-level="<?= $key['level_id']; ?>" <?php if ((old('program') ?? ($studentInfo['program_id']  ?? ($leadInfo['lead_programe'] ?? ''))) == $key['coi_id']) echo "selected"; ?>>
                                <?= $key['course_name']; ?></option>
                        <?php endforeach;
                        ?>
                    </select>
                    <span class="form-text text-danger "><?= \Config\Services::validation()->showError('program'); ?></span>
                </div>
                <input type="hidden" name="nature" id="nature" value="<?= old('nature') ?? ($studentInfo['si_course_nature'] ?? '') ?>">
                <input type="hidden" name="level" id="level" value="<?= old('level') ?? ($studentInfo['si_course_level'] ?? '') ?>">
                <div class="col-md-12 mb-3" id="program_nature">

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">

                    <label class="form-label col-form-label" for="firstname" data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Please enter your first name exactly as stated in official documents such as your 10th Marksheet.</p>" class="form-label">First Name</label>
                    <input type="text" id="firstname" class="form-control" name="firstname" value="<?= old('firstname') ?? ($studentInfo['si_first_name'] ?? ($leadInfo['lead_first_name'] ?? '')); ?>" placeholder="First Name" />
                    <span class="form-text text-danger "><?= \Config\Services::validation()->showError('firstname'); ?></span>

                </div>
                <div class="col-md-4 mb-3">

                    <label class="form-label col-form-label" for="middlename" data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Please enter your middle name exactly as stated in official documents such as your 10th Marksheet.</p>">Middle Name</label>
                    <input type="text" id="middlename" class="form-control" name="middlename" value="<?= old('middlename') ?? ($studentInfo['si_middle_name'] ?? ($leadInfo['lead_middle_name'] ?? '')); ?>" placeholder="Middle Name" />
                    <span class="form-text text-danger "><?= \Config\Services::validation()->showError('middlename'); ?></span>

                </div>
                <div class="col-md-4 mb-3">

                    <label class="form-label col-form-label" for="lastname" data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Please enter your last name exactly as stated in official documents such as your 10th Marksheet.</p>">Last Name</label>
                    <input type="text" id="lastname" class="form-control" name="lastname" value="<?= old('lastname') ?? ($studentInfo['si_last_name'] ?? ($leadInfo['lead_last_name'] ?? '')); ?>" placeholder="Last Name" />
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('lastname'); ?></span>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label col-form-label" data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Please select your Gender.</p>">Gender</label>
                    <div class="d-flex pt-2">
                        <div class="form-check form-check-inline">
                            <input id="gender" class="form-check-input" type="radio" value="0" <?php if ((old('sex') ?? ($studentOther['gender'] ?? '0')) == '0') {
                                                                                                    echo 'checked="checked"';
                                                                                                } ?> name="sex" />
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="sex" value="1" <?php if ((old('sex') ?? ($studentOther['gender'] ?? '')) == 1) {
                                                                                                    echo 'checked="checked"';
                                                                                                } ?> />
                            <label class="form-check-label" for="femail">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" value="2" <?php if ((old('sex') ?? ($studentOther['gender'] ?? '')) == 2) {
                                                                                                    echo 'checked="checked"';
                                                                                                } ?> />
                            <label class="form-check-label" for="ohter">Other</label>
                        </div>
                    </div>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('sex'); ?></span>
                </div>
                <div class="col-md-6 mb-3">

                    <label class="form-label col-form-label" for="email" data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Please enter your personal email id. Further communication with the university will be done on this email id.</p>">Student's Email</label>
                    <input type="text" id="email" class="form-control" value="<?= old('email') ?? ($studentContact['sci_email'] ?? ($leadInfo['lead_email'] ?? '')); ?>" placeholder="Student's Email" disabled />
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('email'); ?></span>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">

                    <label class="form-label" data-toggle="tooltip" data-theme="dark" data-html="true" title="Please Select Government ID Proof Type.">Student's ID Type <span style="color:red">*</span>:</label>
                    <select class="form-select" id="id_type" name="id_type">
                        <option value="">Select ID Type</option>
                        <?php foreach ($idProof as $key) : ?>
                            <option value="<?= $key['sip_id']; ?>" <?php if ((old('id_type') ?? ($studentOther['sip_type'] ?? '')) == $key['sip_id']) echo "selected"; ?>><?= $key['id_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('id_type'); ?></span>

                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label" for="religion" data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Select your religion</p>">Religion</label>
                    <select id="religion" name="religion" class="form-select">
                        <option value="">Select Religion</option>
                        <?php foreach ($religions as $key) : ?>
                            <option value="<?= $key['r_id']; ?>" <?php if ((old('religion') ?? ($studentOther['religion_id'] ?? '')) == $key['r_id']) echo "selected"; ?>>
                                <?= $key['r_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('religion'); ?></span>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label" for="cat" data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Select the category to which you belong.</p>">Category:</label>
                    <select id="cat" name="cat" class="form-select">
                        <option value="">Select Category</option>
                        <?php foreach ($castes as $key) : ?>
                            <option value="<?= $key['cid']; ?>" <?php if ((old('cat') ?? ($studentOther['caste_id'] ?? '')) == $key['cid']) echo "selected"; ?>>
                                <?= $key['c_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('cat'); ?></span>

                </div>
                <div class="col-md-4 mb-3">

                    <label class="form-label" data-toggle="tooltip" data-theme="dark" data-html="true" title="Please enter ID Number.">Student ID No:<span style="color:red">*</span></label>

                    <input type="text" id="sip_no" class="form-control" name="sip_no" onkeypress="return upperKey(event)" value="<?= old('sip_no') ?? ($studentOther['sip_no'] ?? ($leadInfo['sip_no'] ?? '')); ?>" placeholder="Student's ID No." autocomplete="off" style="text-transform:uppercase;">
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('sip_no'); ?></span>

                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="dob" data-toggle="tooltip" data-theme="dark" data-html="true" title="<p>Please enter your date of birth exactly as stated in official documents such as your 10th marksheet.</p>">Date of Birth</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="dob" value="<?= old('dob') ??  ($studentOther['dob'] ?? ''); ?>" max="2008-05-31" placeholder="Select date" id="dob" />
                        <span class="form-text text-danger"><?= \Config\Services::validation()->showError('dob'); ?></span>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="" class="form-label" data-toggle="tooltip" data-theme="dark" data-html="true" title="" data-original-title="<p>Kindly mention your residence landline number, if available.</p>">Landline No.</label>
                    <input type="text" class="form-control" name="landline" value="<?= old('landline') ?? ($studentOther['landline'] ?? ''); ?>" placeholder="Landline No.">
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('landline'); ?></span>

                </div>
            </div>
        </div>
        <!--begin: Wizard Actions-->
        <div class="d-flex justify-content-between pt-7">
            <div class="mr-2"></div>
            <div>
                <input type="hidden" name="student_contact" value="<?= $studentContact['sci_id'] ?? ''; ?>">
                <input type="hidden" name="student_other" value="<?= $studentOther['soi_id'] ?? ''; ?>">
                <input type="hidden" name="student_info" value="<?= $studentInfo['si_id'] ?? ''; ?>">
                <button type="submit" class="btn btn-primary font-weight-bolder text-uppercase" value="profile-detail" name="btn">Save & Next</button>
                <a href="<?= base_url($route . $lid . '/' . $sid . '/' . $slug . '/' . $validSubSlug[$index + 1]) ?>" class="btn btn-light-primary font-weight-bolder text-uppercase">
                    NEXT</a>
            </div>

        </div>
        <!--end: Wizard Actions-->
    </form>
</div>


<script>
    function upperKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
        if ((ASCIICode >= 97 && ASCIICode <= 122) || (ASCIICode >= 65 && ASCIICode <= 90) || (ASCIICode >= 48 && ASCIICode <= 57)) {
            return true;
        } else {
            return false;
        }
    }

    function change(param, prog =
        '<?= old('program') ?? ($studentInfo['program_id']  ?? ($leadInfo['lead_programe'] ?? '')); ?>') {
        if (param != '') {
            $.ajax({
                url: '<?= base_url() ?>/helper/get-program-by-dept',
                type: 'post',
                data: {
                    'deptm': param
                },
                dataType: 'JSON',
                async: false,
                success: function(result) {
                    //console.log(result)
                    if (result.isOk == false) {
                        showFire('error', `Something Went Wrong`);
                    } else {
                        $('#program').find('option').remove().end().append(
                            '<option value="">-- Select Program --</option>');
                        var programs = result.data
                        for (let i = 0; i < programs.length; i++) {
                            if (prog === programs[i].id) {
                                $('#program').append($("<option/>", {
                                    value: programs[i].id,
                                    text: programs[i].name,
                                    selected: 'selected',
                                    'data-nature': programs[i].course_nature,
                                    'data-level': programs[i].level_id,
                                }));
                                getNature(prog, programs[i].course_nature)
                            } else {
                                $('#program').append($("<option/>", {
                                    value: programs[i].id,
                                    text: programs[i].name,
                                    'data-nature': programs[i].course_nature,
                                    'data-level': programs[i].level_id,
                                }));
                            }

                        }
                    }
                },
                error: function() {
                    showFire(`error`, `Something Went Wrong on Server Side`);
                }

            });
        } else {
            $("#program_nature").html('');
            $('#program').find('option').remove().end().append('<option value="">-- Select Program --</option>');
        }

    }
</script>
<script>
    function getNature(course = '', params = '', defualt = '') {
        //console.log(course, params, defualt)
        if (course !== '' && params !== '') {
            $.ajax({
                url: '<?= base_url('helper/course-natures') ?>',
                type: 'post',
                data: {
                    'course': course,
                    "nature": params,
                    'default': defualt
                },
                //dataType: 'json',
                async: false,
                success: function(data) {
                    $("#program_nature").html('');
                    $("#program_nature").html(data);
                },
                error: function() {
                    showFire('error', 'Somwthing went wrong server side.');
                }
            })
        } else {
            $("#program_nature").html('');
        }
    }
    //console.log($('#program').val(),$('#program').find(':selected').attr('data-nature'));
    //getNature($('#program').val(),$('#program').find(':selected').attr('data-nature'));
    <?php if ((old('program') ?? ($studentInfo['program_id']  ?? ($leadInfo['lead_programe'] ?? ''))) != '') :
        $oldNature = old('nature') ? json_encode(old('course_type')) : false;
        $default = (old('nature') ?? ($studentInfo['si_course_nature'] ?? '')) == 2 ? ($oldNature ? $$oldNature : ($studentInfo['si_stream_group'] ?? '')) : (old('course_type') ?? $studentInfo['si_stream_group'] ?? '');
    ?>
        getNature('<?= (old('program') ?? ($studentInfo['program_id']  ?? ($leadInfo['lead_programe'] ?? ''))) ?>', $('#program').find(':selected').attr('data-nature'), '<?= $default ?>')
        $('#nature').val($('#program').find(':selected').attr('data-nature'))
    <?php endif; ?>
</script>