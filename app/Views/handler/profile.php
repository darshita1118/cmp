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
<style>
    input {
        margin-bottom: 10px;
    }
</style>

<!-- Content -->

<div class="panel panel-inverse">

    <div class="panel-heading">
        <ol class="breadcrumb panel-title">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Leads</a></li>
            <li class="breadcrumb-item active">Lead</li>
            <div class="p-2">
                <span class="badge bg-warning text-white rounded-pill fs-6">34567</span>
            </div>
        </ol>


        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-sm btn-icon btn-danger" title="Next Lead"><i class="fa fa-arrow-circle-right"></i></a>
        </div>

    </div>



    <div class="panel-body">
        <div class="profile">
            <div class="row gx-4">

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-pen-to-square fa-lg me-2 text-gray text-opacity-50"></i>
                            Profile
                        </div>
                        <div class="card-body fw-bold">
                            <div id="bsSpyContent">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div id="general">
                                            <h4 class="d-flex align-items-center mb-2">
                                                <span class="iconify fs-24px me-2 text-body text-opacity-75" data-icon="solar:user-bold-duotone"></span> Profile Details
                                            </h4>
                                            <hr>
                                            <div class="table-responsive form-inline overflow-hidden">
                                                <table class="table table-profile align-middle">
                                                    <tbody>
                                                        <tr class="highlight">
                                                            <td class="field">Name</td>
                                                            <td>
                                                                <div class="text-body text-opacity-60"> <?= $name ?></div>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-sm btn-warning me-1 btn-icon" title="Edit Name" data-bs-target="#modalname" data-bs-toggle="modal"> <i class="fa fa-pen-to-square"></i></a>
                                                            </td>

                                                        </tr>
                                                        <tr class="highlight">
                                                            <td class="field">Program</td>
                                                            <td>
                                                                <div class="text-body text-opacity-60"> <?= $profileDetail['coursename'] ?></div>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-sm btn-warning me-1 btn-icon" title="Edit Program" data-bs-target="#modalprog" data-bs-toggle="modal"> <i class="fa fa-pen-to-square"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr class="highlight">

                                                            <td class="field">Lead Status</td>
                                                            <td>
                                                                <div class="text-body text-opacity-60">
                                                                    Not Given
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-sm btn-warning me-1 btn-icon" title="Add Lead Status" data-bs-target="#modalleadst" data-bs-toggle="modal"> <i class="fa fa-pen-to-square"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr class="highlight">
                                                            <?php if ($sidData = checkSidCreated($profileDetail['lid'])) :  ?>
                                                                <td class="field">SID/Password</td>
                                                                <td>
                                                                    <div class="text-body text-opacity-60"><?= $sidData['sid'] . '/' . base64_decode($sidData['password']) ?></div>
                                                                </td>
                                                                <td></td>
                                                        </tr>
                                                        <tr class="highlight">
                                                            <td class="field">Form Step</td>
                                                            <td>
                                                                <div class="text-body text-opacity-60"> <?= $formStep[$sidData['form_step']] ?? '' ?>
                                                                    <?php if ($sidData['form_step'] <= 6) : ?>
                                                                        <a href="<?= base_url('admin/process-application/' . $profileDetail['lid'] . '/' . $sidData['sid']) ?>" class="btn btn-sm btn-warning me-1 btn-icon" title="Next Step"> <i class="fa fa-file-pen"></i> Proceed Application</a>
                                                                    <?php else : ?>
                                                                        <a href="<?= base_url('admin/process-application/' . $profileDetail['lid'] . '/' . $sidData['sid']) ?>" class="btn btn-sm btn-warning me-1 btn-icon" title="Next Step"> <i class="fa fa-file-pen"></i> Application Under Process</a>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <a href="<?= base_url('admin/apply-now/' . $profileDetail['lid']) ?>" class="btn btn-sm btn-warning me-1 btn-icon" title="Next Step"> <i class="fa fa-file-pen"></i>Generate Sid</a>
                                                                <?php endif; ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-sm btn-warning me-1 btn-icon" title="Next Form Step"> <i class="fa fa-file-pen"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr class="highlight">
                                                            <td class="field">Email</td>
                                                            <td>
                                                                <div class="text-body text-opacity-60"> <a href="mailto:<?= $profileDetail['lead_email'] ?>" class="text-muted text-hover-primary"><?= $profileDetail['lead_email'] ?></a></div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr class="highlight">
                                                            <td class="field">Moblie</td>
                                                            <td>
                                                                <div class="text-body text-opacity-60"><a href="tel:<?= $profileDetail['lead_country_code'] . $profileDetail['lead_mobile'] ?>" class="text-muted text-hover-primary">(<?= $profileDetail['lead_country_code'] ?>)<?= $profileDetail['lead_mobile'] ?></a></div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <h4 class="d-flex align-items-center mb-2">
                                            <span class="iconify fs-24px me-2 text-body text-opacity-75" data-icon="solar:call-chat-bold-duotone"></span> Contact
                                        </h4>
                                        <hr>

                                        <div class="card-body">
                                            <div class="d-flex flex-wrap">
                                                <a href="https://web.whatsapp.com/send?phone=<?= trim($profileDetail['lead_country_code'] . $profileDetail['lead_mobile']) ?>" target="_blank" class="widget-icon rounded bg-success me-2  text-white text-decoration-none">
                                                    <i class="fa-brands fa-whatsapp"></i>
                                                </a>
                                                <a href="tel:<?= $profileDetail['lead_country_code'] . $profileDetail['lead_mobile'] ?>" class="widget-icon rounded bg-success text-white text-decoration-none me-2">
                                                    <i class="fa fa-phone"></i>
                                                </a>
                                                <div class="widget-icon rounded bg-success me-2  text-white text-decoration-none">
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
                                                <div class="widget-icon rounded bg-success me-2  text-white text-decoration-none">
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
                                                <a href="#" target="_blank" class="widget-icon rounded bg-success me-2  text-white text-decoration-none">
                                                    <i class="fa fa-commenting"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4 class="d-flex align-items-center mb-2">
                                            <span class="iconify fs-24px me-2 text-body text-opacity-75" data-icon="solar:cardholder-bold-duotone"></span> More Actions & Information
                                        </h4>
                                        <hr>

                                        <div class="card-body">
                                            <div>
                                                <div data-toggle="modal" data-target="#alternatecontact" class="d-flex align-items-center mb-2 px-2 py-2" style="cursor: pointer;background: #efefef; border-radius: 5px;">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-35 symbol-light mr-4">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                                        <path d="M17,2 L19,2 C20.6568542,2 22,3.34314575 22,5 L22,19 C22,20.6568542 20.6568542,22 19,22 L17,22 L17,2 Z" fill="#000000" opacity="0.3"></path>
                                                                        <path d="M4,2 L16,2 C17.6568542,2 19,3.34314575 19,5 L19,19 C19,20.6568542 17.6568542,22 16,22 L4,22 C3.44771525,22 3,21.5522847 3,21 L3,3 C3,2.44771525 3.44771525,2 4,2 Z M11.1176481,13.709585 C10.6725287,14.1547043 9.99251947,14.2650547 9.42948307,13.9835365 C8.86644666,13.7020183 8.18643739,13.8123686 7.74131803,14.2574879 L6.2303083,15.7684977 C6.17542087,15.8233851 6.13406645,15.8902979 6.10952004,15.9639372 C6.02219616,16.2259088 6.16377615,16.5090688 6.42574781,16.5963927 L7.77956724,17.0476658 C9.07965249,17.4810276 10.5130001,17.1426601 11.4820264,16.1736338 L15.4812434,12.1744168 C16.3714821,11.2841781 16.5921828,9.92415954 16.0291464,8.79808673 L15.3965752,7.53294436 C15.3725414,7.48487691 15.3409156,7.44099843 15.302915,7.40299777 C15.1076528,7.20773562 14.7910703,7.20773562 14.5958082,7.40299777 L13.0032662,8.99553978 C12.5581468,9.44065914 12.4477965,10.1206684 12.7293147,10.6837048 C13.0108329,11.2467412 12.9004826,11.9267505 12.4553632,12.3718698 L11.1176481,13.709585 Z" fill="#000000"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column flex-grow-1">
                                                        <div class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
                                                            Alternate Contact</div>

                                                    </div>
                                                    <!--end::Text-->

                                                </div>
                                                <a data-bs-target="#modalaltrcont" data-bs-toggle="modal" class="btn btn-success mt-1 w-100">Address</a>
                                                <a data-bs-target="#modalaltrcont" data-bs-toggle="modal" class="btn btn-default mt-1 w-100">Alternate Contact</a>
                                                <a data-bs-target="#modaltrnld" data-bs-toggle="modal" class="btn btn-warning mt-1 w-100">Transfer Lead</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card" style="overflow-y: scroll; height: 75vh;">
                        <div class="card-header">
                            <span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:file-bold-duotone"></span>
                            History
                        </div>
                        <div class="card-body fw-bold">
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
    </div>
