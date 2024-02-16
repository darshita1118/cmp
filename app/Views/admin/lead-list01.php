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

<!-- required files -->
<link href="<?= base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') ?>" rel="stylesheet">
<!-- required files -->
<link href="<?= base_url('assets/plugins/select2/dist/css/select2.min.css') ?>" rel="stylesheet" />
<!-- required files -->
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<!-- required files -->
<link href="<?= base_url('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-select-bs5/css/select.bootstrap5.min.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') ?>"></script>
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


<div class="panel panel-default">

    <div class="panel-heading">
        <ol class="breadcrumb panel-title">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Leads</a></li>
            <li class="breadcrumb-item active">All Leads</li>
        </ol>

        <div class="mb-1 me-2">
            <span class="badge">Total Leads: <?= $total_leads ?? 0 ?></span>
        </div>

        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-sm btn-icon bg-black" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>

            <a href="javascript:;" class="btn btn-sm btn-icon bg-black" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="fa fa-lg fa-sliders"></i></a>


            <div class="offcanvas offcanvas-top ps-5 pe-5" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 id="offcanvasTopLabel">Filters</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mt-md-3">

                    <div id="myfilter" class="filters container-fluid p-4">
                        <!-- Moment.js -->
                        <script src="../assets/plugins/moment/min/moment.min.js"></script>
                        <!-- Daterangepicker JavaScript -->
                        <script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Mobile No.</label>
                                    <input class="form-control" type="tel" placeholder="Enter Mobile No." />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Default Date Ranges</label>
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
                                    <select class="default-select2 form-select">
                                        <option value="AK">Arisha</option>
                                        <option value="AK">Arisha</option>
                                        <option value="AK">Arisha</option>
                                        <option value="AK">Arisha</option>
                                        <option value="AK">Arisha</option>
                                        <option value="HI">Hawaii</option>
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
                        </div>
                    </div>

                    <form action="" class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Mobile No.</label>
                                <input name="mobile" class="form-control" type="tel" placeholder="Search mobile no.." minlength="8" value="<?= isset($_GET['mobile']) ? $_GET['mobile'] : null ?>" maxlength="12" />
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
                                <select class="form-select" name="status[]" id="status">
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
                                <label class="form-label">Department</label>
                                <select name="department[]" id="department" class="form-select">
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
                                    <option selected>--Choose Program-- </option>
                                    <?php foreach ($courses as $program) : ?>
                                        <option data-dept="<?= $program['dept_id'] ?>" data-level="<?= $program['level_id']  ?>" value="<?= $program['sc_id'] ?>" <?= (in_array($program['sc_id'], $_GET['program'] ?? [])) ? 'selected' : null ?>><?= $program['course_name'] ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Lead Nationality</label>
                                <select class="form-select" name="nationality[]" id="nationality">
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
        <table id="data-table-combine" class="table table-striped table-bordered align-middle w-100 text-wrap cmp-table">
            <thead>
                <tr>
                    <th width="1%">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Department</th>
                    <th>Program</th>
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
                        <td>
                            <a href="<?= base_url('admin/edit-lead/' . $lead['lid']) ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                            <a href="<?= base_url('admin/delete/lead/' . $lead['lid']) ?>" class="btn btn-danger"><i class="fa fa-trash-can"></i></a>
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



</div>


<script>
    $("#default-daterange").daterangepicker({
        opens: "right",
        format: "MM/DD/YYYY",
        separator: " to ",
        startDate: moment().subtract("days", 29),
        endDate: moment(),
        minDate: "01/01/2023",
        maxDate: "12/31/2023",
    }, function(start, end) {
        $("#default-daterange input").val(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
    });
</script>
<!-- script -->
<script>
    $(".default-select2").select2();
</script>