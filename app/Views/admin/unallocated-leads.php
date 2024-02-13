<?php

use App\Models\ApplicationModel;

$year = session('year');
$suffix = session('suffix');

function getStatusMessage($leadId)
{
}
function getStatusTime($leadId)
{
}

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
                    <li class="breadcrumb-item active">Unallocated Leads</li>
                </ol>

                <div class="mb-1 me-2">
                    <span class="badge bg-green text-white">Total Leads: <?= $total_leads ?? 0 ?></span>
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
                                        <input class="form-control" type="tel" placeholder="Enter Mobile No." />
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
                                        <select class="form-select">...
                                            <option selected>--Select -- </option>
                                            <option value="1">Admin</option>
                                            <option value="2">Handler</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Source</label>
                                        <select class="form-select">...
                                            <option selected>--Select-- </option>
                                            <option value="1">Suspended</option>
                                            <option value="2">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Department</label>
                                        <select class="form-select">...
                                            <option selected>--Department-- </option>
                                            <option value="1">Admin</option>
                                            <option value="2">Handler</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Program</label>
                                        <select class="form-select">...
                                            <option selected>--Chooes Program-- </option>
                                            <option value="1">Suspended</option>
                                            <option value="2">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Lead Nationality</label>
                                        <select class="form-select">...
                                            <option selected>--Select-- </option>
                                            <option value="1">Suspended</option>
                                            <option value="2">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-md-4">
                                    <button type="submit" class="btn btn-primary w-100px me-5px">Apply Filter</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

            <div class="panel-body">
                <table id="data-table-combine" class="table table-striped table-bordered align-middle w-100 text-wrap cmp-table">
                    <thead>
                        <tr>
                            <th width="1%">ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Department</th>
                            <th>School/Program</th>
                            <th>Status</th>
                            <th>Source</th>
                            <th>Create At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($leads as $lead) : ?>
                            <tr class="odd gradeX">
                                <td width="1%" class="fw-bold"><?= $count ?></td>
                                <td><?= trim(ucwords($lead['lead_first_name'] . ' ' . $lead['lead_middle_name'] . ' ' . $lead['lead_last_name'])) ?></td>
                                <td><?= $lead['lead_email'] ?></td>
                                <td><?= "(" . $lead['lead_country_code'] . ")" ?>-<?= $lead['lead_mobile'] ?></td>
                                <td><?= $lead['dept_name'] ?></td>
                                <td><?= $lead['course_name'] ?></td>
                                <td><?= $lead['status_name'] ?></td>
                                <td><?= $lead['source_name'] ?></td>
                                <td><?= date('d/m/Y H:i:s', strtotime($lead['lead_created_at'])) ?></td>
                                <td nowrap="">
                                    <a href="<?= base_url('admin/lead-profile/' . $lead['lid']) ?>" class="btn btn-sm btn-primary me-1">Edit</a>
                                    <a href="<?= base_url('admin/delete/lead/' . $lead['lid']) ?>" class="btn btn-sm btn-warning">Transfer</a>
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