</div>
</div>

<!-- End Content -->





<!-- Name Model -->
<div class="modal fade" id="modalname">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Name</h5>
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
                <button type="submit" name="btn" class="btn btn-theme" type="submit" value="update-name">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Program Model -->
<div class="modal fade" id="modalprog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Program</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <form class="form" method="post" action="">
                    <?= csrf_field() ?>
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
                    <div class="text-body text-opacity-60">
                        <div class="form-group">
                            <label for="">&nbsp;</label>

                            <button class="form-control btn btn-success btn-sm font-weight-bold" type="submit" name="btn" value="lead-program"><i class="fa fa-check"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn" class="btn btn-theme" type="submit" value="lead-program">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Lead Status Model -->
<div class="modal fade" id="modalleadst">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Lead Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="status_lead">
                    <form class="form" method="post" action="">
                        <?= csrf_field() ?>
                        <td class="field">
                            <div class="form-group">
                                <label for="status">Lead
                                    Status</label>

                                <select class="form-control form-control-solid default-select2" id="status" name="status" required="" onchange="getInfoProfile($(this).find(':selected').attr('data-getinfo')
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
                                <button class="form-control btn btn-success font-weight-bold btn-sm" name="btn" type="submit" value="update-status">
                                    <i class="fa fa-check"></i>
                                </button>
                            </div>
                        </td>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn" class="btn btn-theme" type="submit" value="lead-program">Save Changes</button>
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
                        <div class="flex-fill col-md-6">
                            <label for="firstname">Name:</label>
                            <input type="text" id="firstname" name="firstname" class="form-control " placeholder="Enter first name" value="<?= old('firstname') ?? $profileDetail['lead_first_name'] ?>" required>
                        </div>
                        <div class="flex-fill col-md-6">
                            <label for="middlename">Number:</label>
                            <input type="text" id="middlename" name="middlename" class="form-control " placeholder="Enter last name" value="<?= old('middlename') ?? ($profileDetail['lead_middle_name'] ?? '') ?>">
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

    $('#modalprog').on('shown.bs.modal', function() {
        $(".default-select2").select2({
            dropdownParent: $('#modalprog')
        });
    });
    $("#datepicker-autoClose").datepicker({
        todayHighlight: true,
        autoclose: true
    });
</script>

<script src="<?= base_url('assets/js/iconify.min.js') ?>" type="text/javascript"></script>
<!-- required files -->
<script src="<?= base_url() ?>assets/plugins/ionicons/dist/ionicons/ionicons.js"></script>
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