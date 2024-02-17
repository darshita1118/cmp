<?php

use App\Models\ApplicationModel;

function getSinglehandler($handler)
{
    if ($handler == session('id'))
        return 'You';
    $handlerModel = new ApplicationModel('lms_users_' . session('year'), 'lu_id', 'reg_setting_db');
    $handler = $handlerModel->select(['user_name'])->where('lu_id', $handler)->where('user_report_to', session('report_to'))->first();
    return $handler ? $handler['user_name'] : '';
}


$admissionStatus = [
    'Open For Student.',
    'Application Submited by student.',
    'Application Under Process.',
    'Application Reject by Respected Desk.',
    'Application is a span type given by Respected Desk.',
    'Application Admission process done.'
];

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
                    <li class="breadcrumb-item"><a href="javascript:;">By Self</a></li>
                    <li class="breadcrumb-item active">Process Application</li>
                </ol>

                <div class="mb-1 me-2">
                    <span class="badge bg-green text-white">Applicant List [Totals: <?= $total_records ?? 0 ?>]</span>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->

                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    <a href="<?= base_url('handler/add-lead') ?>" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>New Applicant</a>
                    <!--end::Button-->
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
                                        <input type="tel" name="mobile" class="form-control" placeholder="Search mobile no.." minlength="8" value="<?= isset($_GET['mobile']) ? $_GET['mobile'] : null ?>" maxlength="12">
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
                                <!-- <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select">...
                                            <option selected>--Select -- </option>
                                            <option value="1">Admin</option>
                                            <option value="2">Handler</option>

                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Source</label>
                                        <select name="source[]" id="source" multiple class="form-select">
                                            <option value="">--Select--</option>
                                            <?php foreach ($sources as $source) : ?>
                                                <option value="<?= $source['source_id'] ?>" <?= (in_array($source['source_id'], $_GET['source'] ?? [])) ? 'selected' : null ?>><?= $source['source_name'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                </div>
                                <!-- <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Department</label>
                                        <select class="form-select">...
                                            <option selected>--Department-- </option>
                                            <option value="1">Admin</option>
                                            <option value="2">Handler</option>

                                        </select>

                                    </div>
                                </div> -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Program</label>
                                        <select class="form-select" name="program[]" id="program" multiple>
                                            <option value="">--Select--</option>
                                            <?php foreach ($courses as $program) : ?>
                                                <option data-dept="<?= $program['dept_id'] ?>" data-level="<?= $program['level_id']  ?>" value="<?= $program['coi_id'] ?>" <?= (in_array($program['coi_id'], $_GET['program'] ?? [])) ? 'selected' : null ?>><?= $program['course_name'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Lead Nationality</label>
                                        <select class="form-select" name="nationality[]" id="nationality" multiple>
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
                <table id="data-table-combine" class="table table-striped table-bordered align-middle w-100 text-wrap cmp-table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name and Email</th>
                            <th>Mobile</th>
                            <th>SID/Password</th>
                            <th>Form Step</th>
                            <th>Admission Status</th>
                            <th>Program</th>
                            <th>Handler</th>
                            <th>Source</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($leads as $lead) : ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= trim(ucwords($lead['lead_name'])) ?><br>
                                    <small> <b>Email:</b> <?= $lead['lead_email'] ?> <small>
                                </td>
                                <td><?= "(" . $lead['lead_country_code'] . ")" ?>-<?= $lead['lead_mobile'] ?></td>
                                <td><?= $lead['sid']; ?>/<?= base64_decode($lead['password']) ?></td>
                                <td><?= $lead['fs_name'] ?? 'Form Step Unknown'; ?></td>
                                <td><?= $admissionStatus[$lead['admisn_status']] ?></td>
                                <td><?= $lead['course_name'] ?></td>
                                <td><?= getSinglehandler($lead['handler_id']) ?></td>

                                <td><?= $lead['source_name'] ?></td>

                                <td class="">
                                    <a href="<?= base_url('handler/process-application/' . $lead['lead_id'] . '/' . $lead['sid']) ?>" class="btn btn-sm btn-clean" title="Proceed Application">
                                        <i class="flaticon2-sheet"></i> Proceed App.
                                    </a>


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