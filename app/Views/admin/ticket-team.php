<?php
use App\Models\ApplicationModel;
$pager = \Config\Services::pager();
?>
<div class="flex-row-fluid d-flex flex-column ml-lg-3">
    <div class="d-flex flex-column flex-grow-1">
        <div class="row mx-0">
            <div class="col-xl-12">
                <!--begin::Card-->
                <div class="card card-custom card-stretch" id="kt_todo_list">

                    <!--begin::Body-->
                    <div class="card-body p-0">

                        <style>
                            .tr-hover {
                                cursor: pointer
                            }

                            .tr-hover:hover {
                                background: #fff;
                                box-shadow: 0 1px 2px 1px #b4b4b4;
                            }

                            .read>td {
                                background: #eee;
                                font-weight: 300 !important;
                            }

                            .unread>td>.unread-sub {
                                font-weight: 600 !important;
                            }

                            .subject {
                                display: -webkit-box;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                                -webkit-line-clamp: 1;
                            }
                        </style>
                        <div class="table-responsive">
                            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                <thead class="border-bottom">
                                    <tr class="text-left text-uppercase ">
                                        <th class="py-3">
                                            <span class="text-dark-75">Category</span>
                                        </th>
                                        <th class="py-3" style="min-width: 250px; max-width: 350px; width:60%"><span class="text-dark-75">Subject</span></th>
                                        <th class="py-3"><span class="text-dark-75">Status</span></th>
                                        <th class="py-3"><span class="text-dark-75">Last Updated</span></th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($tickets as $ticket) { ?>
                                        <tr class="border-bottom tr-hover <?= ($ticket['read_status'] == 1) ? 'read' : 'unread' ?> " onclick="window.location.href='<?= base_url('admin/tickets/' . $ticket['token_id'] . '?step=team') ?>'">

                                            <td class="px-3 py-1">
                                                <div class="text-dark-75 d-block font-size-lg">
                                                    <?php $drModel = new ApplicationModel('lms_users_'.session('year'), 'lu_id','setting_db');
                                                    $desk = $drModel->select(['user_name'])->where('lu_id', $ticket['tc_department'])->first();
                                                    ?>
                                                    <span class="label label-light-info font-weight-bold label-inline mb-1"><?= ($ticket['type'] == '0') ? 'To: ' :(($ticket['type'] == '1') ? 'CC: ' : 'Transferred: ') ?><b><?= ucwords($desk['user_name']) ?></b></span><br>
                                                    <span class="label label-light-primary label-inline"><?= $ticket['title'] ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-dark-75 d-block font-size-lg">#<?= $ticket['token_id'] ?></span>
                                                <p class="unread-sub mb-0 subject"><?= $ticket['subject'] ?></p>

                                            </td>
                                            <td>
                                                <span class="text-dark-75 d-block font-size-lg"><span class="label label-light-<?= $ticket['status_color'] ?> font-weight-bold ml-1 label-inline"><?= $ticket['status_name'] ?></span></span>

                                            </td>
                                            <td>
                                                <span class="text-dark-75 d-block font-size-lg"><?= time_elapsed_string($ticket['updated_at']) ?></span>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <style>
                                .pagination-nav nav ul>.active>a {
                                    margin-left: .4rem;
                                    margin-right: .4rem;
                                    outline: 0 !important;
                                    cursor: pointer;
                                    display: -webkit-box;
                                    display: -ms-flexbox;
                                    display: flex;
                                    -webkit-box-pack: center;
                                    -ms-flex-pack: center;
                                    justify-content: center;
                                    -webkit-box-align: center;
                                    -ms-flex-align: center;
                                    align-items: center;
                                    height: 2.25rem;
                                    min-width: 2.25rem;
                                    padding: .5rem;
                                    text-align: center;
                                    position: relative;
                                    font-size: 1rem;
                                    line-height: 1rem;
                                    font-weight: 500;
                                    border-radius: .42rem;
                                    border: 0;
                                    -webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
                                    transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
                                    transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
                                    transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease;
                                    background-color: #3699ff;
                                    color: #fff;
                                }

                                .pagination-nav nav ul li a {
                                    margin-left: .4rem !important;
                                    margin-right: .4rem !important;
                                    outline: 0 !important;
                                    cursor: pointer;
                                    display: -webkit-box;
                                    display: -ms-flexbox;
                                    display: flex;
                                    -webkit-box-pack: center;
                                    -ms-flex-pack: center;
                                    justify-content: center;
                                    -webkit-box-align: center;
                                    -ms-flex-align: center;
                                    align-items: center;
                                    height: 2.25rem !important;
                                    min-width: 2.25rem !important;
                                    padding: .5rem;
                                    text-align: center;
                                    position: relative;
                                    font-size: 1rem;
                                    line-height: 1rem;
                                    font-weight: 500;
                                    border-radius: .42rem;
                                    border: 0;
                                    -webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
                                    transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
                                    transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
                                    transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease;
                                    color: #7e8299;
                                    background-color: transparent;
                                }
                            </style>
                            <hr>
                            <div class="row mt-4 mx-0">
                                <div class="col-lg-12 text-center">
                                    <div id='pagination' class='pagination-nav'>
                                        <?= $pager->makeLinks($page, $perPage, $totalItems) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Responsive container-->

                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
</div>