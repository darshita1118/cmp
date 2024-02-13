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
    return $departmentModel->select(['dept_id','dept_name'])->where(['dept_status'=>1, 'dept_delete_status'=>0])->findAll()??[];
}

function getProgram($dept)
{
    $programModel = new ApplicationModel('session_courses_'.session('year'), 'sc_id', 'sso_' . session('suffix'));
    return $programModel->select(['course_code','course_name', 'course_nature', 'sc_id as coi_id', 'validation_level', 'course_type', 'dept_id', 'level_id'])->join('course_info', 'course_info.coi_id=session_courses_'. session('year') . '.course_id')->where(['sc_course_delete'=>0])->where(['sc_course_status'=>1, 'course_delete_status'=>0, 'dept_id'=>$dept])->findAll()??[];
}
function getLeadInfo($lid)
{
    $leadModel = new ApplicationModel('lead_profile_'.session('year'),'lid', session('db_priffix').'_'.session('suffix'));
    return $leadModel->where(['lid'=>$lid])->first()??[];
}



$leadInfo = getLeadInfo($lid);
$studentInfo = getStudentInfo($sid);
$departments = getDepartments();
$programs = getProgram($studentInfo['dept_id']);

$modelStudentLogin = new ApplicationModel('student_login_'.session('year'), 'sl_id', 'sso_' . session('suffix'));
$studentLoginDetail = $modelStudentLogin->where(['sid'=>$sid])->first()??[];

$studentRegFeeModel = new ApplicationModel('student_registration_fees', 'srf_id', 'sso_' . session('suffix'));
$feeDetail = $studentRegFeeModel->select(['amount'])->where(['srf_id'=>$studentLoginDetail['student_reg_fee_id']])->first()??[];
$encrypter = \Config\Services::encrypter();
$encryptedAmt = base64_encode($encrypter->encrypt($feeDetail['amount']??'500.00'));
?>
<form class="form" id="kt_forms" action="<?= base_url('payment-initiated/'.$lid.'/'.$sid) ?>"  method="post">
	<?= csrf_field() ?>
    <input type="hidden" name="nature" id="nature" value="<?= old('nature')??($studentInfo['si_course_nature']??'') ?>">
    <input type="hidden" name="amount" value="<?= $encryptedAmt ?>">
    <div class="font-weight-bold text-dark d-block d-lg-none"><h4>Payment</h4></div>
    <!--begin::Wizard Step 1-->
    <div class="pb-5">
        <h3 class="mb-10 font-weight-bold text-dark text-left">Application Payment:
            <b>₹</b>&nbsp;<span><b><?= $deCryptAmt ?></b></span>
        </h3>
        <div class="row">
            <div class="col-xl-4">
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
                    <span class="form-text text-danger "><?= \Config\Services::validation()->showError('discipline'); ?></span>
                </div>
                <!--end::Select-->
            </div>
            <div class="col-xl-4">
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
                    <span class="form-text text-danger "><?= \Config\Services::validation()->showError('program'); ?></span>
                </div>
                <!--end::Select-->
            </div>
            
            <div class="col-xl-4">
                <div class="form-group" id="program_nature">

                </div>
            </div>
            <div class="col-lg-12 border-top">
                <div class="my-3"><b>Note:</b></div>
                <p>Incase you opt to pay through online, you have to pay the application
                    fee online through netbanking, credit card and debit card etc. You
                    will get a receipt on your registered mail id. Incase your
                    transaction does not successful you can pay through login you
                    account using your sid and password.</p>
            </div>
        </div>
    </div>
    <!--begin::Wizard Actions-->
    <div class="d-flex justify-content-between border-top mt-5 pt-5">
        <div class="ml-auto">
            <button type="submit" class="btn btn-primary font-weight-bolder text-uppercase" value="payment"
                    name="btn">Pay Online</button>
        </div>
    </div>
    <!--end::Wizard Actions-->
</form>

<script>
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
    //getNature($('#program').val(),$('#program').find(':selected').attr('data-nature'));
    <?php if((old('program')??($studentInfo['program_id']  ?? ( $leadInfo['lead_programe'] ??'')))!=''): 
    	$oldNature = old('nature')?json_encode(old('course_type')):false;
        $default = (old('nature')??($studentInfo['si_course_nature']??''))==2?($oldNature?$$oldNature:($studentInfo['si_stream_group']??'')):(old('course_type')??$studentInfo['si_stream_group']??'');
    ?>
        getNature('<?= (old('program')??($studentInfo['program_id']  ?? ( $leadInfo['lead_programe'] ??''))) ?>', $('#program').find(':selected').attr('data-nature'), '<?= $default ?>')
        $('#nature').val($('#program').find(':selected').attr('data-nature'))
    <?php endif; ?>
</script>