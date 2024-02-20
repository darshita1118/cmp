<?php

use App\Models\ApplicationModel;

$formStep = [
    '1' => 'Payment',
    '2' => 'Payment Done and now in Profile Step.',
    '3' => 'Profile Done and now in Academic Step.',
    '4' => 'Academic Step done and Document Upload step.',
    '5' => 'Document Uploaded and now in Review step.',
    '6' => 'Review is Done and now in Scrutinizer Desk.',
    '7' => 'Scutinizer Desk given status Cleared then now go to Senior Desk.',
    '8' => 'Senior Desk given status cleared then go to Finance Desk.',
    '9' => 'Finance Desk cleared status then go to Verify Desk.',
    '10' => 'Verify Desk cleared status then go to Enrollment Desk.',
    '11' => 'Enrollment Desk cleared then your Admission done.',
];

function checkSidCreated($lead_id)
{
    $referModel = new ApplicationModel('lms_db_reference_' . session('year'), 'lr_id', 'sso_' . session('suffix'));
    $sidDetail = $referModel->select(['lms_db_reference_' . session('year') . '.sid', 'form_step', 'handler_id', 'password'])->join('student_login_' . session('year'), 'student_login_' . session('year') . '.sid=lms_db_reference_' . session('year') . '.sid')->where('lead_id', $lead_id)->where('admin_type', session('db_priffix'))->first();
    return $sidDetail ? $sidDetail : [];
}
function getMessage($leadId)
{
    $statusInfoModel = new ApplicationModel('lead_status_' . session('year'), 'ls_id', session('db_priffix') . '_' . session('suffix'));
    return $statusInfoModel->select(['message', 'ls_time', 'ls_date'])->where(['lead_id' => $leadId])->first() ?? '';
}

function getHandlerList($notIn = [])
{
    $handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', 'reg_setting_db');
    $handlers = $handlerModel->select(['lu_id', 'user_name', 'user_role', 'user_report_to'])->where(['user_status' => 1, 'user_deleted_status' => 0, 'user_report_to' => session('id')]);
    if (!empty($notIn)) {
        $handlers->whereNotIn('lu_id', $notIn);
    }
    return $handlers->findAll() ?? [];
}
function getSinglehandler($handler)
{
    $handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', 'reg_setting_db');
    $handler = $handlerModel->select(['user_name'])->where('lu_id', $handler)->first();
    return $handler ? $handler['user_name'] : '';
}

function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

$handlers = getHandlerList([session('id')]);


$getMessage = getMessage($profileDetail['lid']);

$name = ucwords(trim($profileDetail['lead_first_name'] . ' ' . $profileDetail['lead_middle_name'] . ' ' . $profileDetail['lead_last_name']));

?>
<link href="<?= base_url('assets/plugins/select2/dist/css/select2.min.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>

<!-- Time -->
<!-- required files -->
<link href="<?= base_url('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') ?>"></script>


<!-- date -->
<link href=" <?= base_url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') ?>" rel="stylesheet" />

<script src=" <?= base_url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') ?>"></script>

<style>
    .timeline::before {
        left: 0;
    }

    .timeline .timeline-icon {
        position: absolute;
        width: 0;
        left: -10px;
    }

    .timeline .timeline-content {
        margin-left: 25px;
    }

    .timeline .timeline-content {
        background-color: #e1e1e1;
    }

    .timeline .timeline-content::before {
        border-right-color: #e1e1e1;
    }

    @media (max-width: 575.98px) {
        .timeline .timeline-content:before {
            top: 22px;
            left: 0;
            margin-left: -20px;

        }

        .timeline .timeline-content {
            margin-top: 0;
        }
    }
</style>

