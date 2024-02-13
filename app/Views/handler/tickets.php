<?php $uri = service('uri'); ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="d-flex flex-row">
                <?php if ($uri->getSegment(3) != '') { ?>
                    <!--begin::Aside-->

                    <!--end::Aside-->
                <?php } else { ?>
                    <!--begin::Aside-->
                    <div class="flex-row-auto offcanvas-mobile w-200px w-xxl-275px" id="kt_todo_aside">
                        <!--begin::Card-->
                        <div class="card card-custom">
                            <!--begin::Body-->
                            <div class="card-body px-5">
                                <!--begin:Nav-->
                                <div class="navi navi-hover navi-active navi-link-rounded navi-bold navi-icon-center navi-light-icon">
                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="<?= base_url('handler/tickets?step=create-ticket') ?>" class="px-0 navi-link <?= (@$_GET['step'] == 'create-ticket') ? 'active' : null ?>">
                                            <span class="navi-icon mr-4">
                                                <span class="svg-icon svg-icon-lg">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-heart.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M13.8,4 C13.1562,4 12.4033,4.72985286 12,5.2 C11.5967,4.72985286 10.8438,4 10.2,4 C9.0604,4 8.4,4.88887193 8.4,6.02016349 C8.4,7.27338783 9.6,8.6 12,10 C14.4,8.6 15.6,7.3 15.6,6.1 C15.6,4.96870845 14.9396,4 13.8,4 Z" fill="#000000" opacity="0.3"></path>
                                                            <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="navi-text font-weight-bolder font-size-lg">Create Ticket</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="<?= base_url('handler/tickets?step=inbox') ?>" class="px-0 navi-link <?php if (!isset($_GET['step']) || @$_GET['step'] == 'inbox') echo 'active'; ?>">
                                            <span class="navi-icon mr-4">
                                                <span class="svg-icon svg-icon-lg">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-heart.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M13.8,4 C13.1562,4 12.4033,4.72985286 12,5.2 C11.5967,4.72985286 10.8438,4 10.2,4 C9.0604,4 8.4,4.88887193 8.4,6.02016349 C8.4,7.27338783 9.6,8.6 12,10 C14.4,8.6 15.6,7.3 15.6,6.1 C15.6,4.96870845 14.9396,4 13.8,4 Z" fill="#000000" opacity="0.3"></path>
                                                            <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="navi-text font-weight-bolder font-size-lg">Inbox</span>
                                            <span class="navi-label">
                                                <span class="label label-rounded label-light-success font-weight-bolder"><?= @$inbox ?></span>
                                            </span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="<?= base_url('handler/tickets?step=answered') ?>" class="px-0 navi-link <?php if (@$_GET['step'] == 'answered') echo 'active'; ?>">
                                            <span class="navi-icon mr-4">
                                                <span class="svg-icon svg-icon-lg">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-heart.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M13.8,4 C13.1562,4 12.4033,4.72985286 12,5.2 C11.5967,4.72985286 10.8438,4 10.2,4 C9.0604,4 8.4,4.88887193 8.4,6.02016349 C8.4,7.27338783 9.6,8.6 12,10 C14.4,8.6 15.6,7.3 15.6,6.1 C15.6,4.96870845 14.9396,4 13.8,4 Z" fill="#000000" opacity="0.3"></path>
                                                            <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="navi-text font-weight-bolder font-size-lg">Answered</span>
                                            <span class="navi-label">
                                                <span class="label label-rounded label-light-success font-weight-bolder"><?= @$answered ?></span>
                                            </span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="<?= base_url('handler/tickets?step=transfered') ?>" class="px-0 navi-link <?php if (@$_GET['step'] == 'transfered') echo 'active'; ?>">
                                            <span class="navi-icon mr-4">
                                                <span class="svg-icon svg-icon-lg">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-heart.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M13.8,4 C13.1562,4 12.4033,4.72985286 12,5.2 C11.5967,4.72985286 10.8438,4 10.2,4 C9.0604,4 8.4,4.88887193 8.4,6.02016349 C8.4,7.27338783 9.6,8.6 12,10 C14.4,8.6 15.6,7.3 15.6,6.1 C15.6,4.96870845 14.9396,4 13.8,4 Z" fill="#000000" opacity="0.3"></path>
                                                            <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="navi-text font-weight-bolder font-size-lg">Transferred</span>
                                            <span class="navi-label">
                                                <span class="label label-rounded label-light-success font-weight-bolder"><?= @$transfered ?></span>
                                            </span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="<?= base_url('handler/tickets?step=closed') ?>" class="px-0 navi-link <?php if (@$_GET['step'] == 'closed') echo 'active'; ?>">
                                            <span class="navi-icon mr-4">
                                                <span class="svg-icon svg-icon-lg">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-heart.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M13.8,4 C13.1562,4 12.4033,4.72985286 12,5.2 C11.5967,4.72985286 10.8438,4 10.2,4 C9.0604,4 8.4,4.88887193 8.4,6.02016349 C8.4,7.27338783 9.6,8.6 12,10 C14.4,8.6 15.6,7.3 15.6,6.1 C15.6,4.96870845 14.9396,4 13.8,4 Z" fill="#000000" opacity="0.3"></path>
                                                            <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="navi-text font-weight-bolder font-size-lg">Closed</span>
                                            <span class="navi-label">
                                                <span class="label label-rounded label-light-success font-weight-bolder"><?= @$closed ?></span>
                                            </span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                    <!--begin:Item-->
                                    <div class="navi-item my-2">
                                        <a href="<?= base_url('handler/tickets?step=sent') ?>" class="px-0 navi-link <?php if (@$_GET['step'] == 'sent') echo 'active'; ?>">
                                            <span class="navi-icon mr-4">
                                                <span class="svg-icon svg-icon-lg">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Sending.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z" fill="#000000"></path>
                                                            <path d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z" fill="#000000" opacity="0.3"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="navi-text font-weight-bolder font-size-lg">My Tickets</span>
                                            <span class="navi-label">
                                                <span class="label label-rounded label-light-success font-weight-bolder"><?= @$sent ?></span>
                                            </span>
                                        </a>
                                    </div>
                                    <!--end:Item-->


                                </div>
                                <!--end:Nav-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Aside-->
                <?php } ?>
                <!--begin::List-->
                <?php

                if ($uri->getSegment(3) != '') {
                    include('ticket-view.php');
                } else {
                    if (@$_GET['step'] == '' || @$_GET['step'] == 'inbox') {
                        include('ticket-inbox.php');
                    } elseif (@$_GET['step'] == 'sent') {
                        include('ticket-sent.php');
                    } elseif (@$_GET['step'] == 'answered') {
                        include('ticket-answered.php');
                    } elseif (@$_GET['step'] == 'transfered') {
                        include('ticket-transfered.php');
                    } elseif (@$_GET['step'] == 'closed') {
                        include('ticket-closed.php');
                    } elseif (@$_GET['step'] == 'create-ticket') {
                        include('ticket-create.php');
                    }
                }
                ?>
                <!--end::List-->
            </div>
        </div>
    </div>
</div>
<?php
function time_elapsed_string($datetime)
{

    if (date('d-m-Y', now()) == date('d-m-Y', strtotime($datetime))) {
        return date('h:i A', strtotime($datetime));
    } else {
        return date('d M', strtotime($datetime));
    }
}
?>
<script src="<?= base_url() ?>/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="<?= base_url() ?>/assets/js/pages/crud/forms/editors/tinymce.js"></script>