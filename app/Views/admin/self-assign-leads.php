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

<!-- DataTables CSS -->
<link href="<?= base_url() ?>assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') ?>" rel="stylesheet" />
<!-- daterange css -->
<link href="<?= base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<!-- End CSS -->


<!-- content -->

<div class="panel panel-inverse">

    <div class="panel-heading">
        <ol class="breadcrumb panel-title">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Leads</a></li>
            <li class="breadcrumb-item active">Self Assign Leads</li>
            <div class="p-2">
                <span class="badge bg-warning text-white rounded-pill fs-6"><?= $total_leads ?? 0 ?></span>
            </div>
        </ol>


        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" title="Filter" aria-controls="offcanvasTop">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-right" viewBox="0 0 16 16">
                    <path d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5m0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5m0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5"></path>
                </svg>
            </a>


            <div class="offcanvas offcanvas-top ps-5 pe-5" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 id="offcanvasTopLabel">Filters</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mt-md-3">
                    <form action="" method="get" class="row">
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
                                <select name="status[]" id="status" class="form-select">
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
                                <select class="form-select" name="department[]" id="department">
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
                                <select name="program[]" id="program" class="form-select">
                                    <option selected>--Chooes Program-- </option>
                                    <?php foreach ($courses as $program) : ?>
                                        <option data-dept="<?= $program['dept_id'] ?>" data-level="<?= $program['level_id']  ?>" value="<?= $program['coi_id'] ?>" <?= (in_array($program['coi_id'], $_GET['program'] ?? [])) ? 'selected' : null ?>><?= $program['course_name'] ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Lead Nationality</label>
                                <select name="nationality[]" id="nationality" class="form-select">
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
        <table id="data-table-fixed-header" class="table table-striped table-bordered align-middle w-100 text-wrap ">
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
                        <td nowrap="">
                            <a href="<?= base_url('admin/lead-profile/' . $lead['lid']) ?>" title="Edit Lead" data-bs-toggle="tooltip" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-pen"></i></a>
                        </td>
                    </tr>
                <?php $count++;
                endforeach; ?>
            </tbody>
        </table>

    </div>


</div>

<!-- End Content -->

<!-- DataTables JS -->
<script src="<?= base_url() ?>assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-fixedheader-bs5/js/fixedHeader.bootstrap5.min.js"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/build/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/build/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jszip/dist/jszip.min.js') ?>"></script>

<!-- Form Plugins Scripts -->
<script src="<?= base_url() ?>assets/plugins/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Select2 JS -->
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<script src="<?= base_url() ?>assets/plugins/select-picker/dist/picker.min.js"></script>

<script>
    // Other Select-Picker initialization
    $('#department, #program, #status, #source, #nationality, #handler').picker({
        search: true
    });
    $('#offcanvasTop .selectpicker').picker();

    $(".default-select2").select2({
        dropdownParent: $('#offcanvasTop')
    });

    // Datepicker JS

    var handleRenderDateRangePicker = function() {
        $("#default-daterange").daterangepicker({
            opens: "right",
            format: "MM/DD/YYYY",
            separator: " to ",
            startDate: moment(),
            endDate: moment(),
            showDropdowns: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                weekLabel: 'W',
                daysOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                monthNames: [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ],
                firstDay: 1
            }
        }, function(start, end) {
            $("#default-daterange input").val(
                start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
            );
            // Check if start and end are valid dates

            //date formate 2024-01-28
            if (start.isValid() && end.isValid()) {
                // Set the values in the HTML input fields
                $("#to").val(start.format("YYYY-MM-D"));
                $("#from").val(end.format("YYYY-MM-D"));
            } else {
                // Clear the input fields if dates are not valid
                $("#from").val("");
                $("#to").val("");
            }

        });
    };

    var FormPlugins = (function() {
        "use strict";
        return {
            init: function() {
                handleRenderDateRangePicker();
            },
        };
    })();

    $(document).ready(function() {
        FormPlugins.init();
        $(document).on("theme-reload", function() {
            handleRenderColorpicker();
        });
    });
</script>