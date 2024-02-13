<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">

            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label"><?= $title ?>

                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <?php /*
			            <a href="<?= base_url('export?'.$query) ?>" class="btn btn-info font-weight-bolder mx-2">
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
                            </span>Download List
                        </a>
                        */ ?>


                    </div>
                </div>
                <div class="card-body">

                    <div class="row mx-0 align-items-center ">
                        <form action="" method="get">
                            <div class="col-lg-12 col-xl-12">
                                <div class="row mx-0 align-items-center">

                                    <div class="col-lg-3 col-xl-3">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <div class="input-icon">
                                                <input type="tel" name="mobile" class="form-control" placeholder="Search mobile no.." minlength="8" value="<?= isset($_GET['mobile']) ? $_GET['mobile'] : null ?>" maxlength="12">
                                                <span>
                                                    <i class="flaticon2-search-1 text-muted"></i>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="input-icon form-group">
                                            <label for="from">From</label>
                                            <input type="text" name="from" id="from" class="form-control" placeholder="dd-mm-yyyy" data-toggle="datepicker" data-target="#from" value="<?= isset($_GET['from']) ? $_GET['from'] : null ?>">

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="input-icon form-group">
                                            <label for="to">To</label>
                                            <input type="text" name="to" id="to" class="form-control" placeholder="dd-mm-yyyy" data-toggle="datepicker" data-target="#to" value="<?= isset($_GET['to']) ? $_GET['to'] : null ?>">

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3 col-xl-3">
										<div class="align-items-center form-group">

											<div class="m-auto ">
												<label for="status">Status</label>
												<select name="status[]" id="status" class="form-control selectpicker" multiple>
													
													<?php foreach($statues as $status): ?>
														<option value="<?= $status['status_id'] ?>" <?= (in_array($status['status_id'], $_GET['status']??[]))?'selected':null ?>><?= $status['status_name'] ?> </option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>




                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="source">Source</label>
                                                <select name="source[]" id="source" class="form-control selectpicker" multiple>

                                                    <?php foreach ($sources as $source) : ?>
                                                        <option value="<?= $source['source_id'] ?>" <?= (in_array($source['source_id'], $_GET['source'] ?? [])) ? 'selected' : null ?>><?= $source['source_name'] ?> </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="program">Program</label>
                                                <select name="program[]" id="program" class="form-control selectpicker" multiple>

                                                    <?php foreach ($courses as $program) : ?>
                                                        <option  value="<?= $program['sc_id'] ?>" <?= (in_array($program['sc_id'], $_GET['program'] ?? [])) ? 'selected' : null ?>><?= $program['course_name'] ?> </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="handlers">Handler</label>
                                                <select name="handlers[]" id="handlers" class="form-control selectpicker" data-live-search="true" multiple>
                                                    <?php foreach ($handlers as $handler) : ?>
                                                        <option value="<?= $handler['lu_id'] ?>" <?= (in_array($handler['lu_id'], $_GET['handlers'] ?? [])) ? 'selected' : null ?>><?= $handler['user_name'] ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="handlers">Nationality</label>
                                                <select name="nationality[]" id="nationality" class="form-control selectpicker" data-live-search="true" multiple>
                                                    <?php foreach ($student_nationalities as $nation) : ?>
                                                        <option value="<?= $nation['id'] ?>" <?= (in_array($nation['id'], $_GET['nationality'] ?? [])) ? 'selected' : null ?>><?= $nation['name'] ?> </option>
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
                            </div>

                        </form>
                        <!--begin::Separator-->
                        <div class="separator separator-solid my-2"></div>
                        <!--end::Separator-->
                        <!--begin::Bottom-->
                        <div class="row col-lg-12 py-5 ml-5 d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin: Item-->
                            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                <span class="mr-4">
                                    <i class="flaticon-piggy-bank icon-2x text-muted font-weight-bold"></i>
                                </span>
                                <div class="d-flex flex-column text-dark-75">
                                    <span class="font-weight-bolder font-size-sm">Leads</span>
                                    <span class="font-weight-bolder font-size-h5">
                                        <span class="text-dark-50 font-weight-bold"></span>
                                        <?= array_sum(array_column($statusWise, 'total_leads')); ?>
                                    </span>
                                </div>
                            </div>
                            <!--end: Item-->
                            
                            <?php foreach ($statusWise as $report) : ?>

                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm"><?= $report['name'] ?></span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <span class="text-dark-50 font-weight-bold"></span>
                                            <?= $report['total_leads'] ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->



                            <?php endforeach; ?>
                        </div>
                        <!--end::Bottom-->
                    </div>



                    <div class="row mx-2 align-items-center">

                        <div class="col-lg-12 col-xl-12 card card-custom card-stretch gutter-b px-4 py-4">

                            <div class="timeline timeline-6 mt-3">
                                <!--begin::Item-->
                                <?php foreach ($remarks as $row) :  ?>
                                    <div class="timeline-item align-items-start">
                                        <!--begin::Label-->
                                        <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">
                                            <?= $row['lr_created_at'] ?>
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-warning icon-xl"></i>
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Text-->

                                        <div class="font-weight-mormal font-size-lg timeline-content timeline-remark text-muted pl-3 ml-4">

                                            <div class=""><span class="label label-light-success font-weight-bolder label-inline">
                                                    Handler: <?= $row['user_name'] ?>
                                                </span></div>
                                            <h6 class="text-dark-75 text-hover-primary font-weight-bold">
                                                <?= ucwords(trim($row['lead_first_name'] . ' ' . $row['lead_middle_name'] .' '. $row['lead_last_name'])) ?>
                                            </h6>
                                            <div class="mb-2"><i class="la la-at"></i>
                                                <?= $row['lead_email'] ?> | <i class="la la-phone"></i>
                                                <?= $row['lead_mobile'] ?>
                                            </div>
                                            <p class="p-0 text-dark-75">
                                                <?= $row['lr_remark'] ?>
                                            </p>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>

                    <!--end: Datatable-->
                    <style>
                        .pagination-nav nav ul>.active>a {
                            margin-left: .4rem;
                            margin-right: .4rem;
                            outline: 0 !important;
                            cursor: pointer;
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-pack: center;
                            -ms-flex-pack: center;
                            justify-content: center;
                            -webkit-box-align: center;
                            -ms-flex-align: center;
                            align-items: center;
                            height: 2.25rem;
                            min-width: 2.25rem;
                            padding: .5rem;
                            text-align: center;
                            position: relative;
                            font-size: 1rem;
                            line-height: 1rem;
                            font-weight: 500;
                            border-radius: .42rem;
                            border: 0;
                            -webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
                            transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
                            transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
                            transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease;
                            background-color: #3699ff;
                            color: #fff;
                        }

                        .pagination-nav nav ul li a {
                            margin-left: .4rem !important;
                            margin-right: .4rem !important;
                            outline: 0 !important;
                            cursor: pointer;
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-pack: center;
                            -ms-flex-pack: center;
                            justify-content: center;
                            -webkit-box-align: center;
                            -ms-flex-align: center;
                            align-items: center;
                            height: 2.25rem !important;
                            min-width: 2.25rem !important;
                            padding: .5rem;
                            text-align: center;
                            position: relative;
                            font-size: 1rem;
                            line-height: 1rem;
                            font-weight: 500;
                            border-radius: .42rem;
                            border: 0;
                            -webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
                            transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
                            transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
                            transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease;
                            color: #7e8299;
                            background-color: transparent;
                        }
                    </style>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-lg-12 text-center">
                            <div id='pagination' class='pagination-nav'>
                                <?= $pager->links() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<script>
    "use strict";
    var KTDatatablesBasicPaginations = function() {

        var initTable2 = function() {
            var table = $('#kt_datatable');

            // begin first table
            table.DataTable({
                responsive: true,
                dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
				<'row'<'col-sm-12'tr>>
				<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                buttons: [

                    'excelHtml5',

                ],
                pagingType: 'full_numbers',
                lengthMenu: [5, 10, 25, 50, 100, 120, 200, 300, 400, 500, 1000],

                pageLength: 50,

            });
        };


        return {

            //main function to initiate the module
            init: function() {
                initTable2();

            }
        };
    }();

    jQuery(document).ready(function() {
        KTDatatablesBasicPaginations.init();
    });
</script>