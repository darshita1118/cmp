<?php

use App\Models\ApplicationModel;

function getHandlerList($notIn = [])
{
    $handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', 'reg_setting_db');
    $handlers = $handlerModel->select(['lu_id', 'user_name', 'user_role', 'user_report_to'])->where(['user_status' => 1, 'user_deleted_status' => 0, 'user_report_to' => session('id')]);
    if (!empty($notIn)) {
        $handlers->whereNotIn('lu_id', $notIn);
    }
    return $handlers->findAll() ?? [];
}
$handlers = getHandlerList([session('unique_id')]);
?>
<!-- Include jQuery -->
<script src="<?= base_url('assets/js/jquery-3.6.4.min.js') ?>"></script>

<!-- required files -->
<link href="<?= base_url('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-colreorder-bs5/css/colReorder.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-rowreorder-bs5/css/rowReorder.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-select-bs5/css/select.bootstrap5.min.css') ?>" rel="stylesheet" />

<script src="<?= base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-colreorder/js/dataTables.colReorder.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-colreorder-bs5/js/colReorder.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-rowreorder/js/dataTables.rowReorder.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-rowreorder-bs5/js/rowReorder.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-select/js/dataTables.select.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-select-bs5/js/select.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/build/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/build/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jszip/dist/jszip.min.js') ?>"></script>


<div class="row">

    <div class="col-xl-12">

        <div class="panel panel-inverse">

            <div class="panel-heading">
                <ol class="breadcrumb panel-title">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Leads</a></li>
                    <li class="breadcrumb-item active">Allocated Leads</li>
                </ol>

                <div class="mb-1 me-2">
                    <span class="badge bg-green text-white"> Total Allocated Leads: <?= $total_leads ?? 0 ?></span>
                </div>

                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="fa fa-lg fa-fw fa-sliders"></i></a>


                    <div class="offcanvas offcanvas-top ps-5 pe-5" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                        <div class="offcanvas-header border-bottom">
                            <h5 id="offcanvasTopLabel">Filters</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body mt-md-3">
                            <form action="" class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile No.</label>
                                        <input class="form-control" type="tel" name="mobile" placeholder="Search mobile no.." minlength="8" value="<?= isset($_GET['mobile']) ? $_GET['mobile'] : null ?>" maxlength="12" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3"><label class="form-label">Date</label>
                                        <div class="input-group" id="default-daterange">

                                            <input type="text" name="default-daterange" class="form-control" value="" placeholder="click to select the date range">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status[]" class="form-select">
                                            <option selected>--Select -- </option>
                                            <?php foreach ($statues as $status) : ?>
                                                <option value="<?= $status['status_id'] ?>" <?= (in_array($status['status_id'], $_GET['status'] ?? [])) ? 'selected' : null ?>><?= $status['status_name'] ?> </option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Source</label>
                                        <select name="source[]" id="source" class="form-select">
                                            <option selected>--Select-- </option>
                                            <?php foreach ($sources as $source) : ?>
                                                <option value="<?= $source['source_id'] ?>" <?= (in_array($source['source_id'], $_GET['source'] ?? [])) ? 'selected' : null ?>><?= $source['source_name'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label" name="department[]" id="department">Department</label>
                                        <select class="form-select">...
                                            <option selected>--Department-- </option>
                                            <?php foreach ($departments as $dept) : ?>
                                                <option value="<?= $dept['dept_id'] ?>" <?= (in_array($dept['dept_id'], $_GET['department'] ?? [])) ? 'selected' : null ?>><?= $dept['dept_name'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Program</label>
                                        <select class="form-select" name="program[]" id="program">
                                            <option selected>--Chooes Program-- </option>
                                            <?php foreach ($courses as $program) : ?>
                                                <option data-dept="<?= $program['dept_id'] ?>" data-level="<?= $program['level_id']  ?>" value="<?= $program['coi_id'] ?>" <?= (in_array($program['coi_id'], $_GET['program'] ?? [])) ? 'selected' : null ?>><?= $program['course_name'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label" name="nationality[]" id="nationality">Lead Nationality</label>
                                        <select class="form-select">
                                            <option selected>--Select-- </option>
                                            <?php foreach ($student_nationalities as $nation) : ?>
                                                <option value="<?= $nation['id'] ?>" <?= (in_array($nation['id'], $_GET['nationality'] ?? [])) ? 'selected' : null ?>><?= $nation['name'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-md-4">
                                    <button type="submit" class="btn btn-primary w-100px me-5px">Search</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

            <div class="panel-body">
                <table id="data-table-combine" class="table table-striped table-bordered align-middle w-100 text-nowrap cmp-table">
                    <thead>
                        <tr>
                            <th width="1%">ID</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">School/Program</th>
                            <th class="text-nowrap">Handler</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Source</th>
                            <th class="text-nowrap">Allocation Date</th>
                            <th class="text-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($leads as $lead) : ?>
                            <tr class="odd gradeX">
                                <td width="1%" class="fw-bold"><?= $count ?></td>
                                <td><?= trim(ucwords($lead['lead_first_name'] . ' ' . $lead['lead_middle_name'] . ' ' . $lead['lead_last_name'])) ?><br>
                                    <small><?= $lead['lead_email'] ?></small><br>
                                    <small><?= "(" . $lead['lead_country_code'] . ")" ?>-<?= $lead['lead_mobile'] ?></small>
                                </td>
                                <td><?= $lead['dept_name'] . '/' . $lead['course_name'] ?></td>
                                <td><?= trim(ucwords($lead['user_name'])) ?><br>
                                    <small><?= $lead['user_email'] ?></small><br>
                                    <small><?= $lead['user_mobile'] ?></small>
                                </td>
                                <td><?= $lead['status_name'] ?></td>
                                <td><?= $lead['source_name'] ?></td>
                                <td><?= $lead['lal_created_at'] ?></td>
                                <td nowrap="">
                                    <a href="<?= base_url('admin/lead-profile/' . $lead['lid']) ?>" class="btn btn-sm btn-primary me-1">Edit</a>
                                    <a href="#" class="btn btn-sm btn-warning">Transfer</a>
                                </td>
                            </tr>
                        <?php $count++;
                        endforeach; ?>
                    </tbody>
                </table>

                <!-- script -->
                <script>
                    var options = {
                        dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-lg-8 d-lg-block"<"d-flex d-lg-inline-flex justify-content-center mb-md-2 mb-lg-0 me-0 me-md-3"l><"d-flex d-lg-inline-flex justify-content-center mb-md-2 mb-lg-0 "B>><"col-lg-4 d-flex d-lg-block justify-content-center"fr>>t<"row"<"col-md-5"i><"col-md-7"p>>>',
                        buttons: [{
                                extend: 'copy',
                                className: 'btn-sm'
                            },
                            {
                                extend: 'csv',
                                className: 'btn-sm'
                            },
                            {
                                extend: 'excel',
                                className: 'btn-sm'
                            },
                            {
                                extend: 'pdf',
                                className: 'btn-sm'
                            },
                            {
                                extend: 'print',
                                className: 'btn-sm'
                            }
                        ],
                        responsive: true,
                        colReorder: true,
                        keys: true,
                        rowReorder: true,
                        select: true
                    };

                    if ($(window).width() <= 767) {
                        options.rowReorder = false;
                        options.colReorder = false;
                    }
                    $('#data-table-combine').DataTable(options);
                </script>
            </div>


            <div class="hljs-wrapper">
                <pre><code class="html" data-url="../assets/data/table-manage/buttons.json"></code></pre>
            </div>

        </div>

    </div>

</div>