<div class="profile container-fluid p-3">
    <div class="row gx-4">

        <div class="col-xl-8 mb-xl-0">
            <div class="panel panel-inverse card border-0 ">
                <div class="card-header bg-none p-3 h5 m-0 d-flex align-items-center">
                    <i class="fa fa-pen-to-square fa-lg me-2 text-gray text-opacity-50"></i>
                    Profile
                </div>
                <div class="panel-body card-body p-3 text-dark fw-bold" style="overflow-y: scroll; height:60vh;">

                    <div id="bsSpyContent">
                        <div id="general">
                            <h4 class="d-flex align-items-center mb-2">
                                <span class="iconify fs-24px me-2 text-body text-opacity-75" data-icon="solar:user-bold-duotone"></span> Profile Details
                            </h4>
                            <p>View and update your Profile Details information.</p>
                            <div class="table-responsive form-inline">
                                <table class="table table-profile align-middle">
                                    <tbody>
                                        <tr class="highlight">
                                            <td class="field">Name</td>
                                            <td>
                                                <div class="text-body text-opacity-60"> <?= $name ?></div>
                                            </td>
                                        </tr>
                                        <tr class="highlight">
                                            <td class="field">Program</td>
                                            <td>
                                                <div class="text-body text-opacity-60"> <?= $profileDetail['coursename'] ?></div>
                                            </td>
                                        </tr>
                                        <tr class="highlight">
                                            <?php if ($sidData = checkSidCreated($profileDetail['lid'])) :  ?>
                                                <td class="field">SID/Password</td>
                                                <td>
                                                    <div class="text-body text-opacity-60"><?= $sidData['sid'] . '/' . base64_decode($sidData['password']) ?></div>
                                                </td>
                                        </tr>
                                        <tr class="highlight">
                                            <td class="field">Form Step</td>
                                            <td>
                                                <div class="text-body text-opacity-60"> <?= $formStep[$sidData['form_step']] ?? '' ?>
                                                    <?php if ($sidData['form_step'] <= 6) : ?>
                                                        <a href="<?= base_url('admin/process-application/' . $profileDetail['lid'] . '/' . $sidData['sid']) ?>" class="btn btn-sm btn-success me-1 float-end"> <i class="fa fa-shuffle"></i> Proceed Application</a>
                                                    <?php else : ?>
                                                        <a href="<?= base_url('admin/process-application/' . $profileDetail['lid'] . '/' . $sidData['sid']) ?>" class="btn btn-sm btn-success me-1 float-end"> <i class="fa fa-shuffle"></i> Application Under Process</a>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <a href="<?= base_url('admin/apply-now/' . $profileDetail['lid']) ?>" class="btn btn-sm btn-success me-1 float-end"> <i class="fa fa-shuffle"></i>Generate Sid</a>
                                                <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="highlight">
                                            <td class="field">Email</td>
                                            <td>
                                                <div class="text-body text-opacity-60"> <a href="mailto:<?= $profileDetail['lead_email'] ?>" class="text-muted text-hover-primary"><?= $profileDetail['lead_email'] ?></a></div>
                                            </td>
                                        </tr>
                                        <tr class="highlight">
                                            <td class="field">Moblie</td>
                                            <td>
                                                <div class="text-body text-opacity-60"><a href="tel:<?= $profileDetail['lead_country_code'] . $profileDetail['lead_mobile'] ?>" class="text-muted text-hover-primary">(<?= $profileDetail['lead_country_code'] ?>)<?= $profileDetail['lead_mobile'] ?></a></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="academics">
                            <h4 class="d-flex align-items-center mb-2 mt-3">
                                <span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:square-academic-cap-bold-duotone"></span>
                                Academics
                            </h4>
                            <p>Review and update your Academic Profile details.</p>
                            <div class="table-responsive form-inline">
                                <table class="table table-profile align-middle">
                                    <tbody>
                                        <tr class="highlight">
                                            <form class="form" method="post" action="">
                                                <?= csrf_field() ?>
                                                <td class="field">
                                                    <div class="form-group">
                                                        <label for="status">Lead
                                                            Status</label>

                                                        <select class="form-control form-control-solid" id="status" name="status" required="" onchange="getInfoProfile($(this).find(':selected').attr('data-getinfo')
                                                    );">
                                                            <?php foreach ($status_list as $status) : ?>
                                                                <option data-statusscore='<?= $status['score'] ?>' data-getinfo='<?= $status['status_get_more_info'] ?>' value="<?= $status['status_id'] ?>" <?= (old('status') ?? $profileDetail['lead_status']) == $status['status_id'] ? 'selected' : null ?>><?= $status['status_name'] ?> </option>
                                                            <?php endforeach; ?>

                                                        </select>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-body text-opacity-60">
                                                        <label for="">&nbsp;</label>
                                                        <button class="form-control btn btn-primary font-weight-bold btn-sm" name="btn" type="submit" value="update-status">Update</button>
                                                    </div>
                                                </td>
                                            </form>
                                        </tr>
                                        <tr class="highlight">
                                            <form class="form" method="post" action="">
                                                <?= csrf_field() ?>
                                                <td class="field">
                                                    <div class="form-group">
                                                        <label for="program">Program:</label>
                                                        <select type="text" id="program" name="program" onchange="$('#level').val($(this).find(':selected').attr('data-level')); $('#dept').val($(this).find(':selected').attr('data-dept'));" class="form-control form-control-solid default-select2" required="">
                                                            <option value="">--select program--</option>
                                                            <?php foreach ($courses as $course) : ?>
                                                                <option data-level='<?= $course['level_id'] ?>' data-dept='<?= $course['dept_id'] ?>' value="<?= $course['coi_id'] ?>" <?= (old('program') ?? $profileDetail['lead_programe']) == $course['coi_id'] ? 'selected' : null ?>><?= $course['course_name'] ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <input type="hidden" name="level" value="5" id="level">
                                                        <input type="hidden" name="dept" value="16" id="dept">

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-body text-opacity-60">
                                                        <div class="form-group">
                                                            <label for="">&nbsp;</label>

                                                            <button class="form-control btn btn-primary btn-sm font-weight-bold" type="submit" name="btn" value="lead-program">Update</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </form>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div id="studentinfo">
                            <h4 class="d-flex align-items-center mb-2 mt-3">
                                <span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:square-academic-cap-bold-duotone"></span>
                                Student Info
                            </h4>
                            <p>Review and update your Academic Profile details.</p>
                            <div class="table-responsive form-inline">
                                <table class="table table-profile align-middle">
                                    <tbody>
                                        <tr class="highlight">
                                            <form class="form" method="post" action="">
                                                <?= csrf_field() ?>
                                                <td class="field">
                                                    <div class="row">
                                                        <div class="flex-fill col-md-4">
                                                            <label for="firstname">First Name:</label>
                                                            <input type="text" id="firstname" name="firstname" class="form-control " placeholder="Enter first name" value="<?= old('firstname') ?? $profileDetail['lead_first_name'] ?>" required>
                                                        </div>
                                                        <div class="flex-fill col-md-4">
                                                            <label for="middlename">Middle Name:</label>
                                                            <input type="text" id="middlename" name="middlename" class="form-control " placeholder="Enter last name" value="<?= old('middlename') ?? ($profileDetail['lead_middle_name'] ?? '') ?>">
                                                        </div>
                                                        <div class="flex-fill col-md-4">
                                                            <label for="lastname">Last Name:</label>
                                                            <input type="text" id="lastname" name="lastname" class="form-control " placeholder="Enter last name" value="<?= old('lastname') ?? ($profileDetail['lead_last_name'] ?? '') ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-body text-opacity-60">
                                                        <label for="">&nbsp;</label>
                                                        <button class="form-control btn btn-primary btn-sm font-weight-bold" name="btn" type="submit" value="update-name">Update</button>
                                                    </div>
                                                </td>
                                            </form>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer bg-none d-flex p-3">
                    <h4 class="d-flex align-items-center">
                        <span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:add-circle-bold-duotone"></span>
                        More Action and Information
                    </h4>
                    <a data-bs-target="#modalaltrcont" data-bs-toggle="modal" class="btn btn-default ms-auto">Alternate Contact</a>
                    <a data-bs-target="#modaltrnld" data-bs-toggle="modal" class="btn btn-warning ms-2">Transfer Lead</a>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card border-0 mb-4">
                <div class="card-header bg-none p-3 h5 m-0 d-flex align-items-center">
                    <span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:call-chat-bold-duotone"></span>
                    Contact
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <a href="https://web.whatsapp.com/send?phone=<?= trim($profileDetail['lead_country_code'] . $profileDetail['lead_mobile']) ?>" target="_blank" class="widget-icon rounded bg-success me-4  text-white text-decoration-none">
                            <i class="fa-brands fa-whatsapp fs-30px"></i>
                        </a>
                        <a href="tel:<?= $profileDetail['lead_country_code'] . $profileDetail['lead_mobile'] ?>" class="widget-icon rounded bg-success me-4  text-white text-decoration-none">
                            <i class="fa-solid fa-phone fs-2"></i>
                        </a>
                        <div class="widget-icon rounded bg-success me-4  text-white text-decoration-none">
                            <div data-bs-target="#modalmail" data-bs-toggle="modal"><i class="fa-solid fa-envelope fs-27px"></i></div>
                            <div class="modal fade" id="modalmail">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark">SEND Email</h5>
                                            <button type="button" class="btn-close fs-4" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="">
                                                <label class="text-dark h4">Select Email Template</label>
                                                <select class="form-select">...
                                                    <option selected>--Select Email Template-- </option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Handler</option>
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-theme">Save changes</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div href="" class="widget-icon rounded bg-success me-4  text-white text-decoration-none">
                            <div data-bs-target="#modalsms" data-bs-toggle="modal"><i class="fa-solid fa-comment-sms fs-30px"></i></div>

                            <div class="modal fade" id="modalsms">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark">SEND SMS</h5>
                                            <button type="button" class="btn-close fs-4" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="">
                                                <label class="text-dark h4">Select SMS Template</label>
                                                <select class="form-select">...
                                                    <option selected>--Select SMS Template-- </option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Handler</option>
                                                </select>

                                                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-theme">Submit</button>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="media-icon mt-2"><a href="#" class="btn btn-secondary">Write A message</a></div>
                    </div>
                </div>
            </div>
            <div class="card border-0 mb-4">
                <div class="card-header bg-none p-3 h5 m-0 d-flex align-items-center">
                    <span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:file-bold-duotone"></span>
                    History
                </div>
                <div class="card-body  fw-bold" style="overflow-y: scroll; height:250px">
                    <div class="profile-content">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="profile-post">
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <a href="javascript:;">&nbsp;</a>
                                        </div>
                                        <div class="timeline-content ">
                                            <div class="timeline-header">
                                                <div class="username">
                                                    <a href="javascript:;">John Smith <i class="fa fa-check-circle text-blue ms-1"></i></a>
                                                    <div class="text-muted fs-12px"><span class="date">today</span>
                                                        <span class="time">04:20</span> <i class="fa fa-globe-americas opacity-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <small> Enquery For: DIPLOMA</small><br>
                                                <small>lead status: Not Given</small><br>
                                                <small>Source Of Lead: : Apply Now</small><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>



