<?php

use App\Models\ApplicationModel; ?>
<div class="w-100">
    <div class="row mx-0  mb-3" style="background:linear-gradient(90deg, #001a82, #2e61fb)">
        <div class="col-xl-12 col-lg-12">
            <div class="align-items-center flex-wrap py-3 px-0">
                <!--begin::Actions-->
                <div class="align-items-center py-3 d-flex">
                    <a href="<?= base_url('handler/tickets?step=' . $_GET['step']) ?>" class="align-items-left btn btn-white px-2 mr-2" style="align-self:start;box-shadow: 0px 0px 2px 0px rgb(6 6 6 / 47%), 0px 0px 7px #060606;"><i class="flaticon2-arrow-down font-size-h4 text-primary pl-1" style="transform: rotate(90deg);"></i></a>
                    <div class="align-items-center text-light" style="font-size: 1.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M3,10.0500091 L3,8 C3,7.44771525 3.44771525,7 4,7 L9,7 L9,9 C9,9.55228475 9.44771525,10 10,10 C10.5522847,10 11,9.55228475 11,9 L11,7 L21,7 C21.5522847,7 22,7.44771525 22,8 L22,10.0500091 C20.8588798,10.2816442 20,11.290521 20,12.5 C20,13.709479 20.8588798,14.7183558 22,14.9499909 L22,17 C22,17.5522847 21.5522847,18 21,18 L11,18 L11,16 C11,15.4477153 10.5522847,15 10,15 C9.44771525,15 9,15.4477153 9,16 L9,18 L4,18 C3.44771525,18 3,17.5522847 3,17 L3,14.9499909 C4.14112016,14.7183558 5,13.709479 5,12.5 C5,11.290521 4.14112016,10.2816442 3,10.0500091 Z M10,11 C9.44771525,11 9,11.4477153 9,12 L9,13 C9,13.5522847 9.44771525,14 10,14 C10.5522847,14 11,13.5522847 11,13 L11,12 C11,11.4477153 10.5522847,11 10,11 Z" fill="#ffffff" opacity="1" transform="translate(12.500000, 12.500000) rotate(-45.000000) translate(-12.500000, -12.500000) "></path>
                            </g>
                        </svg>
                        <b>
                            <?= $ticket['token_number'] ?> - </b><?= $ticket['subject'] ?>
                    </div>
                </div>
                <!--end::Actions-->
            </div>
        </div>
    </div>
    <div class="row mx-0">
        <div class="col-lg-3">
            <div class="">
                <!--begin::Card-->
                <!-- <h5 class="font-size-h6 mb-2 text-dark font-weight-bolder">Ticket Information</h5> -->
                <div class="card card-custom">
                    <!--begin::Body-->
                    <div class="card-body px-2 py-2">

                        <div class="border-bottom py-2">
                            <p class="mb-1">Requestor</p>
                            <b class="font-size-h5"><?= $sender['name'] ?><br><?= $sender['sub'] ?></b>
                        </div>
                        <div class="border-bottom py-2">
                            <p class="mb-1">Title Type</p>
                            <b class="font-size-h5"><?= $ticket['title'] ?></b>
                        </div>
                        <?php if ($_GET['step'] == 'transfered') { ?>
                            <div class="border-bottom py-2">
                                <p class="mb-1">Transferred To</p>
                                <b class="font-size-h5"><?= ucwords($desk['dr_name']) ?> Desk</b>
                            </div>
                            <?php } else {
                            if ($_GET['step'] != 'sent') { ?>
                                <div class="border-bottom py-2">
                                    <p class="mb-1">Receiving Type</p>
                                    <b class="font-size-h5"><?= (isset($ticket['type'])) ? (($ticket['type'] == 0) ? 'To' : 'CC') : 'Transfer' ?></b>
                                </div>
                        <?php }
                        } ?>
                        <div class="border-bottom py-2">
                            <p class="mb-1"> Status/Priority</p>
                            <span class="font-size-h6 label label-inline label-<?= $ticket['status_color'] ?>"><b> <?= $ticket['status_name'] ?></b></span><b class="font-size-h5">&nbsp;/&nbsp;<?= ($ticket['priority'] == 1 ? 'Medium' : ($ticket['priority'] == 2 ? 'High' : 'Low')) ?></b>
                        </div>
                        <div class="border-bottom py-2">
                            <p class="mb-1">Submitted</p>
                            <b class="font-size-h5"><?= date('d M Y h:i A', strtotime($ticket['created_at'])) ?></b>
                        </div>
                    </div>

                    <!--end::Body-->
                </div>
                <?php if ($_GET['step'] == 'inbox' || ($_GET['step'] == 'sent' && $ticket['action_status'] == 4)) : ?>
                    <div class="my-2 d-flex">
                        <button style="width:50%" class="btn btn-lg btn-primary mx-2 px-2 py-2" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false"><i class="flaticon-reply text-light"></i>Reply</button>
                        <button style="width:50%" class="btn btn-lg btn-primary mx-2 px-2 py-2" data-toggle="modal" data-target="#transfer">Transfer</button>
                    </div>
                <?php endif; ?>
                <!--end::Card-->
            </div>
        </div>
        <div class="col-lg-9">
            <!-- reply -->
            <?php if ($_GET['step'] == 'inbox' || ($_GET['step'] == 'sent' && $ticket['action_status'] == 4)) : ?>
                <div class="accordion accordion-toggle-arrow" id="accordionExample4">
                    <div class="card" style="border:none">
                        <div class="card-header d-none" id="headingOne4">
                            <div class="card-title px-3 py-1 collapsed text-primary bg-light-primary" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false">
                                <i class="flaticon-reply text-primary"></i>Reply

                            </div>
                        </div>
                        <div id="collapseOne4" class="collapse <?= (\Config\Services::validation()->getErrors() != null) ? 'show' : null ?>" data-parent="#accordionExample4" style="box-shadow: 0 0 10px 1px #c4c4c4;">
                            <!--begin::Form-->
                            <form name="once" class="form py-3 px-3" id="edit_contact_details" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <?php if ($ticket['action_status'] == 1) : ?>
                                    <div class="form-group">
                                        <label class="form-label" for="priority">Priority<span style="color:red">*</span></label>
                                        <select class="form-control" name="priority" required>
                                            <option value="">---Select Priority---</option>
                                            <option value="0" <?= (set_value('priority') == 0) ? 'selected' : null ?>>Low</option>
                                            <option value="1" <?= (set_value('priority') == 1) ? 'selected' : null ?>>Medium</option>
                                            <option value="2" <?= (set_value('priority') == 2) ? 'selected' : null ?>>High</option>
                                        </select>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="form-label" for="description">Description<span style="color:red">*</span></label>
                                    <div>
                                        <textarea class="form-control form-control-lg form-control-solid" rows="3" name="answer_text" id="kt-tinymce-4" type="text" placeholder="Description"><?= set_value('answer_text', @$leads['description'] ?? ''); ?></textarea>
                                        <span class="form-text text-danger">
                                            <?= \Config\Services::validation()->showError('description'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Attachment (Max. size 500 kb for image file and 2 mb for pdf file.)</label>
                                    <div>
                                        <input class="form-control form-control-lg form-control-solid" name="attachment" type="file" value="<?= set_value('attachment', @$leads['attachment'] ?? ''); ?>" accept="application/pdf, image/*" />
                                        <span class="form-text text-danger">
                                            <?= \Config\Services::validation()->showError('attachment'); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="answer" value="Submit" class="btn btn-success mr-2 py-1">Submit</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- end reply -->
            <!--begin::Card-->
            <div class="card card-custom mb-3">
                <div class="card-header px-3 align-items-center">
                    <div class="mb-1 font-size-h5">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 22 26" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill-rule="nonzero" opacity="1" fill="#0073e9"></path>
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill-rule="nonzero" fill="#0073e9"></path>
                            </g>
                        </svg>
                        <?php if ($_GET['step'] == 'sent') { ?>
                            <b>Me</b> (<?= $sender['name'] ?>)
                        <?php } else { ?>
                            <b>Client</b> (<?= $sender['name'] ?>)
                        <?php } ?>
                    </div>
                    <div class="ml-auto mt-1"><?= time_elapsed_string($ticket['created_at']) ?></div>

                </div>
                <!--begin::Body-->
                <div class="card-body pt-3 pb-0 px-0">
                    <div class="px-3">
                        <?= $ticket['issue'] ?></br>
                    </div>

                    <?php if ($ticket['attachment_id'] != null) {
                        $attModel = new ApplicationModel('attachment', 'att_id', 'support_db');
                        $attachment = $attModel->select(['attachment', 'attachment_type'])->where('att_id', $ticket['attachment_id'])->first();
                        $att = substr($attachment['attachment'], strrpos($attachment['attachment'], '/') + 1) ?>
                        <div class="px-3" style="background:#f9f9f9; border-top: 1px solid #ebedf3">
                            <div class="d-block pt-2 pb-3">
                                <!-- <h5 class="text-dark font-weight-bold mb-2">Attachments</h5> -->
                                <i class="text-dark font-weight-bold flaticon-attachment"></i>
                                <a href="<?= $attachment['attachment'] ?>" class="ml-4" target="_blank"><?= urldecode($att) ?></a>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
            <?php if (isset($replies)) : foreach ($replies as $reply) : 
                if($reply['user_type']==2):
                    $aiModel = new ApplicationModel('admin_info', 'aid','admsion_'.session('suffix'));
                    $desk = $aiModel->select(['admin_name', 'dr_name', 'aid'])->join('desk_role', 'desk_role.dr_id=admin_info.admin_role')->where('aid', $reply['user_id'])->first();
                    $id = $desk['aid'];
                    $name = $desk['admin_name'];
                    $role = ucwords($desk['dr_name']).' Desk';
                else:
                    $luModel = new ApplicationModel('lms_users_'.session('year'), 'lu_id','setting_db');
                    $handler = $luModel->select(['user_name', 'user_role', 'lu_id'])->where('lu_id', $reply['user_id'])->first();
                    $id = $handler['lu_id'];
                    $name = $handler['user_name'];
                    $role = ($handler['user_role']==0)?'Handler':(($handler['user_role']==1)?'Team-Leader':'Admin');
                endif;
                    ?>
                    <!--begin::Card-->
                    <div class="card card-custom mb-3">
                        <div class="card-header px-3 align-items-center">
                            <div class="mb-1 font-size-h5">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 22 26" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill-rule="nonzero" opacity="1" fill="#0073e9"></path>
                                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill-rule="nonzero" fill="#0073e9"></path>
                                    </g>
                                </svg>
                                <?php if ($reply['reply_by'] == 3) {
                                    if (@$id == session('id')) {
                                        echo '<b>Me</b> (' . session('name') . ')';
                                    } else {
                                        echo '<b>Client</b> (' . $sender['name'] . ')';
                                    }
                                } else { ?>
                                    <?php if ($id == session('id')) {
                                        echo '<b>Me</b> (' . session('name') . ')';
                                    } else { ?>
                                        <b><?= $role?></b> (<?= $name ?>)
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="ml-auto mt-1"><?= time_elapsed_string($reply['rt_created_at']) ?></div>

                        </div>
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <div class="px-3">
                                <?= $reply['reply_text'] ?><br>
                            </div>
                            <?php if ($reply['attachment_id'] != null) {
                                $attModel = new ApplicationModel('attachment', 'att_id', 'support_db');
                                $attachment = $attModel->select(['attachment', 'attachment_type'])->where('att_id', $reply['attachment_id'])->first();
                                $att = substr($attachment['attachment'], strrpos($attachment['attachment'], '/') + 1) ?>
                                <div class="px-3" style="background:#f9f9f9; border-top: 1px solid #ebedf3">
                                    <div class="d-block pt-2 pb-3">
                                        <!-- <h5 class="text-dark font-weight-bold mb-2">Attachments</h5> -->
                                        <i class="text-dark font-weight-bold flaticon-attachment"></i>
                                        <a href="<?= $attachment['attachment'] ?>" class="ml-4" target="_blank"><?= urldecode($att) ?></a>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
            <?php endforeach;
            endif; ?>

            <?php if ($_GET['step'] == 'sent' || $_GET['step'] == 'closed') { ?>
                <?php if ($ticket['action_status'] == 2) {
                    echo '<span class="text-center label label-success label-inline ml-2 mr-2" style="font-size: 1rem;">Ticket Closed on ' . date('d M Y h:i A', strtotime($ticket['updated_at'])) . '.</span>';
                } else { ?>
                    <div class="text-center">
                        <button class="btn btn-success m-3" data-toggle="modal" data-target="#close">Close Ticket</button>
                    </div>
                    <div class="modal fade" id="close" tabindex="-1" role="dialog" aria-labelledby="transfer" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="transfer">Satisfaction</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="once" method="post">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <label class="form-label">Rating<span class="text-danger">*</span></label>
                                            <div>
                                                <select name="rating" class="form-control form-control-lg form-control-solid">
                                                    <option value="">---Select Rating---</option>
                                                    <option value="1">Below Average</option>
                                                    <option value="2">Average</option>
                                                    <option value="3">Good</option>
                                                    <option value="4">Very Good</option>
                                                    <option value="5">Excellent</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Remark</label>
                                            <div>
                                                <textarea name="remark" class="form-control form-control-lg form-control-solid"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="submit" name="close" class="btn btn-primary " value="Submit" />
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
    <?php if (isset($ticket['type'])) : ?>
        <?php if ($_GET['step'] == 'inbox') : ?>
            <div class="modal fade" id="transfer" tabindex="-1" role="dialog" aria-labelledby="transfer" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="transfer">Transfer Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="once" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label class="form-label">To Desk<span class="text-danger">*</span></label>
                                    <div>
                                        <select name="to" class="form-control form-control-lg form-control-solid" required>
                                            <option value="">---Select---</option>
                                            <?php foreach ($members as $member) { ?>
                                                <option value="<?= $member['lu_id'] ?>-3" <?php if (@in_array($member['lu_id'] . '-3', set_value('to'))) echo 'selected'; ?>><?= ucfirst($member['user_name']) ?> (<?= ($member['user_role'] == 0) ? 'Handler' : (($member['user_role'] == 1) ? 'Team-Leader' : 'Admin') ?>)</option>
                                            <?php } ?>
                                            <?php foreach ($desks as $desk) : ?>
                                                <option value="<?= $desk['dr_id'] ?>-2"><?= ucwords($desk['dr_name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" name="transfer" class="btn btn-primary " value="Submit" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>