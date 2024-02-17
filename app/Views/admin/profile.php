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
                <div class="panel-body card-body p-3 text-dark fw-bold" style="overflow-y: scroll; height:400px">

                    <div id="bsSpyContent">
                        <div id="general" class="">
                            <h4 class="d-flex align-items-center mb-2 mt-3">
                                <span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:user-bold-duotone"></span> Profile Details
                            </h4>
                            <p>View and update your Profile Details information.</p>
                            <div class="card">
                                <div class="list-group list-group-flush fw-bold">
                                    <form method="post" action="">
                                        <?= csrf_field() ?>
                                        <div class="list-group-item d-flex align-items-center">
                                            <div class="flex-fill">
                                                <label for="firstname">First Name:</label>
                                                <input type="text" id="firstname" name="firstname" class="form-control " placeholder="Enter first name" value="<?= old('firstname') ?? $profileDetail['lead_first_name'] ?>" required>
                                            </div>
                                            <div class="flex-fill">
                                                <label for="middlename">Middle Name:</label>
                                                <input type="text" id="middlename" name="middlename" class="form-control " placeholder="Enter last name" value="<?= old('middlename') ?? ($profileDetail['lead_middle_name'] ?? '') ?>">
                                            </div>

                                            <div class="flex-fill">
                                                <label for="lastname">Last Name:</label>
                                                <input type="text" id="lastname" name="lastname" class="form-control " placeholder="Enter last name" value="<?= old('lastname') ?? ($profileDetail['lead_last_name'] ?? '') ?>">
                                            </div>
                                            <div class="w-100px">
                                                <button class="btn btn-secondary w-100px" name="btn" type="submit" value="update-name">Edit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="flex-fill">
                                            <div>Mobile No.</div>
                                            <div class="text-body text-opacity-60"><a href="tel:<?= $profileDetail['lead_country_code'] . $profileDetail['lead_mobile'] ?>" class="text-muted text-hover-primary">
                                                    <span class="text-muted">(<?= $profileDetail['lead_country_code'] ?>)<?= $profileDetail['lead_mobile'] ?></span>
                                                </a></div>
                                        </div>
                                        <div>
                                            <a href="#" data-bs-toggle="modal" class="btn btn-secondary w-100px">Edit</a>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="flex-fill">
                                            <div>Email address</div>
                                            <div class="text-body text-opacity-60"><a href="mailto:<?= $profileDetail['lead_email'] ?>" class="text-muted text-hover-primary"><?= $profileDetail['lead_email'] ?></a>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" data-bs-toggle="modal" class="btn btn-secondary disabled w-100px">Edit</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="academics" class="mb-4 pb-3">
                            <h4 class="d-flex align-items-center mb-2 mt-3">
                                <span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:square-academic-cap-bold-duotone"></span>
                                Academics
                            </h4>
                            <p>Review and update your Academic Profile details.</p>
                            <div class="card">
                                <div class="list-group list-group-flush fw-bold">
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="flex-fill">
                                            <span>Program:</span>

                                            <a href="javascript:;" id="country" data-type="select2" data-pk="1" data-value="BS" data-title="Select country" class="editable editable-click" style="background-color: rgba(0, 0, 0, 0);"><?= $profileDetail['coursename'] ?></a>

                                        </div>
                                        <div>
                                            <a href="javascript:;" class="btn btn-secondary w-100px" id="country" data-type="select2" data-pk="1" data-value="BS" data-title="Select country"><i class="fa fa-pencil"></i> Edit</a>
                                        </div>
                                    </div>
                                    <div>
                                        <?php if ($sidData = checkSidCreated($profileDetail['lid'])) :  ?>
                                            <div class="list-group-item d-flex align-items-center">
                                                <div class="flex-fill">
                                                    <div>SID/Password:</div>
                                                    <div class="text-body text-opacity-60 d-flex align-items-center">
                                                        <?= $sidData['sid'] . '/' . base64_decode($sidData['password']) ?>
                                                    </div>
                                                </div>
                                                <div>
                                                    <a href="#" data-bs-toggle="modal" class="btn btn-secondary w-100px">Edit</a>
                                                </div>
                                            </div>
                                            <div class="list-group-item d-flex align-items-center">
                                                <div class="flex-fill">
                                                    <div>Form Step:</div>
                                                    <div class="text-body text-opacity-60 d-flex align-items-center">
                                                        <i class="fa fa-circle fs-6px mt-1px fa-fw text-success me-2"></i> <?= $formStep[$sidData['form_step']] ?? '' ?>
                                                    </div>
                                                </div>
                                                <?php if ($sidData['form_step'] <= 6) : ?>
                                                    <div>
                                                        <a href="<?= base_url('admin/process-application/' . $profileDetail['lid'] . '/' . $sidData['sid']) ?>" class="btn btn-secondary w-100px">Proceed </a>
                                                    </div>
                                                <?php else : ?>
                                                    <div>
                                                        <a href="<?= base_url('admin/process-application/' . $profileDetail['lid'] . '/' . $sidData['sid']) ?>" class="btn btn-secondary w-100px">Application Under Process</a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php else : ?>
                                            <div class="list-group-item d-flex align-items-center">
                                                <div class="flex-fill">
                                                    <div>SID/Password:</div>
                                                    <div class="text-body text-opacity-60 d-flex align-items-center">
                                                        N/A
                                                    </div>
                                                </div>
                                                <div>
                                                    <a href="<?= base_url('admin/apply-now/' . $profileDetail['lid']) ?>" data-bs-toggle="modal" class="btn btn-secondary w-100px">Generate Sid</a>
                                                </div>
                                            </div>
                                        <?php endif; ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="studentstatus" class="mb-4 pb-3">
                            <h4 class="d-flex align-items-center mb-2 mt-3 flex-wrap">
                                <span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:bell-bold-duotone"></span>
                                Student Status
                            </h4>
                            <p>Check and update your Student Status</p>
                            <div class="card">
                                <div class="list-group list-group-flush fw-bold">
                                    <div class="list-group-item d-flex align-items-center">
                                        <form action="" method="post" class="flex-fill">
                                            <?= csrf_field() ?>
                                            <label class="form-label">Lead Status:</label>&nbsp;
                                            <select class="default-select2 col-md-12 " id="status" name="status" required="" onchange="getInfoProfile($(this).find(':selected').attr('data-getinfo')
                                                    );">
                                                <?php foreach ($status_list as $status) : ?>
                                                    <option data-statusscore='<?= $status['score'] ?>' data-getinfo='<?= $status['status_get_more_info'] ?>' value="<?= $status['status_id'] ?>" <?= (old('status') ?? $profileDetail['lead_status']) == $status['status_id'] ? 'selected' : null ?>><?= $status['status_name'] ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <a href="" data-bs-toggle="modal" class="btn btn-secondary mt-2">Update</a>

                                        </form>
                                    </div>
                                </div>
                                <div class="list-group list-group-flush fw-bold">
                                    <div class="list-group-item d-flex align-items-center">
                                        <form action="" method="post" class="flex-fill">
                                            <div class="d-flex align-items-center flex-wrap">
                                                <label class="form-label">Message:</label>
                                                <input class="form-control mb-2" />
                                                <a href="" data-bs-toggle="modal" class="btn btn-secondary ">Update</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="list-group list-group-flush fw-bold">
                                    <div class="list-group-item d-flex align-items-center">
                                        <form action="" method="" class="flex-fill ">

                                            <label class="form-label">Date & Time:</label>
                                            <div class="d-flex justify-content-between mb-2">
                                                <div class="input-group" id="default-daterange">
                                                    <input type="text" class="form-control" id="datepicker-autoClose" />
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                <div class="input-group bootstrap-timepicker">
                                                    <input id="timepicker" type="text" class="form-control" />
                                                    <span class="input-group-text input-group-addon">
                                                        <i class="fa fa-clock"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <a href="#" data-bs-toggle="modal" class="btn btn-secondary ">Update</a>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="actionInformation" class="mb-4 pb-3">
                            <h4 class="d-flex align-items-center mb-2 mt-3">
                                <span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:bag-4-bold-duotone"></span>

                                More Action and Information
                            </h4>
                            <p>Edit your Contact Information for accurate and up-to-date details.</p>
                            <div class="card">
                                <div class="list-group list-group-flush fw-bold">
                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="flex-fill">
                                            <div>Alternate Contact:</div>
                                        </div>
                                        <a href="#" data-bs-toggle="modal" class="btn btn-secondary w-100px">Edit</a>
                                    </div>
                                </div>
                                <div class="list-group list-group-flush fw-bold">
                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="flex-fill">
                                            <div>Address</div>
                                        </div>
                                        <a href="#" data-bs-toggle="modal" class="btn btn-secondary w-100px">Edit</a>
                                    </div>
                                </div>
                                <div class="list-group list-group-flush fw-bold">
                                    <div class="list-group-item d-flex align-items-center">

                                        <div class="flex-fill">
                                            <div>Transfer Lead</div>
                                        </div>
                                        <a href="#" data-bs-toggle="modal" class="btn btn-warning w-100px">Transfer</a>
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
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <a href="javascript:;">&nbsp;</a>
                                        </div>
                                        <div class="timeline-content ">
                                            <div class="timeline-header">
                                                <div class="username">
                                                    <a href="javascript:;">Darren Parrase</a>
                                                    <div class="text-muted fs-12px">24 mins <i class="fa fa-globe-americas opacity-5 ms-1"></i></div>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="mb-2">Location: United States</div>
                                                <p>Lorem ipsum dolor sitconsectetur adipiscing elit. Nunc faucibus
                                                    turpis quis tincidunt luctus.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <a href="javascript:;">&nbsp;</a>

                                        </div>
                                        <div class="timeline-content ">
                                            <div class="timeline-header">
                                                <div class="username">
                                                    <a href="javascript:;">Darren Parrase</a>
                                                    <div class="text-muted fs-12px">24 mins <i class="fa fa-globe-americas opacity-5 ms-1"></i></div>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="mb-2">Location: United States</div>
                                                <p>Lorem ipsum dolor sitconsectetur adipiscing elit. Nunc faucibus
                                                    turpis quis tincidunt luctus.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <a href="javascript:;">&nbsp;</a>

                                        </div>
                                        <div class="timeline-content ">
                                            <div class="timeline-header">
                                                <div class="username">
                                                    <a href="javascript:;">Darren Parrase</a>
                                                    <div class="text-muted fs-12px">24 mins <i class="fa fa-globe-americas opacity-5 ms-1"></i></div>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="mb-2">Location: United States</div>
                                                <p>Lorem ipsum dolor sitconsectetur adipiscing elit. Nunc faucibus
                                                    turpis quis tincidunt luctus.</p>
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


<script>
    $("#timepicker").timepicker();
    $(".default-select2").select2();
    $("#datepicker-autoClose").datepicker({
        todayHighlight: true,
        autoclose: true
    });
</script>

<script src="<?= base_url('assets/js/iconify.min.js') ?>" type="text/javascript"></script>