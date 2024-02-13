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
                    <li class="breadcrumb-item"><a href="javascript:;">Login History</a></li>
                    <li class="breadcrumb-item active">Login History Counselors</li>
                </ol>

                <div class="mb-1 me-2">
                    <span class="badge bg-green text-white"><?= ucwords($userType) ?>Total Users: <?= $total_records ?? '0' ?></span>
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
                <table id="data-table-combine" class="table table-striped table-bordered align-middle w-100 text-nowrap cmp-table">
                    <thead>
                        <tr>
                            <th width="1%">ID</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Mobile</th>
                            <th class="text-nowrap">IP Address</th>
                            <th class="text-nowrap">Login Time</th>
                            <th class="text-nowrap">Logout Time</th>
                            <th class="text-nowrap">Working Hours</th>
                            <th class="text-nowrap">User Type</th>
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