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
            <li class="breadcrumb-item"><a href="javascript:;">Login History</a></li>
            <li class="breadcrumb-item active">Login History Counselors</li>
            <div class="p-2">
                <span class="badge bg-warning text-white rounded-pill fs-6"><?= $total_records ?? '0' ?></span>
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
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" placeholder="Search email id." value="<?= isset($_GET['email']) ? $_GET['email'] : null ?>" />
                            </div>

                        </div>
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
                                <label class="form-label">Handler</label>
                                <select class="form-select" name="users[]" id="handler">...
                                    <option selected>--Select -- </option>
                                    <?php foreach ($handlers as $handler) : ?>
                                        <option value="<?= $handler['lu_id'] ?>" <?= (in_array($handler['lu_id'], $_GET['users'] ?? [])) ? 'selected' : null ?>><?= $handler['user_name'] ?> </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">User Type</label>
                                <select class="form-select" name="type" id="type">
                                    <option selected>--Select-- </option>
                                    <option value="0" <?= ('0' == ($_GET['type'] ?? '')) ? 'selected' : null ?>>Handler</option>
                                    <option value="1" <?= ('1' == ($_GET['type'] ?? '')) ? 'selected' : null ?>>Team Leader</option>
                                    <option value="2" <?= ('2' == ($_GET['type'] ?? '')) ? 'selected' : null ?>>LMS Admin</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Sort By</label>
                                <select name="sort" id="sort" class="form-select">...
                                    <option selected>--Select -- </option>
                                    <option value="user" <?= ('user' == ($_GET['sort'] ?? '')) ? 'selected' : null ?>>User/Handler</option>
                                    <option value="date" <?= ('date' == ($_GET['sort'] ?? '')) ? 'selected' : null ?>>Date Wise</option>

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
        <table id="data-table-fixed-header" class="table table-striped table-bordered align-middle w-100 text-wrap ">
            <thead>
                <tr>
                    <th width="1%">ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>IP Address</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                    <th>Working Hours</th>
                    <th>User Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($users as $user) : ?>
                    <tr class="odd gradeX">
                        <td width="1%" class="fw-bold"><?= $count ?></td>
                        <td><?= trim(ucwords($user['user_name'])) ?></td>
                        <td>Mobile:<?= $user['user_mobile'] ?><br>
                            Email: <?= $user['user_email'] ?></td>
                        <td><?= $user['ip_address'] ?></td>
                        <td><?= date('l d M Y h:i:s a', $user['login_time']) ?></td>
                        <td><?= date('l d M Y h:i:s a', $user['logout_time']) ?></td>
                        <td> <?php
                                $start_date = new DateTime(date('Y-m-d h:i:s', $user['login_time']));
                                $since_start = $start_date->diff(new DateTime(date('Y-m-d h:i:s', $user['logout_time'])));

                                echo $since_start->h . ' hours ';
                                echo $since_start->i . ' minutes';
                                ?></td>
                        <td> <?php if ($user['user_role'] == '2') : ?>
                                Lms Admin
                            <?php elseif ($user['user_role'] == '1') : ?>
                                Team Leader
                            <?php else : ?>
                                Handler
                            <?php endif; ?></td>
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
    $('#department, #program, #status, #source, #nationality').picker({
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