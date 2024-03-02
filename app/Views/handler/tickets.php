<?php $uri = service('uri'); ?>
<link href="<?= base_url('assets/plugins/summernote/dist/summernote-lite.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/summernote/dist/summernote-lite.min.js') ?>"></script>
<link href="<?= base_url('assets/plugins/bootstrap-icons/font/bootstrap-icons.css') ?>" rel="stylesheet" />
<style>
    .mailbox .list-email>li.list-group-item .email-title {
        width: 872px;
    }

    .email-desc::before {
        display: none;
    }

    .panel .panel-heading .tab-overflow {
        flex: 1;
        overflow-x: auto;
        /* Allows horizontal scrolling when tabs overflow */
        -webkit-overflow-scrolling: touch;
        /* Enables smooth scrolling on iOS devices */
        scrollbar-width: none;
    }

    .status {
        width: auto;
        padding: .15rem .75rem;
        border-radius: .42rem;
        color: #1bc5bd;
        background-color: #c9f7f5;
    }


    .tab-overflow .nav.nav-tabs.nav-tabs-inverse>li>a {
        background: var(--bs-app-theme-active);
    }

    @media screen and (max-width:876px) {


        .mailbox .list-email>li.list-group-item .email-title {
            width: 200px;
        }
    }

    /* change this css from main css file */
</style>
<div class="">
    <div class="panel panel-inverse panel-with-tabs">
        <div class="panel-heading p-0">
            <div class="tab-overflow">
                <?php if ($uri->getSegment(3) != '') { ?>
                <?php } else { ?>
                    <ul class="nav nav-tabs nav-tabs-inverse">
                        <li class="nav-item">
                            <a href="<?= base_url('handler/tickets?step=create-ticket') ?>" data-bs-toggle="tab" class="nav-link <?= (@$_GET['step'] == 'create-ticket') ? 'active' : null ?>"><i class="fa fa-square-plus"></i>&nbsp;&nbsp;Create Ticket</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('handler/tickets?step=inbox') ?>" data-bs-toggle="tab" class="nav-link active  <?php if (!isset($_GET['step']) || @$_GET['step'] == 'inbox') echo 'active'; ?>"><i class="fa-solid fa-envelope-open-text">&nbsp;</i>Inbox &nbsp;&nbsp;<span class="badge bg-warning fs-10px rounded-pill "><?= @$inbox ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('handler/tickets?step=answered') ?>" data-bs-toggle="tab" class="nav-link <?php if (@$_GET['step'] == 'answered') echo 'active'; ?>"><i class=" fa-solid fa-envelope-open-text">&nbsp;</i>Answered&nbsp;&nbsp;<span class="badge bg-warning fs-10px rounded-pill"><?= @$answered ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#nav-tab-4" data-bs-toggle="tab" class="nav-link "><i class="fa-solid fa-envelope-open-text">&nbsp;</i>Transerferd&nbsp;&nbsp;<span class="badge bg-warning fs-10px rounded-pill"><?= @$transfered ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#nav-tab-5" data-bs-toggle="tab" class="nav-link "><i class="fa-solid fa-envelope-open-text">&nbsp;</i>Closed&nbsp;&nbsp;<span class="badge bg-warning fs-10px rounded-pill">340</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#nav-tab-6" data-bs-toggle="tab" class="nav-link "><i class="fa-solid fa-envelope-open-text">&nbsp;</i>My Ticket&nbsp;&nbsp;<span class="badge bg-warning fs-10px rounded-pill">40</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#nav-tab-7" data-bs-toggle="tab" class="nav-link "><i class="fa-solid fa-envelope-open-text">&nbsp;</i>Team Tickets&nbsp;&nbsp;<span class="badge bg-warning fs-10px rounded-pill">0</span></a>
                        </li>
                    </ul>
                <?php } ?>


            </div>
        </div>
        <div class="panel-body tab-content">
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
                } elseif (@$_GET['step'] == 'team') {
                    include('ticket-team.php');
                }
            }
            ?>



        </div>
    </div>
</div>
<script>
    $(".summernote").summernote({
        placeholder: 'Discription',
        height: "200"
    });
</script>
<script src="<?= base_url('assets/js/demo/email-inbox.demo.js') ?>"></script>