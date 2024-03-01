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
                <ul class="nav nav-tabs nav-tabs-inverse">
                    <li class="nav-item">
                        <a href="#nav-tab-1" data-bs-toggle="tab" class="nav-link "><i class="bi bi-gem">&nbsp;</i>Create Ticket &nbsp;&nbsp;<span class="badge bg-warning fs-10px rounded-pill">12</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#nav-tab-2" data-bs-toggle="tab" class="nav-link active"><i class="fa-solid fa-envelope-open-text">&nbsp;</i>Inbox &nbsp;&nbsp;<span class="badge bg-warning fs-10px rounded-pill ">52</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#nav-tab-3" data-bs-toggle="tab" class="nav-link "><i class="fa-solid fa-envelope-open-text">&nbsp;</i>Answer&nbsp;&nbsp;<span class="badge bg-warning fs-10px rounded-pill">4021</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#nav-tab-4" data-bs-toggle="tab" class="nav-link "><i class="fa-solid fa-envelope-open-text">&nbsp;</i>Transerferd&nbsp;&nbsp;<span class="badge bg-warning fs-10px rounded-pill">342</span></a>
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
            </div>
        </div>
        <div class="panel-body tab-content">
            <div class="tab-pane fade" id="nav-tab-1">
                <h4 class="py-2">Create New Ticket</h4>
                <div class="row d-flex">
                    <div class="col-md-6  mb-3">
                        <label class="form-label">Tittle:</label>
                        <select class="form-select">
                            <option selected>--Select-- </option>
                            <option value="1">Handlers</option>
                        </select>
                    </div>
                    <div class="col-md-6  mb-3">
                        <label class="form-label">Subject</label>
                        <input class="form-control" type="text" placeholder="Enter Name" />
                    </div>
                </div>
                <div class="summernote" name="content"></div>
                <div class="row my-3 align-items-center">

                    <div class="col-md-4 col-12" style="line-height: 1px;">
                        <p class="text-primary">Attachment (Max. size 500 kb for image file and 2 mb for pdf file.)</p>
                        <input type="file" class="form-control " />
                    </div>

                    <div class="col-md-3 col-12 pt-1"><button class="btn btn-primary ms-md-5">Submit</button><button class="btn btn-default ms-3">Cancle</button></div>

                </div>
            </div>

            <div class="tab-pane fade active show" id="nav-tab-2">
                <div class="mailbox-content">
                    <div class="mailbox-content-body" style="overflow-x: auto;">
                        <table class="table ">
                            <thead class="border-bottom card-header">
                                <tr class="text-left text-uppercase ">
                                    <th class="pb-3">
                                        <span class="text-dark-75">Category</span>
                                    </th>
                                    <th class="py-3" style="min-width: 250px; max-width: 350px; width:60%"><span class="text-dark-75">Subject</span></th>
                                    <th class="py-3"><span class="text-dark-75">Status</span></th>
                                    <th class="py-3"><span class="text-dark-75">Last Updated</span></th>

                                </tr>
                            </thead>
                            <tbody style="overflow-y: auto; height:200px">
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mailbox-content-footer d-flex align-items-center">
                        <div class="text-dark fw-bold">1,232 messages</div>
                        <div class="btn-group ms-auto">

                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane  fade" id="nav-tab-3">
                <div class="mailbox-content">
                    <div class="mailbox-content-body" style="overflow-x: auto;">
                        <table class="table ">
                            <thead class="border-bottom card-header">
                                <tr class="text-left text-uppercase ">
                                    <th class="pb-3">
                                        <span class="text-dark-75">Category</span>
                                    </th>
                                    <th class="py-3" style="min-width: 250px; max-width: 350px; width:60%"><span class="text-dark-75">Subject</span></th>
                                    <th class="py-3"><span class="text-dark-75">Status</span></th>
                                    <th class="py-3"><span class="text-dark-75">Last Updated</span></th>

                                </tr>
                            </thead>
                            <tbody style="overflow-y: auto; height:200px">
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mailbox-content-footer d-flex align-items-center">
                        <div class="text-dark fw-bold">1,232 messages</div>
                        <div class="btn-group ms-auto">

                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane  fade" id="nav-tab-4">
                <div class="mailbox-content">
                    <div class="mailbox-content-body" style="overflow-x: auto;">
                        <table class="table ">
                            <thead class="border-bottom card-header">
                                <tr class="text-left text-uppercase ">
                                    <th class="pb-3">
                                        <span class="text-dark-75">Category</span>
                                    </th>
                                    <th class="py-3" style="min-width: 250px; max-width: 350px; width:60%"><span class="text-dark-75">Subject</span></th>
                                    <th class="py-3"><span class="text-dark-75">Status</span></th>
                                    <th class="py-3"><span class="text-dark-75">Last Updated</span></th>

                                </tr>
                            </thead>
                            <tbody style="overflow-y: auto; height:200px">
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mailbox-content-footer d-flex align-items-center">
                        <div class="text-dark fw-bold">1,232 messages</div>
                        <div class="btn-group ms-auto">

                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane  fade" id="nav-tab-5">
                <div class="mailbox-content">
                    <div class="mailbox-content-body" style="overflow-x: auto;">
                        <table class="table ">
                            <thead class="border-bottom card-header">
                                <tr class="text-left text-uppercase ">
                                    <th class="pb-3">
                                        <span class="text-dark-75">Category</span>
                                    </th>
                                    <th class="py-3" style="min-width: 250px; max-width: 350px; width:60%"><span class="text-dark-75">Subject</span></th>
                                    <th class="py-3"><span class="text-dark-75">Status</span></th>
                                    <th class="py-3"><span class="text-dark-75">Last Updated</span></th>

                                </tr>
                            </thead>
                            <tbody style="overflow-y: auto; height:200px">
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mailbox-content-footer d-flex align-items-center">
                        <div class="text-dark fw-bold">1,232 messages</div>
                        <div class="btn-group ms-auto">

                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane  fade" id="nav-tab-6">
                <div class="mailbox-content">
                    <div class="mailbox-content-body" style="overflow-x: auto;">
                        <table class="table ">
                            <thead class="border-bottom card-header">
                                <tr class="text-left text-uppercase ">
                                    <th class="pb-3">
                                        <span class="text-dark-75">Category</span>
                                    </th>
                                    <th class="py-3" style="min-width: 250px; max-width: 350px; width:60%"><span class="text-dark-75">Subject</span></th>
                                    <th class="py-3"><span class="text-dark-75">Status</span></th>
                                    <th class="py-3"><span class="text-dark-75">Last Updated</span></th>

                                </tr>
                            </thead>
                            <tbody style="overflow-y: auto; height:200px">
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mailbox-content-footer d-flex align-items-center">
                        <div class="text-dark fw-bold">1,232 messages</div>
                        <div class="btn-group ms-auto">

                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane  fade" id="nav-tab-7">
                <div class="mailbox-content">
                    <div class="mailbox-content-body" style="overflow-x: auto;">
                        <table class="table ">
                            <thead class="border-bottom card-header">
                                <tr class="text-left text-uppercase ">
                                    <th class="pb-3">
                                        <span class="text-dark-75">Category</span>
                                    </th>
                                    <th class="py-3" style="min-width: 250px; max-width: 350px; width:60%"><span class="text-dark-75">Subject</span></th>
                                    <th class="py-3"><span class="text-dark-75">Status</span></th>
                                    <th class="py-3"><span class="text-dark-75">Last Updated</span></th>

                                </tr>
                            </thead>
                            <tbody style="overflow-y: auto; height:200px">
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                                <tr class="border-bottom tr-hover read ">

                                    <td class="px-3 py-1">
                                        <div class="text-dark-75 ">
                                            <span class=""><b>CC</b>/<del>To</del>/<del>Transferred</del></span><br>
                                            <span class="label label-light-primary label-inline">Examination</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder ">#14828</span>
                                        <p class="unread-sub mb-0 subject">Missed MA History 2nd Semister March Exam</p>

                                    </td>
                                    <td>
                                        <span class="text-bold "><span class="status">Replied</span></span>

                                    </td>
                                    <td>
                                        <span class="fw-bold ">27 Feb</span>

                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mailbox-content-footer d-flex align-items-center">
                        <div class="text-dark fw-bold">1,232 messages</div>
                        <div class="btn-group ms-auto">

                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-left"></i>
                            </button>
                            <button class="btn btn-white btn-sm">
                                <i class="fa fa-fw fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
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