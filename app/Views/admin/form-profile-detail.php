<?php

use App\Models\ApplicationModel;

function getLeadInfo($lid)
{
    $leadModel = new ApplicationModel('lead_profile_'.session('year'),'lid', session('db_priffix').'_'.session('suffix'));
    return $leadModel->where(['lid'=>$lid])->first()??[];
}

function getStudentInfo($sid)
{
    $departmentModel = new ApplicationModel('student_info_'.session('year'),'si_id', 'sso_'.session('suffix'));
    return $departmentModel->where(['sid'=>$sid])->first()??[];
}

function getDepartments($id=false)
{
    $departmentModel = new ApplicationModel('departments','dept_id', 'sso_'.session('suffix'));
    return $departmentModel->select(['dept_id','dept_name'])->where(['dept_status'=>1, 'dept_delete_status'=>0])->findAll()??[];
}

function getProgram($dept)
{
    $programModel = new ApplicationModel('session_courses_'.session('year'), 'sc_id', 'sso_' . session('suffix'));
    return $programModel->select(['course_code','course_name', 'course_nature', 'sc_id as coi_id', 'validation_level', 'course_type', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_'. session('year') . '.course_id')->where(['sc_course_delete'=>0])->where(['sc_course_status'=>1, 'course_delete_status'=>0, 'dept_id'=>$dept])->findAll()??[];
}

function getReligion()
{
    $religionModel = new ApplicationModel('religions','r_id', 'sso_'.session('suffix'));
    return $religionModel->select(['r_name','r_id'])->where(['r_status'=>1])->findAll()??[];
}

function getCaste()
{
    $casteModel = new ApplicationModel('castes','cid', 'sso_'.session('suffix'));
    return $casteModel->select(['c_name','cid'])->where(['c_status'=>1])->findAll()??[];
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
function getStIdProof()
{
    $sipModel = new ApplicationModel('st_id_proof','sip_id', 'sso_'.session('suffix'));
    return $sipModel->select(['sip_id','id_name'])->where(['sip_status'=>1])->findAll()??[];
}

$leadInfo = getLeadInfo($lid);
$studentInfo = getStudentInfo($sid);
$departments = getDepartments();
$programs = getProgram($studentInfo['dept_id']);
$religions = getReligion();
$castes = getCaste();
$studentContact = getStudentContact($sid);
$studentOther = getStudentOther($sid);
$idProof = getStIdProof();
?>

<!--begin: Wizard Step 1-->
<div class="pb-5">
    <!--begin::Form-->
    <form class="px-1" method="post" id="personal" action="<?= base_url('admin/profile-step-action/'.$lid.'/'.$sid) ?>">
        <?= csrf_field() ?>
        <!--begin::Title-->
        <div class="row">
            <div class="col-xl-2">
                                <!--begin::Select-->
                                <div class="form-group">
                                    <label for="medium" data-toggle="tooltip" data-theme="dark" data-html="true" title="Please select your Medium for examination.">Medium<span style="color:red">*</span><i class="fa fa-question-circle"></i></label>
                                    <select id="medium" name="medium" class="form-control form-control-solid form-control-lg">
                                        <option value="">---Select---</option>
                                        <option value="0" <?= (set_value('medium', @$studentInfo['medium']) == '0') ? "selected" : null ?>>English</option>
                                        <option value="1" <?= (set_value('medium', @$studentInfo['medium']) == '1') ? "selected" : null ?>>Hindi</option>
                                    </select>
                                    <span class="form-text text-danger "><?= \Config\Services::validation()->showError('medium'); ?></span>
                                </div>
                                <!--end::Select-->
            </div>
            <div class="col-xl-3">
                <!--begin::Select-->
                <div class="form-group">
                    <label for="discipline">Discipline</label>
                    <select id="discipline" name="discipline" onchange="change(this.value)"
                        class="form-control form-control-solid form-control-lg">
                        <option value="">Select</option>
                        <?php foreach ($departments ?? [] as $key) : ?>
                        <option value="<?= $key['dept_id']; ?>"
                            <?php if ((old('discipline') ?? ($studentInfo['dept_id'] ?? ( $leadInfo['lead_department'] ??''))) == $key['dept_id']) echo "selected"; ?>>
                            <?= $key['dept_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span
                        class="form-text text-danger "><?= \Config\Services::validation()->showError('discipline'); ?></span>

                </div>
                <!--end::Select-->

            </div>
            <div class="col-xl-3">
                <!--begin::Select-->
                <div class="form-group">
                    <label>Program</label>
                    <select id="program" name="program" onchange="getNature($(this).val(),$(this).find(':selected').attr('data-nature'));$('#level').val($(this).find(':selected').attr('data-level')); $('#nature').val($(this).find(':selected').attr('data-nature'));" class="form-control form-control-solid form-control-lg">
                        <option value="">Select</option>
                        <?php foreach ($programs as $key) : ?>
                        <option value="<?= $key['coi_id']; ?>" data-nature="<?= $key['course_nature'] ?>" data-level="<?= $key['level_id']; ?>"
                            <?php if ((old('program')??($studentInfo['program_id']  ?? ( $leadInfo['lead_programe'] ??''))) == $key['coi_id']) echo "selected"; ?>>
                            <?= $key['course_name']; ?></option>
                        <?php endforeach;
                                     ?>
                    </select>
                    <span
                        class="form-text text-danger "><?= \Config\Services::validation()->showError('program'); ?></span>

                </div>
                <!--end::Select-->
            </div>
            <input type="hidden" name="nature" id="nature" value="<?= old('nature')??($studentInfo['si_course_nature']??'') ?>">
            <input type="hidden" name="level" id="level" value="<?= old('level')??($studentInfo['si_course_level']??'') ?>">
            <div class="col-xl-4">
                <div class="form-group" id="program_nature">

                </div>
            </div>
        </div>
        <!--begin::Input-->
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="firstname" data-toggle="tooltip" data-theme="dark" data-html="true"
                        title="<p>Please enter your first name exactly as stated in official documents such as your 10th Marksheet.</p>">First
                        Name <i class="fa fa-question-circle"></i></label>
                    <input type="text" id="firstname" class="form-control form-control-solid form-control-lg"
                        name="firstname"
                        value="<?= old('firstname')?? ($studentInfo['si_first_name'] ?? ( $leadInfo['lead_first_name'] ??'')); ?>"
                        placeholder="First Name" />
                    <span
                        class="form-text text-danger "><?= \Config\Services::validation()->showError('firstname'); ?></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="middlename" data-toggle="tooltip" data-theme="dark" data-html="true"
                        title="<p>Please enter your middle name exactly as stated in official documents such as your 10th Marksheet.</p>">Middle
                        Name <i class="fa fa-question-circle"></i></label>
                    <input type="text" id="middlename" class="form-control form-control-solid form-control-lg"
                        name="middlename"
                        value="<?= old('middlename')?? ($studentInfo['si_middle_name'] ?? ( $leadInfo['lead_middle_name'] ??'')); ?>"
                        placeholder="Middle Name" />
                    <span
                        class="form-text text-danger "><?= \Config\Services::validation()->showError('middlename'); ?></span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="lastname" data-toggle="tooltip" data-theme="dark" data-html="true"
                        title="<p>Please enter your last name exactly as stated in official documents such as your 10th Marksheet.</p>">Last
                        Name <i class="fa fa-question-circle"></i></label>
                    <input type="text" id="lastname" class="form-control form-control-solid form-control-lg"
                        name="lastname"
                        value="<?= old('lastname')?? ($studentInfo['si_last_name'] ?? ( $leadInfo['lead_last_name'] ??'')); ?>"
                        placeholder="Last Name" />
                    <span
                        class="form-text text-danger"><?= \Config\Services::validation()->showError('lastname'); ?></span>
                </div>
            </div>
        </div>
        <!--end::Input-->
        <!--begin::Input-->
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label data-toggle="tooltip" data-theme="dark" data-html="true"
                        title="<p>Please select your Gender.</p>">Gender <i class="fa fa-question-circle"></i></label>
                    <div class="radio-inline my-3">
                        <label class="radio radio-lg">
                            <input id="gender" type="radio" value="0" <?php if ((old('sex')??($studentOther['gender']??'0')) == '0') {
                                                                                        echo 'checked="checked"';
                                                                                    } ?> name="sex" />
                            <span></span>
                            Male 
                        </label>
                        <label class="radio radio-lg">
                            <input type="radio" name="sex" value="1" <?php if ((old('sex')?? ($studentOther['gender']??'')) == 1) {
                                                                                        echo 'checked="checked"';
                                                                                    } ?> />
                            <span></span>
                            Female
                        </label>
                        <label class="radio radio-lg">
                            <input type="radio" name="sex" value="2" <?php if ((old('sex')??($studentOther['gender']??'')) == 2) {
                                                                                        echo 'checked="checked"';
                                                                                    } ?> />
                            <span></span>
                            Other
                        </label>
                    </div>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('sex'); ?></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="dob" data-toggle="tooltip" data-theme="dark" data-html="true"
                        title="<p>Please enter your date of birth exactly as stated in official documents such as your 10th marksheet.</p>">Date
                        of Birth <i class="fa fa-question-circle"></i></label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-solid form-control-lg" name="dob"
                            value="<?= old('dob') ??  ($studentOther['dob'] ?? ''); ?>" max="2008-05-31" placeholder="Select date"
                            id="dob" />
                        <div class="input-group-append">
                            <span class="input-group-text form-control-solid">
                                <i class="la la-calendar-check-o"></i>
                            </span>
                        </div>
                    </div>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('dob'); ?></span>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label for="religion" data-toggle="tooltip" data-theme="dark" data-html="true"
                        title="<p>Select your religion</p>">Religion <i class="fa fa-question-circle"></i></label>
                    <select id="religion" name="religion" class="form-control form-control-solid form-control-lg">
                        <option value="">Select Religion</option>
                        <?php foreach ($religions as $key) : ?>
                        <option value="<?= $key['r_id']; ?>"
                            <?php if ((old('religion') ?? ($studentOther['religion_id'] ?? '')) == $key['r_id']) echo "selected"; ?>>
                            <?= $key['r_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span
                        class="form-text text-danger"><?= \Config\Services::validation()->showError('religion'); ?></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="cat" data-toggle="tooltip" data-theme="dark" data-html="true"
                        title="<p>Select the category to which you belong.</p>">Category <i
                            class="fa fa-question-circle"></i></label>
                    <select id="cat" name="cat" class="form-control form-control-solid form-control-lg">
                        <option value="">Select Category</option>
                        <?php foreach ($castes as $key) : ?>
                        <option value="<?= $key['cid']; ?>"
                            <?php if ((old('cat')??($studentOther['caste_id'] ?? '')) == $key['cid']) echo "selected"; ?>>
                            <?= $key['c_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('cat'); ?></span>
                </div>
            </div>
        </div>
        <!--end::Input-->
        <!--begin::Input-->
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="email" data-toggle="tooltip" data-theme="dark" data-html="true"
                        title="<p>Please enter your personal email id. Further communication with the university will be done on this email id.</p>">Student's
                        Email <i class="fa fa-question-circle"></i></label>
                    <input type="text" id="email" class="form-control form-control-solid form-control-lg" 
                        value="<?= old('email')??($studentContact['sci_email'] ?? ( $leadInfo['lead_email'] ??'')); ?>"
                        placeholder="Student's Email" disabled/>
                    <span
                        class="form-text text-danger"><?= \Config\Services::validation()->showError('email'); ?></span>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="student_mobile" data-toggle="tooltip" data-theme="dark" data-html="true"
                        title="<p>Please enter your personal mobile number. Your Unique Student ID and Password will be sent to this number via a text message. Kindly ensure that the number is working and is available at all times.</p>">Student's
                        Mobile No <i class="fa fa-question-circle"></i></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span
                                class="input-group-text"><?= $studentContact['sci_country_code']??($leadInfo['lead_country_code']??'') ?></span>
                        </div>
                        <input type="text" class="form-control form-control-solid form-control-lg" 
                            value="<?= old('student_mobile')?? ($studentContact['sci_mobile'] ?? ( $leadInfo['lead_mobile'] ??'')); ?>"
                            placeholder="Student's Mobile No. " disabled>
                    </div>
                    <span
                        class="form-text text-danger"><?= \Config\Services::validation()->showError('student_mobile'); ?></span>
                </div>

            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Please Select Government ID Proof Type.">Student's
                        ID Type <i class="fa fa-question-circle"></i><span style="color:red">*</span></label>
                    <div class="input-group">
                        <select id="id_type" class="form-control form-control-solid form-control-lg" name="id_type">
                        	<option value="">Select ID Type</option>
                        	<?php foreach ($idProof as $key) : ?>
		                        <option value="<?= $key['sip_id']; ?>" <?php if ((old('id_type')??($studentOther['sip_type'] ?? '')) == $key['sip_id']) echo "selected"; ?>><?= $key['id_name']; ?></option>
		        	<?php endforeach; ?>
                        </select>
                    </div>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('id_type'); ?></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title="Please enter ID Number.">Student's
                        ID No <i class="fa fa-question-circle"></i><span style="color:red">*</span></label>
                    <div class="input-group">
                        <input type="text" id="sip_no" class="form-control form-control-solid form-control-lg" name="sip_no" onkeypress="return upperKey(event)" value="<?= old('sip_no') ?? ($studentOther['sip_no'] ?? ($leadInfo['sip_no'] ?? '')); ?>" placeholder="Student's ID No." autocomplete="off" style="text-transform:uppercase;">
                    </div>
                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('sip_no'); ?></span>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label data-toggle="tooltip" data-theme="dark" data-html="true" title=""
                        data-original-title="<p>Kindly mention your residence landline number, if available.</p>">Landline
                        No. <i class="fa fa-question-circle"></i></label>
                    <input type="text" class="form-control form-control-solid form-control-lg" name="landline"
                        value="<?= old('landline')??($studentOther['landline'] ?? ''); ?>" placeholder="Landline No.">
                    <span
                        class="form-text text-danger"><?= \Config\Services::validation()->showError('landline'); ?></span>
                </div>
            </div>

        </div>
        <!--end::Input-->
        <!--begin: Wizard Actions-->
        <div class="d-flex justify-content-between pt-7">
            <div class="mr-2"></div>
            <div>
                <input type="hidden" name="student_contact" value="<?= $studentContact['sci_id']??''; ?>">
                <input type="hidden" name="student_other" value="<?= $studentOther['soi_id']??''; ?>">
                <input type="hidden" name="student_info" value="<?= $studentInfo['si_id']??''; ?>">
                <button type="submit" class="btn btn-primary font-weight-bolder text-uppercase" value="profile-detail"
                    name="btn">Save & Next</button>
                <a href="<?= base_url('admin/process-application/'.$lid.'/'.$sid.'/parent-detail') ?>"
                class="btn btn-light-primary font-weight-bolder text-uppercase">
                NEXT</a>
            </div>
            
        </div>
        <!--end: Wizard Actions-->
    </form>
    <!--end::Form-->
</div>
<!--end: Wizard Step 1-->

<script>
function upperKey(evt) { 
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
        if ((ASCIICode >= 97 && ASCIICode <= 122) || (ASCIICode >= 65 && ASCIICode <= 90) || (ASCIICode >= 48 && ASCIICode <= 57)) {
            return true; 
        }
        else{
            return false;
        }
    }
    
function change(param, prog =
    '<?= old('program')??($studentInfo['program_id']  ?? ( $leadInfo['lead_programe'] ??'')); ?>') {
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
                                'data-nature':programs[i].course_nature,
                                'data-level':programs[i].level_id,
                            }));
                            getNature(prog, programs[i].course_nature)
                        } else {
                            $('#program').append($("<option/>", {
                                value: programs[i].id,
                                text: programs[i].name,
                                'data-nature':programs[i].course_nature,
                                'data-level':programs[i].level_id,
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
    function getNature(course='', params='', defualt='') {
        console.log(course, params, defualt)
        if(course !== '' && params !== ''){
            $.ajax({
                url: '<?= base_url('helper/course-natures') ?>',
                type: 'post',
                data: {'course':course, "nature":params, 'default':defualt},
                //dataType: 'json',
                async: false,
                success: function(data) {
                    $("#program_nature").html('');
                    $("#program_nature").html(data);
                },
                error: function(){
                    showFire('error', 'Somwthing went wrong server side.');
                }
            })
        }else{
            $("#program_nature").html('');
        }
    }
    console.log($('#program').val(),$('#program').find(':selected').attr('data-nature'));
    //getNature($('#program').val(),$('#program').find(':selected').attr('data-nature'));
    <?php if((old('program')??($studentInfo['program_id']  ?? ( $leadInfo['lead_programe'] ??'')))!=''): 
    	$oldNature = old('nature')?json_encode(old('course_type')):false;
        $default = (old('nature')??($studentInfo['si_course_nature']??''))==2?($oldNature?$$oldNature:($studentInfo['si_stream_group']??'')):(old('course_type')??$studentInfo['si_stream_group']??'');
    ?>
        getNature('<?= (old('program')??($studentInfo['program_id']  ?? ( $leadInfo['lead_programe'] ??''))) ?>', $('#program').find(':selected').attr('data-nature'), '<?= $default ?>')
        $('#nature').val($('#program').find(':selected').attr('data-nature'))
    <?php endif; ?>
</script>