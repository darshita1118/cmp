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
                                        <th class="py-3" ><span class="text-dark-75">Status</span></th>
                                        <th class="py-3" ><span class="text-dark-75">Last Updated</span></th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($tickets as $ticket) { ?>
                                        <tr class="border-bottom tr-hover read" onclick="window.location.href='<?= base_url('admin/tickets/' . $ticket['token_id'] . '?step=closed') ?>'">

                                            <td class="px-3 py-1">
                                                <div class="text-dark-75 d-block font-size-lg">
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