<?php

use App\Models\ApplicationModel;

function getSinglehandler($handler)
{
    if ($handler == session('id'))
        return 'You';
    $handlerModel = new ApplicationModel('lms_users_'.session('year'), 'lu_id', 'reg_setting_db');
    $handler = $handlerModel->select(['user_name'])->where('lu_id', $handler)->where('user_report_to', session('id'))->first();
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

$uri = current_url(true);
$query = $uri->getQuery();

?>


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
                        <h3 class="card-label">Edit Application Form(Reopen) [Totals: <?= $total_records??0 ?>]

                        </h3>
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
                                            <input type="text" name="from" id="from" class="form-control" value="<?= isset($_GET['from']) ? $_GET['from'] : null ?>" placeholder="dd-mm-yyyy">

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="input-icon form-group">
                                            <label for="to">To</label>
                                            <input type="text" name="to" id="to" class="form-control" value="<?= isset($_GET['to']) ? $_GET['to'] : null ?>" placeholder="dd-mm-yyyy">

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
                                                        <option data-dept="<?= $program['dept_id'] ?>" data-level="<?= $program['level_id']  ?>" value="<?= $program['coi_id'] ?>" <?= (in_array($program['coi_id'], $_GET['program'] ?? [])) ? 'selected' : null ?>><?= $program['course_name'] ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="handlers">Handler</label>
                                                <select name="handlers[]" id="handlers" class="form-control selectpicker" data-live-search="true"  multiple>
                                                    <?php foreach ($handlers as $handler) : ?>
                                                        <option  value="<?= $handler['lu_id'] ?>" <?= (in_array($handler['lu_id'], $_GET['handlers'] ?? [])) ? 'selected' : null ?>><?= $handler['user_name'] ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="handlers">Nationality</label>
                                                <select name="nationality[]" id="nationality" class="form-control selectpicker" data-live-search="true"  multiple>
                                                    <?php foreach ($student_nationalities as $nation) : ?>
                                                        <option  value="<?= $nation['id'] ?>" <?= (in_array($nation['id'], $_GET['nationality'] ?? [])) ? 'selected' : null ?>><?= $nation['name'] ?> </option>
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
                    </div>



                    <div class="row mx-2 align-items-center">
                        <!--begin: Datatable-->
                        <div class="col-lg-12 col-xl-12 datatable datatable-default datatable-bordered datatable-loaded">
                            <table class="table table-bordered table-checkable" id="kt_datatable">
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
                                            <td><?= $lead['fs_name']??'Form Step Unknown'; ?></td>
                                            <td><?= $admissionStatus[$lead['admisn_status']] ?></td>
                                            <td><?= $lead['course_name'] ?></td>
                                            <td><?= getSinglehandler($lead['handler_id']) ?></td>

                                            <td><?= $lead['source_name'] ?></td>

                                            <td class="" >
                                                <a href="<?= base_url('handler/edit-application-form/' . $lead['lead_id'].'/'.$lead['sid']) ?>" class="btn btn-sm btn-clean" title="Edit Application Form">
                                                    <i class="flaticon2-sheet"></i>Edit App. Form
                                                </a>


                                            </td>

                                        </tr>
                                    <?php $count++;
                                    endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!--end: Datatable-->
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