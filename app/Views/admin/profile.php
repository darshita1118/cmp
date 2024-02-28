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
$lmsDb = session('db_priffix') . '_' . session('suffix');
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
                                                                    <?php $newArray = array_column($status_list, 'status_name', 'status_id'); ?>
                                                                    <?= $newArray[$profileDetail['lead_status']]; ?>
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

                                                            <?php if ($sidData['form_step'] <= 6) : ?>
                                                                <td>
                                                                    <div class="text-body text-opacity-60"> <?= $formStep[$sidData['form_step']] ?? '' ?>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('admin/process-application/' . $profileDetail['lid'] . '/' . $sidData['sid']) ?>" class="btn btn-sm btn-warning me-1 btn-icon" title="Proceed Application"> <i class="fa fa-file-pen"></i> Proceed Application</a>
                                                                </td>
                                                            <?php else : ?>
                                                                <td>
                                                                    <div class="text-body text-opacity-60"> <?= $formStep[$sidData['form_step']] ?? '' ?>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url('admin/process-application/' . $profileDetail['lid'] . '/' . $sidData['sid']) ?>" class="btn btn-sm btn-warning me-1 btn-icon" title="Application Under Process"> <i class="fa fa-file-pen"></i> Application Under Process</a>
                                                                </td>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <td class="field">Form Step</td>
                                                            <td>
                                                                <div class="text-body text-opacity-60">Generate Sid

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="<?= base_url('admin/apply-now/' . $profileDetail['lid']) ?>" class="btn btn-sm btn-warning me-1 btn-icon" title="Generate Sid"> <i class="fa fa-file-pen"></i>Generate Sid</a>
                                                            </td>
                                                        <?php endif; ?>


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
                                            <span class="iconify fs-24px me-2 text-body text-opacity-75" data-icon="solar:call-chat-bold-duotone"></span> Contact To
                                        </h4>
                                        <hr>

                                        <div class="card-body">
                                            <div class="d-flex flex-wrap">
                                                <a href="https://web.whatsapp.com/send?phone=<?= trim($profileDetail['lead_country_code'] . $profileDetail['lead_mobile']) ?>" target="_blank" class="widget-icon rounded bg-success me-2  text-white text-decoration-none" title="Whatsapp">
                                                    <img src="<?= base_url() ?>assets/img/svg/whatsapp.svg" alt="">
                                                </a>
                                                <a href="tel:<?= $profileDetail['lead_country_code'] . $profileDetail['lead_mobile'] ?>" class="widget-icon rounded bg-success text-white text-decoration-none me-2" title="Phone Call">
                                                    <img src="<?= base_url() ?>assets/img/svg/telephone.svg" alt="">
                                                </a>
                                                <div class="widget-icon rounded bg-success me-2  text-white text-decoration-none">
                                                    <div data-bs-target="#modalmail" data-bs-toggle="modal"><img src="<?= base_url() ?>assets/img/svg/envelope-arrow-up.svg" alt=""></div>
                                                    <div class="modal fade" id="modalmail">
                                                        <form class="form" action="" method="post">
                                                            <?= csrf_field() ?>
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-dark">SEND Email</h5>
                                                                        <button type="button" class="btn-close fs-4" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="">
                                                                            <label class="text-dark h4">Select Email Template:</label>
                                                                            <select class="form-select" id="email" name="email" onchange="getAttachment($(this).find(':selected').attr('data-attachment'))" required>
                                                                                <option value="">--Select Email Template--</option>
                                                                                <?php foreach ($emailTemplates as $email) : ?>
                                                                                    <option data-attachment='<?= $email['et_have_attachment'] ?>' value="<?= $email['et_id'] ?>"><?= $email['et_name'] ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div id='attachment'></div>
                                                                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" name='btn' value="sendEmail" class="btn btn-theme">Save changes</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="widget-icon rounded bg-success me-2  text-white text-decoration-none">
                                                    <div data-bs-target="#modalsms" data-bs-toggle="modal"><img src="<?= base_url() ?>assets/img/svg/chat-quote.svg" alt=""></i></div>

                                                    <div class="modal fade" id="modalsms">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-dark">SEND SMS</h5>
                                                                    <button type="button" class="btn-close fs-4" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <form class="form" action="" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <div class="modal-body">
                                                                        <div class="">
                                                                            <label class="text-dark h4">Select SMS Template</label>
                                                                            <select id="sms" name="sms" class="form-select" required>
                                                                                <option value="">--select SMS Template--</option>
                                                                                <?php foreach ($smsTemplates as $sms) : ?>
                                                                                    <option value="<?= $sms['st_id'] ?>"><?= $sms['st_name'] ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>

                                                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" name='btn' value="sendSMS" class="btn btn-theme">Submit</button>

                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn bg-warning me-2  text-white text-decoration-none toggle">
                                                    <img src="<?= base_url() ?>assets/img/svg/stickies-fill.svg" alt=""> Key Notes
                                                </button>
                                                <style>
                                                    /* Note box */
                                                    .right-bottom {
                                                        display: none;
                                                        position: fixed;
                                                        bottom: 20px;
                                                        right: 20px;
                                                        padding: 10px;
                                                        z-index: 999;
                                                        border-radius: 11px;
                                                        background: #fff;
                                                        box-shadow: 20px 20px 60px #bebebe,
                                                            -20px -20px 60px #ffffff;
                                                    }

                                                    .chat-container {
                                                        flex: 1;
                                                        overflow-y: scroll;
                                                        max-height: 50vh;
                                                    }


                                                    .send-button {
                                                        border: none;
                                                        background-color: #00acac;
                                                        color: #fff;
                                                        cursor: pointer;
                                                        border-radius: 50%;
                                                    }

                                                    .message-container {
                                                        margin-bottom: 20px;
                                                    }

                                                    .message {
                                                        background-color: #f2f3f4;

                                                        border-radius: 5px;
                                                        padding: 10px;

                                                    }

                                                    .timestamp {
                                                        color: #6c757d;
                                                        font-size: 10px;
                                                        margin: 5px 0 15px 10px;
                                                    }

                                                    .widget-input-container .widget-input-icon {
                                                        padding: .375rem 0;
                                                        margin-bottom: 10px;
                                                    }

                                                    .widget-input-container .widget-input-icon a {
                                                        display: block;

                                                        font-size: 13px;
                                                        padding: 5px;
                                                    }
                                                </style>

                                                <div class="col-8 col-md-3  right-bottom" id="target">

                                                    <div class="modal-content">
                                                        <!-- note Header -->
                                                        <div class="modal-header border-bottom mb-3">

                                                            <h5 class="text-success">
                                                                <img src="<?= base_url() ?>assets/img/svg/sticky-fill_key.svg" alt="">
                                                                &nbsp;<?= $name ?>
                                                            </h5>
                                                            <a type="button" class="text-success close-btn"><i class="fa fa-x"></i></a>
                                                        </div>

                                                        <!-- note Body -->
                                                        <div class="modal-body">
                                                            <div class="chat-container">

                                                                <!--begin::Messages-->
                                                                <div id="messageContainer" class="message-container">
                                                                    <?php foreach ($remarks as $remark) : ?>
                                                                        <?php if ($remark['handler_id'] == session('unique_id')) : ?>
                                                                            <!--begin::Message Out-->
                                                                            <div class="d-flex flex-column mb-3">
                                                                                <div class="">
                                                                                    <div>
                                                                                        <span class="text-muted font-size-sm"><?= time_elapsed_string($remark['lr_created_at']) ?></span>
                                                                                        <span class="fw-bolder">You</span>
                                                                                    </div>

                                                                                </div>
                                                                                <span class="me-4 bg-green-100 rounded p-2">
                                                                                    <div class="">
                                                                                        <?= $remark['lr_remark'] ?></div>
                                                                                </span>
                                                                                <div class="fst-normal"><small><?= date('l d M Y h:i A', strtotime($remark['lr_created_at'])) ?></small></div>


                                                                            </div>
                                                                            <!--end::Message Out-->
                                                                        <?php else :

                                                                            $handlername = getSinglehandler($remark['handler_id']);

                                                                        ?>
                                                                            <!--begin::Message In-->
                                                                            <div class="d-flex flex-column mb-3 align-items-start">
                                                                                <div class="d-flex align-items-center">

                                                                                    <div>
                                                                                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
                                                                                            <?= $handlername ?>
                                                                                        </a>
                                                                                        <span class="text-muted font-size-sm"><?= time_elapsed_string($remark['lr_created_at']) ?></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">
                                                                                    <?= $remark['lr_remark'] ?></div>
                                                                                <div class="mnt-1 rounded pt-0 text-dark-50 font-weight-bold font-size-lg text-left max-w-400px"><?= date('l d M Y h:i A', strtotime($remark['lr_created_at'])) ?></div>
                                                                            </div>
                                                                            <!--end::Message In-->
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                                <!--end::Messages-->
                                                            </div>

                                                            <!-- Chat-like Input and "Send" Button -->
                                                            <div class="chat-input-container">
                                                                <form action="" method="POST">
                                                                    <?= csrf_field() ?>
                                                                    <div class="widget-input-container">
                                                                        <div class="widget-input-box">
                                                                            <input type="text" name='remarkMessage' id="messageInput" class="form-control chat-input" placeholder="Type your message...">
                                                                        </div>
                                                                        <div class="widget-input-icon">
                                                                            <button type="submit" name="btn" value="remark" class="send-button text-success text-opacity-50">
                                                                                <img src="<?= base_url() ?>assets/img/svg/send-plus-fill.svg" alt="">

                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!-- note box -->
                                                <script>
                                                    $(document).ready(function() {
                                                        $(document).ready(function() {
                                                            $(".toggle").click(function() {
                                                                $("#target").fadeIn();
                                                            });

                                                            $(".close-btn").click(function() {
                                                                $("#target").fadeOut();
                                                            });
                                                        });
                                                        $("#sendButton").click(function() {
                                                            var message = $("#messageInput").val();

                                                            if (message.trim() !== "") {
                                                                // Get the current date and time
                                                                var timestamp = new Date().toLocaleString();

                                                                // Create a new message element with timestamp
                                                                var messageElement = $("<div class='message'>").text(message);
                                                                var timestampElement = $("<div class='timestamp'>").text(timestamp);

                                                                // Append the message and timestamp to the container
                                                                $("#messageContainer").append(messageElement, timestampElement);

                                                                // Clear the input field after sending
                                                                $("#messageInput").val("");

                                                                // Scroll to the bottom of the container
                                                                $(".chat-container").scrollTop($(".chat-container")[0].scrollHeight);
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4 class="d-flex align-items-center mb-2">
                                            <span class="iconify fs-24px me-2 text-body text-opacity-75" data-icon="solar:align-vertical-center-bold-duotone"></span> More Actions & Information
                                        </h4>
                                        <hr>

                                        <div class="card-body">
                                            <div class="float-start">
                                                <a data-bs-target="#modaladdress" style="text-align: start;" data-bs-toggle="modal" class="btn btn-success mt-1 w-80"><img src="<?= base_url() ?>assets/img/svg/house-add.svg" alt=""> Address</a>
                                                <a data-bs-target="#modalaltrcont" style="text-align: start;" data-bs-toggle="modal" class="btn btn-default mt-1 w-80"><img src="<?= base_url() ?>assets/img/svg/person-lines-fill.svg" alt=""> Alternate Contact</a>
                                                <a data-bs-target="#modaltrnld" style="text-align: start;" data-bs-toggle="modal" class="btn btn-warning mt-1 w-80"><img src="<?= base_url() ?>assets/img/svg/box-arrow-up-right.svg" alt=""> Transfer Lead</a>
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
                                            <?php foreach ($remarks as $rmk) :
                                                $remarkTypes = ['Status', 'Source', 'Program', 'Personal Detail', 'Transfer', 'Address', 'Alternative or Contact', 'SMS Send', 'Email Send', 'Remark Message'];
                                                $remarkIcon = ['flaticon-medal', '
                                                    flaticon-customer', 'flaticon-clipboard', 'flaticon-clipboard', 'flaticon-more-v4', 'flaticon-map-location', 'flaticon2-phone', 'flaticon2-sms', 'flaticon2-mail', 'flaticon-interface-2'];
                                                if ($rmk['handler_id'] == session('id')) :
                                                    $handlername = 'You';
                                                else :
                                                    $handlername = getSinglehandler($rmk['handler_id']);
                                                endif;
                                            ?>
                                                <div class="timeline-item">
                                                    <div class="timeline-icon">
                                                        <a href="javascript:;">&nbsp;</a>
                                                    </div>
                                                    <div class="timeline-content ">
                                                        <div class="timeline-header">
                                                            <div class="username">
                                                                <a href="javascript:;"><?= $name ?><i class="fa fa-check-circle text-blue ms-1"></i></a>
                                                                <div class="text-muted fs-12px"><span class="date"><?= date('h:i A l d M Y', strtotime($rmk['lr_created_at'])) ?></span>
                                                                    <i class="fa fa-globe-americas opacity-5 "></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="timeline-body">
                                                            <small><?= $rmk['lr_remark'] ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
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
            <form method="post" action="">
                <?= csrf_field() ?>
                <div class="modal-body">

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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button name="btn" class="btn btn-theme" type="submit" value="update-name">Save Changes</button>
                </div>
            </form>
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
            <form class="form" method="post" action="">
                <?= csrf_field() ?>
                <div class="modal-body">
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn" class="btn btn-theme" type="submit" value="lead-program">Save Changes</button>
                </div>
            </form>
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
            <form class="form" method="post" action="">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="status_lead">

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
                            <div id='getExtraField' class="col-lg-12">

                            </div>

                        </td>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn" class="btn btn-theme" type="submit" value="update-status">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Address Model -->
<div class="modal fade" id="modaladdress">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="">
                <?= csrf_field() ?>
                <div class="modal-body">

                    <div class="row ">

                        <!--end::Heading-->
                        <div class="form-group col-lg-12">
                            <label for="country">Country:</label>
                            <select id="country" name="country" onchange="countrySelect(this.value)" class="form-control form-control-solid default-select2" required>
                                <option value="">-- Select --</option>
                                <?php foreach ($countries as $country) : ?>
                                    <option value="<?= $country['name'] ?>" <?php if (old('country') || isset($address['la_country'])) : ?> <?= (old('country') ?? ($address['la_country']) ?? '') == $country['name'] ? 'selected' : null ?> <?php else : ?> <?= 'India' == $country['name'] ? 'selected' : null ?> <?php endif; ?>><?= $country['name'] ?> </option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                        <div id="countryType" class="form-group col-lg-12 mb-0">

                        </div>
                        <div class="form-group col-lg-12">
                            <label for="street_address">Street:</label>
                            <input type="text" id="street_address" name="street_address" class="form-control" placeholder="Enter Street Address" value="<?= old('street_address') ?? ($address['la_street_address'] ?? '') ?>" required="">

                        </div>
                        <div class="form-group col-lg-12">
                            <label for="zipcode">PIN/ZIP Code:</label>
                            <input type="tel" id="zipcode" name="zipcode" class="form-control" placeholder="Enter pin/zip code" value="<?= old('zipcode') ?? ($address['la_zipcode'] ?? '') ?>" required>

                        </div>

                        <?php if (session('addressError')) : ?>
                            <fieldset class="col-lg-12 mx-auto">
                                <div class="alert alert-danger">
                                    <?php foreach (session('addressError') as $error) : ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </div>
                            </fieldset>
                        <?php endif; ?>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn" value="address-btn" class="btn btn-theme">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Contact_Alternet Model -->
<div class="modal fade" id="modalaltrcont">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alternate Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form class="form" method="post" action="">
                <?= csrf_field() ?>
                <div class="modal-body">

                    <div class="row ">

                        <div class="form-group col-lg-12">
                            <label for="tel">Mobile No.:</label>
                            <input type="tel" name="alter_mobile" class="form-control" value="<?= (old('alter_mobile') ?? @$alternatives['ci_mobile']) ?? '' ?>" placeholder="Mobile No." required="" minlength="8" maxlength="12">

                        </div>
                        <div class="form-group col-lg-12">
                            <label for="email">Email:</label>
                            <input type="email" id="zipcode" name="zipcode" class="form-control" id="email" name="alter_email" value="<?= (old('alter_email') ?? @$alternatives['ci_email']) ?? '' ?>" placeholder="Email" required="">

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn" value="lead-alternative" class="btn btn-theme">Save changes</button>
                </div>
            </form>
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
            <form class="form" method="post" action="">
                <?= csrf_field() ?>
                <div class="modal-body">

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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button name='btn' type="submit" value="transfer" class="btn btn-theme" value="update-name">Transfer</button>
                </div>
            </form>
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