<!-- Contact_Alternet Model -->
<div class="modal fade" id="modalaltrcont">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alternet Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="flex-fill col-md-4">
                            <label for="firstname">First Name:</label>
                            <input type="text" id="firstname" name="firstname" class="form-control " placeholder="Enter first name" value="<?= old('firstname') ?? $profileDetail['lead_first_name'] ?>" required>
                        </div>
                        <div class="flex-fill col-md-4">
                            <label for="middlename">Middle Name:</label>
                            <input type="text" id="middlename" name="middlename" class="form-control " placeholder="Enter last name" value="<?= old('middlename') ?? ($profileDetail['lead_middle_name'] ?? '') ?>">
                        </div>
                        <div class="flex-fill col-md-4">
                            <label for="lastname">Last Name:</label>
                            <input type="text" id="lastname" name="lastname" class="form-control " placeholder="Enter last name" value="<?= old('lastname') ?? ($profileDetail['lead_last_name'] ?? '') ?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn" class="btn btn-theme" value="update-name">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Transfer Lead Model -->
<div class="modal fade" id="modaltrnld">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transfer Lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="flex-fill col-md-4">
                            <label for="handler">Choose Handler:</label>
                            <select id="handler" name="handler" class="form-control form-control-lg form-control-solid" required="">
                                <option value="">--Choose Handler--</option>
                                <?php foreach ($handlers as $handler) : ?>
                                    <option value="<?= $handler['lu_id'] ?>"><?= $handler['user_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button name='btn' type="submit" value="transfer" class="btn btn-theme" value="update-name">Save changes</button>
            </div>
        </div>
    </div>
</div>










<script>
    $("#timepicker").timepicker();
    $(".default-select2").select2();
    $("#datepicker-autoClose").datepicker({
        todayHighlight: true,
        autoclose: true
    });
</script>

<script src="<?= base_url('assets/js/iconify.min.js') ?>" type="text/javascript"></script>
<script>
    const base_url = '<?= base_url() ?>'
</script>
<script src="<?= base_url('assets/js/custum.js') ?>"></script>

<script>
    let stateList = [];

    function getAttachment(params) {
        if (params == 1) {
            $('#attachment').html(`<label for="attach">Select Email Template:</label>
                            <select id="attach" name="attachment" class="form-control form-control-solid"  required>
                                <option value="">--Select Attachment Template--</option>
                                
                            </select>`).addClass('form-group col-lg-12')
        } else {
            $('#attachment').text("No Attachment").addClass('form-group col-lg-12')
        }
    }

    function getStateList(params = '', dist = '') {
        $.ajax({
            url: base_url + '/assets/json/india.json',
            type: 'get',
            dataType: 'JSON',
            async: false,
            success: function(result) {
                stateList = result
                $('#state').html(`<option value="">--select state--</option>`);

                for (let index = 0; index < result.length; index++) {
                    const stateIndex = index;
                    if (params == result[index].state) {
                        $('#state').append($('<option>', {
                            value: result[index].state,
                            "data-index": index,
                            text: result[index].state,
                            selected: true,
                        }))
                        getDistrictList(stateIndex, dist)
                    } else {
                        $('#state').append($('<option>', {
                            value: result[index].state,
                            "data-index": index,
                            text: result[index].state,
                        }))
                    }

                }

            },
            error: function() {
                //console.log(result)
                showFire(`error`, `Something Went Wrong on Server Side`);
            }

        });
        return
    }

    function getDistrictList(stateId = '', district = '') {

        var districts = stateList[stateId].districts;
        $('#district').html(`<option value="">--select state--</option>`);
        for (let index = 0; index < districts.length; index++) {
            if (district == districts[index]) {
                $('#district').append($('<option>', {
                    value: districts[index],
                    text: districts[index],
                    selected: true,
                }))
            } else {
                $('#district').append($('<option>', {
                    value: districts[index],
                    text: districts[index],
                }))
            }

        }
        return;
    }

    function countrySelect(p, s = '', d = '') {
        $.ajax({
            url: base_url + '/helper/countrySelect',
            type: 'POST',
            data: {
                'country': p,
                'dist': d
            },
            async: false,
            success: function(result) {
                //console.log(result)
                $('#countryType').html('');
                $('#countryType').html(result);
                if (p == 'India') {
                    $('#zipcode').prop('required', true)
                    getStateList(s, d)
                } else {
                    $('#zipcode').prop('required', false)
                }
            },
            error: function() {
                //console.log(result)
                showFire(`error`, `Something Went Wrong on Server Side`);
            }
        })
        return;
    }
    <?php if (old('country') || isset($address['la_country'])) : ?>
        <?php if ((old('country') ?? ($address['la_country'] ?? '')) == 'India') : ?>
            countrySelect(`<?= old('country') ?? ($address['la_country'] ?? '') ?>`, `<?= old('state') ?? ($address['la_state'] ?? '') ?>`, `<?= old('district') ?? ($address['la_district'] ?? '') ?>`)
        <?php else : ?>
            countrySelect(`<?= old('country') ?? ($address['la_country'] ?? '') ?>`, ``, `<?= old('district') ?? ($address['la_district'] ?? '') ?>`)
        <?php endif; ?>
    <?php else : ?>
        countrySelect($('#country').val())
    <?php endif; ?>
    <?php if (old('program') || (isset($profileDetail['lead_programe']) && !empty($profileDetail['lead_programe']))) : ?>
        $('#level').val($('#program').find(':selected').attr('data-level'));
        $('#dept').val($('#program').find(':selected').attr('data-dept'))
    <?php endif; ?>

    <?php if (session('addressError')) : ?>
        $('#addressModel').modal('show')
    <?php endif; ?>
    <?php if (old('status') !== 0 && old('statusinfo')) : ?>
        console.log('te')
        getInfoProfile('<?= old('statusinfo') ?>', '<?= old('message') ?>', '<?= old('date') ?>', '<?= old('time') ?>');
    <?php else : ?>
        console.log('tes')

        getInfoProfile($('#status').find(':selected').attr('data-getinfo'), '<?= $getMessage['message'] ?? '' ?>', '<?= $getMessage['ls_date'] ?? '' ?>', '<?= $getMessage['ls_time'] ?? '' ?>');
    <?php endif; ?>
    <?php if (session('alterError')) : ?>
        $('#alternatecontact').modal('show')
    <?php endif; ?>
    <?php if (session('transferError')) : ?>
        $('#transferlead').modal('show')
    <?php endif; ?>
</script>