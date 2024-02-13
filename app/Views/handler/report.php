<?php

$dataAdmissionStatus = [
    '0' => ["id" => "0", "name" => "Open Student", "color" => "#32ccc4"],
    '1' => ["id" => "1", "name" => "Application Form", "color" => "#3284cc"],
    '2' => ["id" => "2", "name" => "Under Proccess", "color" => "#ffa800"],
    '3' => ["id" => "3", "name" => "Rejected Form", "color" => "#3699ff"],
    '4' => ["id" => "4", "name" => "Spam Form", "color" => "#c94ef6"],
    '5' => ["id" => "5", "name" => "Admission Done", "color" => "#f64e60"],
];

$color = array_column($dataAdmissionStatus,'color');


$sqlAdmissionStatus = array_column($admissionStatus, 'admisn_status');
/*
$handlersJson = json_encode($handlers);
$statusesJson = json_encode($statuses);
$sourcesJson = json_encode($sources);
$programsJson = json_encode($programs);

?>
<script>
const handlers = <?= $handlersJson ?>;
const statuses = <?= $statusesJson ?>;
const sources = <?= $sourcesJson ?>;
const programs = <?= $programsJson ?>;
</script>
*/
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <style>
        .chartdiv {
            width: 100%;
            height: 400px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <script src="<?= base_url() ?>/assets/js/pages/features/charts/amcharts/charts.js"></script>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row mx-0">

                <div class="col-lg-12">
                    <div class="card card-custom" data-card="true" id="kt_card_3">
                        <div class="card-header px-2">
                            <div class="card-title">
                                <h3 class="card-label">Counselor Panel</h3>
                            </div>
                            <div class="card-toolbar">

                                <!-- <button class="btn btn-icon btn-circle btn-sm btn-light-success mr-1"
                                    data-card-tool="reload" id="btnChart1" data-toggle="tooltip"
                                    onclick="reloadChart('chart1','btnChart1','keyStatsLMS')" data-placement="top"
                                    title="Reload Graph">
                                    <i class="ki ki-reload icon-nm"></i>
                                </button> -->

                            </div>
                        </div>
                        <div class="card-body px-2">
                            <form action="" method="get" class=" px-3 py-3">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 col-xl-3">
                                        <div class="input-icon form-group">
                                            <label for="from">From</label>
                                            <input type="text" name="from" id="from" class="form-control" value="<?= @$_GET['from']?$_GET['from']:null ?>" autocomplete="off" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-xl-3">
                                        <div class="input-icon form-group">
                                            <label for="to">To</label>
                                            <input type="text" name="to" id="to" class="form-control" value="<?= @$_GET['to']?$_GET['to']:null ?>" autocomplete="off" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">
                                            <label for="handlers">Handlers</label>
                                            <select name="handlers[]" id="handlers" data-live-search="true" class="form-control selectpicker" multiple>
                                                <?php foreach ($handlers as $handler) : ?>
                                                    <option value="<?= $handler['lu_id'] ?>" <?= (in_array($handler['lu_id'], ($_GET['handlers']??[])) !== false)?'selected':null ?>  ><?= $handler['user_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">
                                            <label for="tl">Select Team</label>
                                            <select name="tl[]" id="tl" data-live-search="true" class="form-control selectpicker" multiple>
                                                <?php foreach ($teamLeaders ?? [] as $leader) : ?>
                                                    <option value="<?= $leader['lu_id'] ?>" <?= (in_array($leader['lu_id'], ($_GET['tl']??[])) !== false)?'selected':null ?>><?= $leader['user_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="source">Source</label>
                                                <select name="source[]" data-live-search="true" id="source"  class="form-control selectpicker" multiple>
                                                    <?php foreach ($sources as $source) : ?>
                                                        <option value="<?= $source['source_id'] ?>" <?= (in_array($source['source_id'], ($_GET['source']??[])) !== false)?'selected':null ?>>
                                                            <?= $source['source_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">
                                            <div class="m-auto ">
                                                <label for="status">Status</label>
                                                <select name="status[]" id="status" class="form-control selectpicker" data-live-search="true" multiple>
                                                    <?php foreach ($statuses as $status) : ?>
                                                        <option value="<?= $status['status_id'] ?>" <?= (in_array($status['status_id'], ($_GET['status']??[])) !== false)?'selected':null ?>>
                                                            <?= $status['status_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php /*
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="department">Department</label>
                                                <select name="department[]" id="department"
                                                    class="form-control selectpicker" multiple>
                                                    <option value="">--Select--</option>

                                                    <option value="">1</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    */ ?>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">
                                            <div class="m-auto ">
                                                <label for="program">Program</label>
                                                <select name="program[]" data-live-search="true" id="program" class="form-control selectpicker" multiple>
                                                    <?php foreach ($programs as $program) : ?>
                                                        <option value="<?= $program['sc_id'] ?>" <?= (in_array($program['sc_id'], ($_GET['program']??[])) !== false)?'selected':null ?>>
                                                            <?= $program['course_name'] ?></option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-xl-3 form-group">
                                        <label for="">&nbsp;</label>
                                        <button type="submit" class="form-control btn btn-light-primary font-weight-bold">Search</button>

                                    </div>

                                </div>
                            </form>
                            <div class="mb-3">
                                <div class="row mx-0">
                                    <div class="col-xl-4" onclick="window.location.href='<?= base_url('handler/report/created-sid') ?>'">
                                        <!--begin::Stats Widget 12-->
                                        <div class="card card-custom card-stretch gutter-b" style="border: 1px solid #f64e60;">
                                            <!--begin::Body-->
                                            <div class="card-body p-0" style="position: relative;">
                                                <div class="d-flex align-items-center justify-content-between px-3 py-2 flex-grow-1 ">
                                                    <span class="symbol symbol-50 symbol-light-danger mr-2">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-xl svg-icon-danger">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                                        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
                                                                        <path d="M10.5857864,12 L9.17157288,10.5857864 C8.78104858,10.1952621 8.78104858,9.56209717 9.17157288,9.17157288 C9.56209717,8.78104858 10.1952621,8.78104858 10.5857864,9.17157288 L12,10.5857864 L13.4142136,9.17157288 C13.8047379,8.78104858 14.4379028,8.78104858 14.8284271,9.17157288 C15.2189514,9.56209717 15.2189514,10.1952621 14.8284271,10.5857864 L13.4142136,12 L14.8284271,13.4142136 C15.2189514,13.8047379 15.2189514,14.4379028 14.8284271,14.8284271 C14.4379028,15.2189514 13.8047379,15.2189514 13.4142136,14.8284271 L12,13.4142136 L10.5857864,14.8284271 C10.1952621,15.2189514 9.56209717,15.2189514 9.17157288,14.8284271 C8.78104858,14.4379028 8.78104858,13.8047379 9.17157288,13.4142136 L10.5857864,12 Z" fill="#000000"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <div class="d-flex flex-column text-right">
                                                        <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $totalRegistered ?></span>
                                                        <span class="text-muted font-weight-bold mt-2">Created SID
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Stats Widget 12-->
                                    </div>
                                    <div class="col-xl-4" onclick="window.location.href='<?= base_url('handler/report/registration') ?>'">
                                        <!--begin::Stats Widget 10-->
                                        <div class="card card-custom card-stretch gutter-b" style="border: 1px solid #32ccc4;">
                                            <!--begin::Body-->
                                            <div class="card-body p-0" style="position: relative;">
                                                <div class="d-flex align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">
                                                    <span class="symbol symbol-50 symbol-light-success mr-2">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-xl svg-icon-success">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                                        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
                                                                        <path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <div class="d-flex flex-column text-right">
                                                        <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $totalRegisterPayment ?></span>
                                                        <span class="text-muted font-weight-bold mt-2">Total
                                                            Registration</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Stats Widget 10-->
                                    </div>
                                    <div class="col-xl-4" onclick="window.location.href='<?= base_url('handler/report/admission-done') ?>'">
                                        <!--begin::Stats Widget 11-->
                                        <div class="card card-custom card-stretch gutter-b" style="border: 1px solid #ffa800;">
                                            <!--begin::Body-->
                                            <div class="card-body p-0" style="position: relative;">
                                                <div class="d-flex align-items-center justify-content-between px-3 py-2 flex-grow-1 ">
                                                    <span class="symbol symbol-50 symbol-light-warning mr-2">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-xl svg-icon-warning">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                                        <path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z M10.5857864,14 L9.17157288,15.4142136 C8.78104858,15.8047379 8.78104858,16.4379028 9.17157288,16.8284271 C9.56209717,17.2189514 10.1952621,17.2189514 10.5857864,16.8284271 L12,15.4142136 L13.4142136,16.8284271 C13.8047379,17.2189514 14.4379028,17.2189514 14.8284271,16.8284271 C15.2189514,16.4379028 15.2189514,15.8047379 14.8284271,15.4142136 L13.4142136,14 L14.8284271,12.5857864 C15.2189514,12.1952621 15.2189514,11.5620972 14.8284271,11.1715729 C14.4379028,10.7810486 13.8047379,10.7810486 13.4142136,11.1715729 L12,12.5857864 L10.5857864,11.1715729 C10.1952621,10.7810486 9.56209717,10.7810486 9.17157288,11.1715729 C8.78104858,11.5620972 8.78104858,12.1952621 9.17157288,12.5857864 L10.5857864,14 Z" fill="#000000"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <div class="d-flex flex-column text-right">
                                                        <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $totalProvisionalModel ?></span>
                                                        <span class="text-muted font-weight-bold mt-2">Total
                                                            Admission Done</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Stats Widget 11-->
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row mx-0">
                                    <div class="col-xl-4">
                                        <!--begin::Stats Widget 10-->
                                        <div class="card card-custom card-stretch gutter-b" style="border: 1px solid #32ccc4;">
                                            <!--begin::Body-->
                                            <div class="card-body p-0" style="position: relative;">
                                                <div class="d-flex align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">
                                                    <span class="symbol symbol-50 symbol-light-success mr-2">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-xl svg-icon-success">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                                        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
                                                                        <path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <div class="d-flex flex-column text-right">
                                                        <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $totalLeads ?></span>
                                                        <span class="text-muted font-weight-bold mt-2">Total
                                                            Leads</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Stats Widget 10-->
                                    </div>
                                    <div class="col-xl-4">
                                        <!--begin::Stats Widget 11-->
                                        <div class="card card-custom card-stretch gutter-b" style="border: 1px solid #ffa800;">
                                            <!--begin::Body-->
                                            <div class="card-body p-0" style="position: relative;">
                                                <div class="d-flex align-items-center justify-content-between px-3 py-2 flex-grow-1 ">
                                                    <span class="symbol symbol-50 symbol-light-warning mr-2">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-xl svg-icon-warning">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                                        <path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z M10.5857864,14 L9.17157288,15.4142136 C8.78104858,15.8047379 8.78104858,16.4379028 9.17157288,16.8284271 C9.56209717,17.2189514 10.1952621,17.2189514 10.5857864,16.8284271 L12,15.4142136 L13.4142136,16.8284271 C13.8047379,17.2189514 14.4379028,17.2189514 14.8284271,16.8284271 C15.2189514,16.4379028 15.2189514,15.8047379 14.8284271,15.4142136 L13.4142136,14 L14.8284271,12.5857864 C15.2189514,12.1952621 15.2189514,11.5620972 14.8284271,11.1715729 C14.4379028,10.7810486 13.8047379,10.7810486 13.4142136,11.1715729 L12,12.5857864 L10.5857864,11.1715729 C10.1952621,10.7810486 9.56209717,10.7810486 9.17157288,11.1715729 C8.78104858,11.5620972 8.78104858,12.1952621 9.17157288,12.5857864 L10.5857864,14 Z" fill="#000000"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <div class="d-flex flex-column text-right">
                                                        <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $totalAllocated ?></span>
                                                        <span class="text-muted font-weight-bold mt-2">Allocated
                                                            Lead</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Stats Widget 11-->
                                    </div>
                                    <div class="col-xl-4">
                                        <!--begin::Stats Widget 12-->
                                        <div class="card card-custom card-stretch gutter-b" style="border: 1px solid #3699ff;">
                                            <!--begin::Body-->
                                            <div class="card-body p-0" style="position: relative;">
                                                <div class="d-flex align-items-center justify-content-between px-3 py-2 flex-grow-1 ">
                                                    <span class="symbol symbol-50 symbol-light-primary mr-2">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-xl svg-icon-primary">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect opacity="0.300000012" x="0" y="0" width="24" height="24"></rect>
                                                                        <polygon fill="#000000" fill-rule="nonzero" opacity="0.3" points="7 4.89473684 7 21 5 21 5 3 11 3 11 4.89473684">
                                                                        </polygon>
                                                                        <path d="M10.1782982,2.24743315 L18.1782982,3.6970464 C18.6540619,3.78325557 19,4.19751166 19,4.68102291 L19,19.3190064 C19,19.8025177 18.6540619,20.2167738 18.1782982,20.3029829 L10.1782982,21.7525962 C9.63486295,21.8510675 9.11449486,21.4903531 9.0160235,20.9469179 C9.00536265,20.8880837 9,20.8284119 9,20.7686197 L9,3.23140966 C9,2.67912491 9.44771525,2.23140966 10,2.23140966 C10.0597922,2.23140966 10.119464,2.2367723 10.1782982,2.24743315 Z M11.9166667,12.9060229 C12.6070226,12.9060229 13.1666667,12.2975724 13.1666667,11.5470105 C13.1666667,10.7964487 12.6070226,10.1879981 11.9166667,10.1879981 C11.2263107,10.1879981 10.6666667,10.7964487 10.6666667,11.5470105 C10.6666667,12.2975724 11.2263107,12.9060229 11.9166667,12.9060229 Z" fill="#000000"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <div class="d-flex flex-column text-right">
                                                        <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $totalUnallocated ?></span>
                                                        <span class="text-muted font-weight-bold mt-2">Unallocated
                                                            Lead</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Stats Widget 12-->
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- Bar -->
                            <script>
                                am5.ready(function() {

                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv4");


                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                        am5themes_Animated.new(root)
                                    ]);


                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                    var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                        panX: true,
                                        panY: true,
                                        wheelX: "panX",
                                        wheelY: "zoomX"
                                    }));

                                    // Add cursor
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                    cursor.lineY.set("visible", false);


                                    // Create axes
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                    var xRenderer = am5xy.AxisRendererX.new(root, {
                                        minGridDistance: 30
                                    });
                                    xRenderer.labels.template.setAll({
                                        rotation: -90,
                                        centerY: am5.p50,
                                        centerX: am5.p100,
                                        paddingRight: 15
                                    });

                                    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                        maxDeviation: 0.3,
                                        categoryField: "year",
                                        renderer: xRenderer,
                                        tooltip: am5.Tooltip.new(root, {})
                                    }));

                                    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                        maxDeviation: 0.3,
                                        renderer: am5xy.AxisRendererY.new(root, {})
                                    }));


                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                        name: "Series 1",
                                        xAxis: xAxis,
                                        stacked: true,
                                        yAxis: yAxis,
                                        valueYField: "value",
                                        sequencedInterpolation: true,
                                        categoryXField: "year",
                                        tooltip: am5.Tooltip.new(root, {
                                            labelText: "{valueY}"
                                        })
                                    }));

                                    series.columns.template.setAll({
                                        cornerRadiusTL: 5,
                                        cornerRadiusTR: 5
                                    });
                                    series.columns.template.adapters.add("fill", (fill, target) => {
                                        return chart.get("colors").getIndex(series.columns.indexOf(
                                            target));
                                    });

                                    series.columns.template.adapters.add("stroke", (stroke, target) => {
                                        return chart.get("colors").getIndex(series.columns.indexOf(
                                            target));
                                    });


                                    // Set data
                                    var data = <?= json_encode($lineChart) ?>;
                                    var newData = [];
                                    for (var j = 0; j < data.length; j++) {
                                        d = data[j];
                                        d.value = Number(d.value);
                                        newData.push(d);
                                    }

                                    xAxis.data.setAll(newData);
                                    series.data.setAll(newData);


                                    // Make stuff animate on load
                                    // https://www.amcharts.com/docs/v5/concepts/animations/
                                    series.appear(1000);
                                    chart.appear(1000, 100);

                                    var exporting = am5plugins_exporting.Exporting.new(root, {
                                        menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                        dataSource: data
                                    });

                                    exporting.events.on("dataprocessed", function(ev) {
                                        for (var i = 0; i < ev.data.length; i++) {
                                            ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                        }
                                    });

                                }); // end am5.ready()
                            </script>
                            <!--end Bar -->

                            <div class="chartdiv" id="chartdiv4"></div>
                            <?php /*
                            <script>
                            am5.ready(function() {

                                // Create root element
                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                var root = am5.Root.new("chartdiv");


                                // Set themes
                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                root.setThemes([
                                    am5themes_Animated.new(root)
                                ]);


                                // Create chart
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                    panX: false,
                                    panY: false,
                                    wheelX: "panX",
                                    wheelY: "zoomX",
                                    layout: root.verticalLayout
                                }));


                                // Add legend
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
                                var legend = chart.children.push(
                                    am5.Legend.new(root, {
                                        centerX: am5.p50,
                                        x: am5.p50
                                    })
                                );

                                var data = [{
                                        "month": "Jan-Mar",
                                        "leads": 2.5,
                                        "allocatedLeads": 2.5,
                                        "unallocatedLeads": 2.1,
                                        "registeredLeads": 1,
                                    },
                                    {
                                        "month": "Apr-Jun",
                                        "leads": 2.5,
                                        "allocatedLeads": 2.5,
                                        "unallocatedLeads": 2.1,
                                        "registeredLeads": 1,
                                    },
                                    {
                                        "month": "Jul-Sep",
                                        "leads": 2.5,
                                        "allocatedLeads": 2.5,
                                        "unallocatedLeads": 2.1,
                                        "registeredLeads": 1,
                                    },
                                    {
                                        "month": "Oct-Dec",
                                        "leads": 2.5,
                                        "allocatedLeads": 2.5,
                                        "unallocatedLeads": 2.1,
                                        "registeredLeads": 1,
                                    }
                                ]


                                // Create axes
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                    categoryField: "month",
                                    renderer: am5xy.AxisRendererX.new(root, {
                                        cellStartLocation: 0.1,
                                        cellEndLocation: 0.9
                                    }),
                                    tooltip: am5.Tooltip.new(root, {})
                                }));

                                xAxis.data.setAll(data);

                                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                    renderer: am5xy.AxisRendererY.new(root, {})
                                }));


                                // Add series
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                function makeSeries(name, fieldName) {
                                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                        name: name,
                                        xAxis: xAxis,
                                        yAxis: yAxis,
                                        valueYField: fieldName,
                                        categoryXField: "month"
                                    }));

                                    series.columns.template.setAll({
                                        tooltipText: "{name}, {categoryX}:{valueY}",
                                        width: am5.percent(60),
                                        tooltipY: 0
                                    });

                                    series.data.setAll(data);

                                    // Make stuff animate on load
                                    // https://www.amcharts.com/docs/v5/concepts/animations/
                                    series.appear();

                                    series.bullets.push(function() {
                                        return am5.Bullet.new(root, {
                                            locationY: 0,
                                            sprite: am5.Label.new(root, {
                                                text: "{valueY}",
                                                fill: root.interfaceColors.get(
                                                    "alternativeText"),
                                                centerY: 0,
                                                centerX: am5.p50,
                                                populateText: true
                                            })
                                        });
                                    });

                                    legend.data.push(series);
                                }

                                makeSeries("Leads", "leads");
                                makeSeries("Allocated Leads", "allocatedLeads");
                                makeSeries("Unallocated Leads", "unallocatedLeads");
                                makeSeries("Registered SID", "registeredLeads");



                                // Make stuff animate on load
                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                chart.appear(1000, 100);

                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                    dataSource: data
                                });

                                exporting.events.on("dataprocessed", function(ev) {
                                    for (var i = 0; i < ev.data.length; i++) {
                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                    }
                                });

                            }); // end am5.ready()
                            </script>
                            <div class="chartdiv" id="chartdiv">

                            </div>
                             */ ?>
                        </div>
                    </div>


                </div>

            </div>
            <div class="row mx-0 mt-5">

                <div class="col-lg-12">
                    <div class="card card-custom" data-card="true" id="kt_card_3">
                        <div class="card-header px-2">
                            <div class="card-title">
                                <h3 class="card-label">Applied Application Form(<?= $totalRegisteredStudent ?>)</h3>
                            </div>
                            <div class="card-toolbar">
                                <!-- <button class="btn btn-icon btn-circle btn-sm btn-light-success mr-1"
                                    data-card-tool="reload" id="btnChart1" data-toggle="tooltip"
                                    onclick="reloadChart('chart1','btnChart1','keyStatsLMS')" data-placement="top"
                                    title="Reload Graph">
                                    <i class="ki ki-reload icon-nm"></i>
                                </button> -->
                            </div>
                        </div>
                        <div class="card-body px-2">
                            <?php /*
                            <form action="" method="get" class=" px-3 py-3">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 col-xl-3">
                                        <div class="input-icon form-group">
                                            <label for="from">From</label>
                                            <input type="text" name="from" id="from" class="form-control datep" value="" autocomplete="off" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-xl-3">
                                        <div class="input-icon form-group">
                                            <label for="to">To</label>
                                            <input type="text" name="to" id="to" class="form-control datep" value="" autocomplete="off" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">
                                            <label for="handlers">Handlers</label>
                                            <select name="handlers[]" data-live-search="true" id="handlers" class="form-control selectpicker" multiple>
                                                <?php foreach ($handlers as $handler) : ?>
                                                    <option value="<?= $handler['lu_id'] ?>"><?= $handler['user_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">
                                            <label for="tl">Select Team</label>
                                            <select name="tl[]" id="tl" data-live-search="true" class="form-control selectpicker" multiple>
                                                <?php foreach ($teamLeaders ?? [] as $leader) : ?>
                                                    <option value="<?= $leader['lu_id'] ?>"><?= $leader['user_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="source">Source</label>
                                                <select name="source[]" data-live-search="true" id="source" class="form-control selectpicker" multiple>
                                                    <?php foreach ($sources as $source) : ?>
                                                        <option value="<?= $source['source_id'] ?>">
                                                            <?= $source['source_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">
                                            <div class="m-auto ">
                                                <label for="status">Status</label>
                                                <select name="status[]" data-live-search="true" id="status" class="form-control selectpicker" multiple>
                                                    <?php foreach ($statuses as $status) : ?>
                                                        <option value="<?= $status['status_id'] ?>">
                                                            <?= $status['status_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="department">Department</label>
                                                <select name="department[]" id="department"
                                                    class="form-control selectpicker" multiple>
                                                    <option value="">--Select--</option>

                                                    <option value="">1</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">
                                            <div class="m-auto ">
                                                <label for="program">Program</label>
                                                <select name="program[]" data-live-search="true" id="program" class="form-control selectpicker" multiple>
                                                    <?php foreach ($programs as $program) : ?>
                                                        <option value="<?= $program['sc_id'] ?>">
                                                            <?= $program['course_name'] ?></option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-xl-3 form-group">
                                        <label for="">&nbsp;</label>
                                        <button type="submit" class="form-control btn btn-light-primary font-weight-bold">Search</button>

                                    </div>

                                </div>
                            </form>
                            */ ?>
                            <div class="mb-3">
                                <div class="row mx-0">
                                    <?php $chartData = [];
                                    foreach ($dataAdmissionStatus as $admssion) : ?>
                                        <div class="col-xl-2">
                                            <!--begin::Stats Widget 10-->
                                            <div class="card card-custom card-stretch gutter-b" style="border: 1px solid <?= $admssion['color'] ?>;">
                                                <!--begin::Body-->
                                                <div class="card-body p-0">
                                                    <div class="align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">

                                                        <div class="d-flex flex-column text-center">
                                                            <span class="text-dark-75 font-weight-bolder font-size-h3"><?php $key = array_search($admssion['id'], $sqlAdmissionStatus, true); ?><?php $stats = ($key !== false) ? $admissionStatus[$key]['sid'] : '0';
                                                                                                                                                                                                echo $stats; ?></span>
                                                            <span class="text-muted font-weight-bold mt-2 text-center"><?= $admssion['name'] ?></span>
                                                        </div>
                                                    </div>
                                                    <?php $chartData[] = ['category' => $admssion['name'], 'value' => (int) $stats]; ?>
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Stats Widget 10-->
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>


                            <!--begin::Entry-->
                            <div class="row mx-0">
                                <!-- Bar -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("chartdiv2");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                        var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                            panX: true,
                                            panY: true,
                                            wheelX: "panX",
                                            wheelY: "zoomX"
                                        }));

                                        // Add cursor
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                        cursor.lineY.set("visible", false);


                                        // Create axes
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                        var xRenderer = am5xy.AxisRendererX.new(root, {
                                            minGridDistance: 30
                                        });
                                        xRenderer.labels.template.setAll({
                                            rotation: -90,
                                            centerY: am5.p50,
                                            centerX: am5.p100,
                                            paddingRight: 15
                                        });

                                        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                            maxDeviation: 0.3,
                                            categoryField: "category",
                                            renderer: xRenderer,
                                            tooltip: am5.Tooltip.new(root, {})
                                        }));

                                        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                            maxDeviation: 0.3,
                                            renderer: am5xy.AxisRendererY.new(root, {})
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                            name: "Series 1",
                                            xAxis: xAxis,
                                            stacked: true,
                                            yAxis: yAxis,
                                            valueYField: "value",
                                            sequencedInterpolation: true,
                                            categoryXField: "category",
                                            tooltip: am5.Tooltip.new(root, {
                                                labelText: "{valueY}"
                                            })
                                        }));

                                        series.columns.template.setAll({
                                            cornerRadiusTL: 5,
                                            cornerRadiusTR: 5
                                        });
                                        series.columns.template.adapters.add("fill", (fill, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });

                                        series.columns.template.adapters.add("stroke", (stroke, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });


                                        // Set data
                                        var data = <?= json_encode($chartData) ?>;


                                        xAxis.data.setAll(data);
                                        series.data.setAll(data);


                                        // Make stuff animate on load
                                        // https://www.amcharts.com/docs/v5/concepts/animations/
                                        series.appear(1000);
                                        chart.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <!--end Bar -->
                                <div class="col-lg-6 mb-3">
                                    <div class="card gutter-b">
                                        <div class="chartdiv" id="chartdiv2"></div>
                                    </div>
                                </div>
                                <!-- pie -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("chartdiv3");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                        var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                            layout: root.verticalLayout
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                        var series = chart.series.push(am5percent.PieSeries.new(root, {
                                            alignLabels: true,
                                            calculateAggregates: true,
                                            valueField: "value",
                                            categoryField: "category"
                                        }));

                                        series.slices.template.setAll({
                                            strokeWidth: 3,
                                            stroke: am5.color(0xffffff)
                                        });

                                        series.labelsContainer.set("paddingTop", 30)


                                        // Set up adapters for variable slice radius
                                        // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                                        series.slices.template.adapters.add("radius", function(radius, target) {
                                            var dataItem = target.dataItem;
                                            var high = series.getPrivate("valueHigh");

                                            if (dataItem) {
                                                var value = target.dataItem.get("valueWorking", 0);
                                                return radius * value / high
                                            }
                                            return radius;
                                        });


                                        // Set data
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                        var data = <?= json_encode($chartData) ?>;
                                        series.data.setAll(data);


                                        // Create legend
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                        var legend = chart.children.push(am5.Legend.new(root, {
                                            centerX: am5.p50,
                                            x: am5.p50,
                                            marginTop: 15,
                                            marginBottom: 15
                                        }));

                                        legend.data.setAll(series.dataItems);


                                        // Play initial series animation
                                        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                        series.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <!-- end Pie -->
                                <div class="col-lg-6 mb-3">
                                    <div class="card gutter-b">
                                        <div class="chartdiv" id="chartdiv3"></div>
                                    </div>
                                </div>
                                
                                
                                
                                <!-- Bar -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("formStepchart");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                        var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                            panX: true,
                                            panY: true,
                                            wheelX: "panX",
                                            wheelY: "zoomX"
                                        }));

                                        // Add cursor
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                        cursor.lineY.set("visible", false);


                                        // Create axes
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                        var xRenderer = am5xy.AxisRendererX.new(root, {
                                            minGridDistance: 30
                                        });
                                        xRenderer.labels.template.setAll({
                                            rotation: -90,
                                            centerY: am5.p50,
                                            centerX: am5.p100,
                                            paddingRight: 15
                                        });

                                        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                            maxDeviation: 0.3,
                                            categoryField: "category",
                                            renderer: xRenderer,
                                            tooltip: am5.Tooltip.new(root, {})
                                        }));

                                        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                            maxDeviation: 0.3,
                                            renderer: am5xy.AxisRendererY.new(root, {})
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                            name: "Series 1",
                                            xAxis: xAxis,
                                            stacked: true,
                                            yAxis: yAxis,
                                            valueYField: "value",
                                            sequencedInterpolation: true,
                                            categoryXField: "category",
                                            tooltip: am5.Tooltip.new(root, {
                                                labelText: "{valueY}"
                                            })
                                        }));

                                        series.columns.template.setAll({
                                            cornerRadiusTL: 5,
                                            cornerRadiusTR: 5
                                        });
                                        series.columns.template.adapters.add("fill", (fill, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });

                                        series.columns.template.adapters.add("stroke", (stroke, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });


                                        // Set data
                                        var data = <?= json_encode($formStep) ?>;
                                        data = data.map(obj => {
                                            // Map over all the keys in your object
                                            Object.keys(obj).map(key => {
                                                // Check if the key is numeric
                                                if (!isNaN(obj[key])) {
                                                    obj[key] = +obj[key];
                                                }
                                            })
                                            return obj;
                                        });


                                        xAxis.data.setAll(data);
                                        series.data.setAll(data);


                                        // Make stuff animate on load
                                        // https://www.amcharts.com/docs/v5/concepts/animations/
                                        series.appear(1000);
                                        chart.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <!--end Bar -->
                                <div class="col-lg-12 mb-3">
                                    <div class="card gutter-b card-custom">
                                        <div class="card-header px-2">
                                            <div class="card-title">
                                                <h3 class="card-label">Application Form Step Chart(<?= array_sum(array_column($formStep??[], 'value')) ?>)</h3>
                                            </div>
                                        </div>
                                        <div class="chartdiv" id="formStepchart"></div>
                                    </div>
                                </div>
                                
                                <!-- Lead Status chart Start -->
                                <div class="col-lg-12">
                                    <h4>Lead Status Wise</h4>
                                    <div class='row'>
	                                    <?php $count = 0;
	                                    foreach ($leadStatusWise as $status) : 
	                                        if($count == count($color))
	                                            $count=0;
	                                    ?>
	                                        <div class="col-xl-2">
	                                            <!--begin::Stats Widget 10-->
	                                            <div class="card card-custom card-stretch gutter-b" style="border: 1px solid <?= $color[$count++] ?>;">
	                                                <!--begin::Body-->
	                                                <div class="card-body p-0">
	                                                    <div class="align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">
	
	                                                        <div class="d-flex flex-column text-center">
	                                                            <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $status['value'] ?? '0';?></span>
	                                                            <span class="text-muted font-weight-bold mt-2 text-center"><?= $status['category'] ?></span>
	                                                        </div>
	                                                    </div>
	                                                    
	                                                </div>
	                                                <!--end::Body-->
	                                            </div>
	                                            <!--end::Stats Widget 10-->
	                                        </div>
	
	                                    <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- Pie Chart -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("leadStatusWise");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                        var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                            layout: root.verticalLayout
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                        var series = chart.series.push(am5percent.PieSeries.new(root, {
                                            alignLabels: true,
                                            calculateAggregates: true,
                                            valueField: "value",
                                            categoryField: "category"
                                        }));

                                        series.slices.template.setAll({
                                            strokeWidth: 3,
                                            stroke: am5.color(0xffffff)
                                        });

                                        series.labelsContainer.set("paddingTop", 30)


                                        // Set up adapters for variable slice radius
                                        // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                                        series.slices.template.adapters.add("radius", function(radius, target) {
                                            var dataItem = target.dataItem;
                                            var high = series.getPrivate("valueHigh");

                                            if (dataItem) {
                                                var value = target.dataItem.get("valueWorking", 0);
                                                return radius * value / high
                                            }
                                            return radius;
                                        });


                                        // Set data
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                        var data = <?= json_encode($leadStatusWise) ?>;
                                        data = data.map(obj => {
                                            // Map over all the keys in your object
                                            Object.keys(obj).map(key => {
                                                // Check if the key is numeric
                                                if (!isNaN(obj[key])) {
                                                    obj[key] = +obj[key];
                                                }
                                            })
                                            return obj;
                                        });
                                        series.data.setAll(data);


                                        // Create legend
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                        var legend = chart.children.push(am5.Legend.new(root, {
                                            centerX: am5.p50,
                                            x: am5.p50,
                                            marginTop: 15,
                                            marginBottom: 15
                                        }));

                                        legend.data.setAll(series.dataItems);


                                        // Play initial series animation
                                        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                        series.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <div class="col-lg-6 mb-3">
                                    <div class="card gutter-b">
                                        <div class="chartdiv" id="leadStatusWise"></div>
                                    </div>
                                </div>
                                <!-- Bar Chart -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("leadStatusWiseBar");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                        var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                            panX: true,
                                            panY: true,
                                            wheelX: "panX",
                                            wheelY: "zoomX"
                                        }));

                                        // Add cursor
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                        cursor.lineY.set("visible", false);


                                        // Create axes
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                        var xRenderer = am5xy.AxisRendererX.new(root, {
                                            minGridDistance: 30
                                        });
                                        xRenderer.labels.template.setAll({
                                            rotation: -90,
                                            centerY: am5.p50,
                                            centerX: am5.p100,
                                            paddingRight: 15
                                        });

                                        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                            maxDeviation: 0.3,
                                            categoryField: "category",
                                            renderer: xRenderer,
                                            tooltip: am5.Tooltip.new(root, {})
                                        }));

                                        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                            maxDeviation: 0.3,
                                            renderer: am5xy.AxisRendererY.new(root, {})
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                            name: "Series 1",
                                            xAxis: xAxis,
                                            stacked: true,
                                            yAxis: yAxis,
                                            valueYField: "value",
                                            sequencedInterpolation: true,
                                            categoryXField: "category",
                                            tooltip: am5.Tooltip.new(root, {
                                                labelText: "{valueY}"
                                            })
                                        }));

                                        series.columns.template.setAll({
                                            cornerRadiusTL: 5,
                                            cornerRadiusTR: 5
                                        });
                                        series.columns.template.adapters.add("fill", (fill, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });

                                        series.columns.template.adapters.add("stroke", (stroke, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });


                                        // Set data
                                        var data = <?= json_encode($leadStatusWise) ?>;
                                        data = data.map(obj => {
                                            // Map over all the keys in your object
                                            Object.keys(obj).map(key => {
                                                // Check if the key is numeric
                                                if (!isNaN(obj[key])) {
                                                    obj[key] = +obj[key];
                                                }
                                            })
                                            return obj;
                                        });


                                        xAxis.data.setAll(data);
                                        series.data.setAll(data);


                                        // Make stuff animate on load
                                        // https://www.amcharts.com/docs/v5/concepts/animations/
                                        series.appear(1000);
                                        chart.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <div class="col-lg-6 mb-3">
                                    <div class="card gutter-b">
                                        <div class="chartdiv" id="leadStatusWiseBar"></div>
                                    </div>
                                </div>
                                <!-- Lead Status chart End -->
                                
                                <!-- Lead Source chart Start -->
                                <div class="col-lg-12">
                                    <h4>Lead Source Wise</h4>
                                    <div class='row'>
	                                    <?php $count = 0;
	                                    foreach ($leadSourceWise as $source) : 
	                                        if($count == count($color))
	                                            $count=0;
	                                    ?>
	                                        <div class="col-xl-2">
	                                            <!--begin::Stats Widget 10-->
	                                            <div class="card card-custom card-stretch gutter-b" style="border: 1px solid <?= $color[$count++] ?>;">
	                                                <!--begin::Body-->
	                                                <div class="card-body p-0">
	                                                    <div class="align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">
	
	                                                        <div class="d-flex flex-column text-center">
	                                                            <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $source['value'] ?? '0';?></span>
	                                                            <span class="text-muted font-weight-bold mt-2 text-center"><?= $source['category'] ?></span>
	                                                        </div>
	                                                    </div>
	                                                    
	                                                </div>
	                                                <!--end::Body-->
	                                            </div>
	                                            <!--end::Stats Widget 10-->
	                                        </div>
	
	                                    <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- Pie Chart -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("leadSourceWise");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                        var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                            layout: root.verticalLayout
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                        var series = chart.series.push(am5percent.PieSeries.new(root, {
                                            alignLabels: true,
                                            calculateAggregates: true,
                                            valueField: "value",
                                            categoryField: "category"
                                        }));

                                        series.slices.template.setAll({
                                            strokeWidth: 3,
                                            stroke: am5.color(0xffffff)
                                        });

                                        series.labelsContainer.set("paddingTop", 30)


                                        // Set up adapters for variable slice radius
                                        // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                                        series.slices.template.adapters.add("radius", function(radius, target) {
                                            var dataItem = target.dataItem;
                                            var high = series.getPrivate("valueHigh");

                                            if (dataItem) {
                                                var value = target.dataItem.get("valueWorking", 0);
                                                return radius * value / high
                                            }
                                            return radius;
                                        });


                                        // Set data
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                        var data = <?= json_encode($leadSourceWise) ?>;
                                        data = data.map(obj => {
                                            // Map over all the keys in your object
                                            Object.keys(obj).map(key => {
                                                // Check if the key is numeric
                                                if (!isNaN(obj[key])) {
                                                    obj[key] = +obj[key];
                                                }
                                            })
                                            return obj;
                                        });
                                        series.data.setAll(data);


                                        // Create legend
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                        var legend = chart.children.push(am5.Legend.new(root, {
                                            centerX: am5.p50,
                                            x: am5.p50,
                                            marginTop: 15,
                                            marginBottom: 15
                                        }));

                                        legend.data.setAll(series.dataItems);


                                        // Play initial series animation
                                        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                        series.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <div class="col-lg-6 mb-3">
                                    <div class="card gutter-b">
                                        <div class="chartdiv" id="leadSourceWise"></div>
                                    </div>
                                </div>
                                <!-- Bar Chart -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("leadSourceWiseBar");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                        var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                            panX: true,
                                            panY: true,
                                            wheelX: "panX",
                                            wheelY: "zoomX"
                                        }));

                                        // Add cursor
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                        cursor.lineY.set("visible", false);


                                        // Create axes
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                        var xRenderer = am5xy.AxisRendererX.new(root, {
                                            minGridDistance: 30
                                        });
                                        xRenderer.labels.template.setAll({
                                            rotation: -90,
                                            centerY: am5.p50,
                                            centerX: am5.p100,
                                            paddingRight: 15
                                        });

                                        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                            maxDeviation: 0.3,
                                            categoryField: "category",
                                            renderer: xRenderer,
                                            tooltip: am5.Tooltip.new(root, {})
                                        }));

                                        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                            maxDeviation: 0.3,
                                            renderer: am5xy.AxisRendererY.new(root, {})
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                            name: "Series 1",
                                            xAxis: xAxis,
                                            stacked: true,
                                            yAxis: yAxis,
                                            valueYField: "value",
                                            sequencedInterpolation: true,
                                            categoryXField: "category",
                                            tooltip: am5.Tooltip.new(root, {
                                                labelText: "{valueY}"
                                            })
                                        }));

                                        series.columns.template.setAll({
                                            cornerRadiusTL: 5,
                                            cornerRadiusTR: 5
                                        });
                                        series.columns.template.adapters.add("fill", (fill, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });

                                        series.columns.template.adapters.add("stroke", (stroke, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });


                                        // Set data
                                        var data = <?= json_encode($leadSourceWise) ?>;
                                        data = data.map(obj => {
                                            // Map over all the keys in your object
                                            Object.keys(obj).map(key => {
                                                // Check if the key is numeric
                                                if (!isNaN(obj[key])) {
                                                    obj[key] = +obj[key];
                                                }
                                            })
                                            return obj;
                                        });


                                        xAxis.data.setAll(data);
                                        series.data.setAll(data);


                                        // Make stuff animate on load
                                        // https://www.amcharts.com/docs/v5/concepts/animations/
                                        series.appear(1000);
                                        chart.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <div class="col-lg-6 mb-3">
                                    <div class="card gutter-b">
                                        <div class="chartdiv" id="leadSourceWiseBar"></div>
                                    </div>
                                </div>
                                <!-- Lead Source chart End -->
                                
                                <!-- Lead Department chart Start -->
                                <div class="col-lg-12">
                                    <h4>Lead Department Wise</h4>
                                    <div class='row'>
	                                    <?php $count = 0;
	                                    foreach ($departmentWise as $dept) : 
	                                        if($count == count($color))
	                                            $count=0;
	                                    ?>
	                                        <div class="col-xl-2">
	                                            <!--begin::Stats Widget 10-->
	                                            <div class="card card-custom card-stretch gutter-b" style="border: 1px solid <?= $color[$count++] ?>;">
	                                                <!--begin::Body-->
	                                                <div class="card-body p-0">
	                                                    <div class="align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">
	
	                                                        <div class="d-flex flex-column text-center">
	                                                            <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $dept['value'] ?? '0';?></span>
	                                                            <span class="text-muted font-weight-bold mt-2 text-center"><?= $dept['category'] ?></span>
	                                                        </div>
	                                                    </div>
	                                                    
	                                                </div>
	                                                <!--end::Body-->
	                                            </div>
	                                            <!--end::Stats Widget 10-->
	                                        </div>
	
	                                    <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- Pie Chart -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("departmentWise");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                        var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                            layout: root.verticalLayout
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                        var series = chart.series.push(am5percent.PieSeries.new(root, {
                                            alignLabels: true,
                                            calculateAggregates: true,
                                            valueField: "value",
                                            categoryField: "category"
                                        }));

                                        series.slices.template.setAll({
                                            strokeWidth: 3,
                                            stroke: am5.color(0xffffff)
                                        });

                                        series.labelsContainer.set("paddingTop", 30)


                                        // Set up adapters for variable slice radius
                                        // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                                        series.slices.template.adapters.add("radius", function(radius, target) {
                                            var dataItem = target.dataItem;
                                            var high = series.getPrivate("valueHigh");

                                            if (dataItem) {
                                                var value = target.dataItem.get("valueWorking", 0);
                                                return radius * value / high
                                            }
                                            return radius;
                                        });


                                        // Set data
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                        var data = <?= json_encode($departmentWise) ?>;
                                        data = data.map(obj => {
                                            // Map over all the keys in your object
                                            Object.keys(obj).map(key => {
                                                // Check if the key is numeric
                                                if (!isNaN(obj[key])) {
                                                    obj[key] = +obj[key];
                                                }
                                            })
                                            return obj;
                                        });
                                        series.data.setAll(data);


                                        // Create legend
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                        var legend = chart.children.push(am5.Legend.new(root, {
                                            centerX: am5.p50,
                                            x: am5.p50,
                                            marginTop: 15,
                                            marginBottom: 15
                                        }));

                                        legend.data.setAll(series.dataItems);


                                        // Play initial series animation
                                        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                        series.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <div class="col-lg-12 mb-3">
                                    <div class="card gutter-b">
                                        <div style=" width: 100%;height: 600px; margin-left: auto; margin-right: auto;" id="departmentWise"></div>
                                    </div>
                                </div>
                                <!-- Bar Chart -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("departmentWiseBar");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                        var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                            panX: true,
                                            panY: true,
                                            wheelX: "panX",
                                            wheelY: "zoomX"
                                        }));

                                        // Add cursor
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                        cursor.lineY.set("visible", false);


                                        // Create axes
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                        var xRenderer = am5xy.AxisRendererX.new(root, {
                                            minGridDistance: 30
                                        });
                                        xRenderer.labels.template.setAll({
                                            rotation: -90,
                                            centerY: am5.p50,
                                            centerX: am5.p100,
                                            paddingRight: 15
                                        });

                                        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                            maxDeviation: 0.3,
                                            categoryField: "category",
                                            renderer: xRenderer,
                                            tooltip: am5.Tooltip.new(root, {})
                                        }));

                                        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                            maxDeviation: 0.3,
                                            renderer: am5xy.AxisRendererY.new(root, {})
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                            name: "Series 1",
                                            xAxis: xAxis,
                                            stacked: true,
                                            yAxis: yAxis,
                                            valueYField: "value",
                                            sequencedInterpolation: true,
                                            categoryXField: "category",
                                            tooltip: am5.Tooltip.new(root, {
                                                labelText: "{valueY}"
                                            })
                                        }));

                                        series.columns.template.setAll({
                                            cornerRadiusTL: 5,
                                            cornerRadiusTR: 5
                                        });
                                        series.columns.template.adapters.add("fill", (fill, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });

                                        series.columns.template.adapters.add("stroke", (stroke, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });


                                        // Set data
                                        var data = <?= json_encode($departmentWise) ?>;
                                        data = data.map(obj => {
                                            // Map over all the keys in your object
                                            Object.keys(obj).map(key => {
                                                // Check if the key is numeric
                                                if (!isNaN(obj[key])) {
                                                    obj[key] = +obj[key];
                                                }
                                            })
                                            return obj;
                                        });


                                        xAxis.data.setAll(data);
                                        series.data.setAll(data);


                                        // Make stuff animate on load
                                        // https://www.amcharts.com/docs/v5/concepts/animations/
                                        series.appear(1000);
                                        chart.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <div class="col-lg-12 mb-3">
                                    <div class="card gutter-b">
                                        <div style=" width: 100%;height: 600px; margin-left: auto; margin-right: auto;" id="departmentWiseBar"></div>
                                    </div>
                                </div>
                                <!-- Lead Department chart End -->
                                
                                <!-- Lead Program chart Start -->
                                <div class="col-lg-12">
                                    <h4>Lead Program Wise</h4>
                                    
                                    <div class='row'>
	                                    <?php $count = 0;
	                                    foreach ($programWise as $program) : 
	                                        if($count == count($color))
	                                            $count=0;
	                                    ?>
	                                        <div class="col-xl-2">
	                                            <!--begin::Stats Widget 10-->
	                                            <div class="card card-custom card-stretch gutter-b" style="border: 1px solid <?= $color[$count++] ?>;">
	                                                <!--begin::Body-->
	                                                <div class="card-body p-0">
	                                                    <div class="align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">
	
	                                                        <div class="d-flex flex-column text-center">
	                                                            <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $program['value'] ?? '0';?></span>
	                                                            <span class="text-muted font-weight-bold mt-2 text-center"><?= $program['category'] ?></span>
	                                                        </div>
	                                                    </div>
	                                                    
	                                                </div>
	                                                <!--end::Body-->
	                                            </div>
	                                            <!--end::Stats Widget 10-->
	                                        </div>
	
	                                    <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- Pie Chart -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("programWise");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                        var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                            layout: root.verticalLayout
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                        var series = chart.series.push(am5percent.PieSeries.new(root, {
                                            alignLabels: true,
                                            calculateAggregates: true,
                                            valueField: "value",
                                            categoryField: "category"
                                        }));

                                        series.slices.template.setAll({
                                            strokeWidth: 3,
                                            stroke: am5.color(0xffffff)
                                        });

                                        series.labelsContainer.set("paddingTop", 30)


                                        // Set up adapters for variable slice radius
                                        // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                                        series.slices.template.adapters.add("radius", function(radius, target) {
                                            var dataItem = target.dataItem;
                                            var high = series.getPrivate("valueHigh");

                                            if (dataItem) {
                                                var value = target.dataItem.get("valueWorking", 0);
                                                return radius * value / high
                                            }
                                            return radius;
                                        });


                                        // Set data
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                        var data = <?= json_encode($programWise) ?>;
                                        data = data.map(obj => {
                                            // Map over all the keys in your object
                                            Object.keys(obj).map(key => {
                                                // Check if the key is numeric
                                                if (!isNaN(obj[key])) {
                                                    obj[key] = +obj[key];
                                                }
                                            })
                                            return obj;
                                        });
                                        series.data.setAll(data);


                                        // Create legend
                                        // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                        var legend = chart.children.push(am5.Legend.new(root, {
                                            centerX: am5.p50,
                                            x: am5.p50,
                                            marginTop: 15,
                                            marginBottom: 15
                                        }));

                                        legend.data.setAll(series.dataItems);


                                        // Play initial series animation
                                        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                        series.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <div class="col-lg-12 mb-3">
                                    <div class="card gutter-b">
                                        <div style=" width: 100%;height: 600px; margin-left: auto; margin-right: auto;" id="programWise"></div>
                                    </div>
                                </div>
                                <!-- Bar Chart -->
                                <script>
                                    am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("programWiseBar");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                            am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                        var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                            panX: true,
                                            panY: true,
                                            wheelX: "panX",
                                            wheelY: "zoomX"
                                        }));

                                        // Add cursor
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                        cursor.lineY.set("visible", false);


                                        // Create axes
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                        var xRenderer = am5xy.AxisRendererX.new(root, {
                                            minGridDistance: 30
                                        });
                                        xRenderer.labels.template.setAll({
                                            rotation: -90,
                                            centerY: am5.p50,
                                            centerX: am5.p100,
                                            paddingRight: 15
                                        });

                                        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                            maxDeviation: 0.3,
                                            categoryField: "category",
                                            renderer: xRenderer,
                                            tooltip: am5.Tooltip.new(root, {})
                                        }));

                                        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                            maxDeviation: 0.3,
                                            renderer: am5xy.AxisRendererY.new(root, {})
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                            name: "Series 1",
                                            xAxis: xAxis,
                                            stacked: true,
                                            yAxis: yAxis,
                                            valueYField: "value",
                                            sequencedInterpolation: true,
                                            categoryXField: "category",
                                            tooltip: am5.Tooltip.new(root, {
                                                labelText: "{valueY}"
                                            })
                                        }));

                                        series.columns.template.setAll({
                                            cornerRadiusTL: 5,
                                            cornerRadiusTR: 5
                                        });
                                        series.columns.template.adapters.add("fill", (fill, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });

                                        series.columns.template.adapters.add("stroke", (stroke, target) => {
                                            return chart.get("colors").getIndex(series.columns.indexOf(
                                                target));
                                        });


                                        // Set data
                                        var data = <?= json_encode($programWise) ?>;
                                        data = data.map(obj => {
                                            // Map over all the keys in your object
                                            Object.keys(obj).map(key => {
                                                // Check if the key is numeric
                                                if (!isNaN(obj[key])) {
                                                    obj[key] = +obj[key];
                                                }
                                            })
                                            return obj;
                                        });


                                        xAxis.data.setAll(data);
                                        series.data.setAll(data);


                                        // Make stuff animate on load
                                        // https://www.amcharts.com/docs/v5/concepts/animations/
                                        series.appear(1000);
                                        chart.appear(1000, 100);

                                        var exporting = am5plugins_exporting.Exporting.new(root, {
                                            menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                            dataSource: data
                                        });

                                        exporting.events.on("dataprocessed", function(ev) {
                                            for (var i = 0; i < ev.data.length; i++) {
                                                ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                            }
                                        });

                                    }); // end am5.ready()
                                </script>
                                <div class="col-lg-12 mb-3">
                                    <div class="card gutter-b">
                                        <div style=" width: 100%;height: 600px; margin-left: auto; margin-right: auto;" id="programWiseBar"></div>
                                    </div>
                                </div>
                                <!-- Lead Program chart End -->
                                
                                
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>

<script>
    const base_url = '<?= base_url() ?>';

    function reloadChart(id, btnId, p) {
        $('#' + btnId).prop('disabled', true)
        $.ajax({
            url: base_url + '/helper/' + p,
            type: 'POST',
            data: {
                'country': p,
            },
            async: false,
            success: function(result) {
                $('#' + btnId).prop('disabled', false)
            },
            error: function() {
                //console.log(result)
                $('#' + btnId).prop('disabled', false)
                showFire(`error`, `Something Went Wrong on Server Side`);
            }
        })
        return;
    }
</script>