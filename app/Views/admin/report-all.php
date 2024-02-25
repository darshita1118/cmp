<link href="<?= base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />

<link href="<?= base_url() ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

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
<style>
    .timeline .timeline-content {
        background: #dfdede;
    }

    @media (min-width: 600px) {
        .timeline .timeline-content::before {
            border-right-color: #dfdede;
        }
    }

    @media (max-width: 575.98px) {
        .timeline .timeline-content::before {
            border-bottom-color: #dfdede;
        }


    }
</style>

<div class="panel panel-inverse">
    <div class="panel-heading">
        <h4 class="panel-title">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</a></li>
                <li class="breadcrumb-item">Reports</a></li>
                <li class="breadcrumb-item">Counslar Work Report</li>
                <div class="p-2">
                    <span class="badge bg-warning text-white rounded-pill fs-6"><?= $total_leads ?? 0 ?></span>
                </div>
            </ol>
        </h4>
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
                    <form action="" class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Mobile No.</label>
                                <input class="form-control" name="mobile" type="number" placeholder="Search mobile no.." minlength="8" value="<?= isset($_GET['mobile']) ? $_GET['mobile'] : null ?>" maxlength="12" />
                            </div>

                        </div>
                        <div class="col-md-3">
                            <!-- html -->
                            <label class="form-label">Date</label>
                            <div class="input-group" id="default-daterange">
                                <input type="text" name="default-daterange" class="form-control" value="" placeholder="click to select the date range" />
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="default-select2 form-select" name="status[]" id="status" multiple>
                                    <?php foreach ($statues as $status) : ?>
                                        <option value="<?= $status['status_id'] ?>" <?= (in_array($status['status_id'], $_GET['status'] ?? [])) ? 'selected' : null ?>><?= $status['status_name'] ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Source</label>
                                <select class="default-select2 form-select" name="source[]" id="source" multiple>
                                    <?php foreach ($sources as $source) : ?>
                                        <option value="<?= $source['source_id'] ?>" <?= (in_array($source['source_id'], $_GET['source'] ?? [])) ? 'selected' : null ?>><?= $source['source_name'] ?> </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Program</label>
                                <select name="program[]" id="program" class="default-select2 form-select">

                                    <?php foreach ($courses as $program) : ?>
                                        <option value="<?= $program['sc_id'] ?>" <?= (in_array($program['sc_id'], $_GET['program'] ?? [])) ? 'selected' : null ?>><?= $program['course_name'] ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Handler</label>
                                <select name="handlers[]" id="handlers" class="default-select2 form-select" multiple>

                                    <?php foreach ($handlers as $handler) : ?>
                                        <option value="<?= $handler['lu_id'] ?>" <?= (in_array($handler['lu_id'], $_GET['handlers'] ?? [])) ? 'selected' : null ?>><?= $handler['user_name'] ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Lead Nationality</label>
                                <select class="default-select2 form-select" name="nationality[]" id="nationality" multiple>
                                    <?php foreach ($student_nationalities as $nation) : ?>
                                        <option value="<?= $nation['id'] ?>" <?= (in_array($nation['id'], $_GET['nationality'] ?? [])) ? 'selected' : null ?>><?= $nation['name'] ?> </option>
                                    <?php endforeach; ?>
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
        <!-- statics -->
        <div class="row">
            <div class="col-md-2">
                <div class="widget widget-stats bg-teal mb-7px">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">Lead</div>
                        <div class="stats-number"><?= array_sum(array_column($statusWise, 'total_leads')); ?></div>
                    </div>
                </div>
            </div>
            <!--Stats -->
            <?php foreach ($statusWise as $report) : ?>
                <div class="col-md-2">
                    <div class="widget widget-stats bg-blue mb-7px">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                        <div class="stats-content">
                            <div class="stats-title"><?= $report['name'] ?></div>
                            <div class="stats-number"><?= $report['total_leads'] ?></div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
        <!-- statics end -->
        <!-- History -->

        <div class="border">
            <div class="profile-content col-md-8 m-auto">
                <h3 class="text-center ">Work Report History</h3>
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="profile-post">
                        <div class="timeline ">
                            <?php foreach ($remarks as $row) :  ?>
                                <div class="timeline-item handler-worker-report">
                                    <div class="timeline-time">
                                        <span class="pt-2 date fs-4 fs-lg-4 "><?= $row['lr_created_at'] ?></span>
                                        <!-- <span class="time"></span> -->
                                    </div>
                                    <div class="timeline-icon">
                                        <a href="javascript:;">&nbsp;</a>
                                    </div>
                                    <div class="timeline-content ">
                                        <div class="timeline-header">
                                            <div class="username">
                                                <a href="javascript:;"> <?= ucwords(trim($row['lead_first_name'] . ' ' . $row['lead_middle_name'] . ' ' . $row['lead_last_name'])) ?> <i class="fa fa-check-circle text-blue ms-1"></i></a>
                                                <div class="text-muted fs-12px"><span class="date"> <?= $row['lead_email'] ?> | <i class="la la-phone"></i>
                                                        <?= $row['lead_mobile'] ?></span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-body">
                                            <small> <?= $row['lr_remark'] ?>
                                            </small><br>
                                            <small> Handler: <?= $row['user_name'] ?></small>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- History end -->

    </div>
</div>

<script src="<?= base_url('assets/js/iconify.min.js') ?>" type="text/javascript"></script>
<!-- Select2 JS -->
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>

<!-- Form Plugins Scripts -->
<script src="<?= base_url() ?>assets/plugins/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
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

<style>

    @media (max-width: 575.98px) {
        .timeline .timeline-content {
            margin-top: 70px;
        }
    }
</style>