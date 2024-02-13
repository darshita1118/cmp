<?php

use App\Models\ApplicationModel;

function getHandlerList($notIn = [] , $in=[])
{
    $handlerModel = new ApplicationModel('lms_users_'.session('year'), 'lu_id', 'reg_setting_db');
    $handlers = $handlerModel->select(['lu_id','user_name', 'user_role', 'user_report_to'])->where(['user_status'=>1, 'user_deleted_status'=>0, 'user_report_to'=>session('report_to')])->whereIn('lu_id', $in);
    if(!empty($notIn)){
        $handlers->whereNotIn('lu_id', $notIn);
    }
    return $handlers->findAll()??[];
}
$handlers = getHandlerList([session('id')], $teamMembers);
?>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">

            <!--begin::Card-->
            <div class="card card-custom gutter-b ">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">All Team Allocated Leads [Totals: <?= $total_records??0 ?>]

                        </h3>
                    </div>
                    
                </div>
                <div class="card-body mx-3">

                    <div class="row align-items-center mx-0">
                        <form action="" method="get">
                            <div class="col-lg-12 col-xl-12">
                                <div class="row align-items-center">

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
                                        <div class="form-group">
                                            <label for="from">From</label>
                                            <input type="text" name="from" id="from" placeholder="dd-mm-yyyy" class="form-control" value="<?= isset($_GET['from']) ? $_GET['from'] : null ?>">

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="form-group">
                                            <label for="to">To</label>
                                            <input type="text" name="to" id="to" placeholder="dd-mm-yyyy" class="form-control" value="<?= isset($_GET['to']) ? $_GET['to'] : null ?>">

                                        </div>
                                    </div>
                                    

                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="status">Status</label>
                                                <select name="status[]" id="status" class="form-control selectpicker" multiple>
                                                    <option value="">--Select--</option>
                                                    <?php foreach ($statues as $status) : ?>
                                                        <option value="<?= $status['status_id'] ?>" <?= (in_array($status['status_id'], $_GET['status'] ?? [])) ? 'selected' : null ?>><?= $status['status_name'] ?> </option>
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
                                                    <option value="">--Select--</option>
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
                                                <label for="department">Department</label>
                                                <select name="department[]" id="department" class="form-control selectpicker" multiple>
                                                    <option value="">--Select--</option>
                                                    <?php foreach ($departments as $dept) : ?>
                                                        <option value="<?= $dept['dept_id'] ?>" <?= (in_array($dept['dept_id'], $_GET['department'] ?? [])) ? 'selected' : null ?>><?= $dept['dept_name'] ?> </option>
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
                                                    <option value="">--Select--</option>
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
                                        <button type="submit" class="form-control btn btn-light-primary font-weight-bold" style="height: 32px; padding: 7px;">Search</button>

                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>




                    <!--begin: Datatable-->
                    <div class="datatable datatable-default datatable-bordered datatable-loaded">
                        <table class="table table-bordered table-checkable" id="kt_datatable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>School/Program</th>
                                    <th>Handler Information</th>
                                    <th>Allocation Date</th>
                                    <th>Status</th>
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
                                        <td><?= trim(ucwords($lead['lead_first_name'] . ' ' . $lead['lead_middle_name'] . ' ' . $lead['lead_last_name'])) ?><br>
                                        <small><?= $lead['lead_email'] ?></small><br>
                                        <small><?= "(" . $lead['lead_country_code'] . ")" ?>-<?= $lead['lead_mobile'] ?></small></td>
                                        
                                        <td><?= $lead['dept_name'].'/'.$lead['course_name'] ?></td>
                                        <td><?= trim(ucwords($lead['user_name'])) ?>
                                        <?= ($lead['user_email']==session('email') && $lead['user_mobile'] == session('mobile'))?"(You)":null ?>
                                        <br>
                                        <small><?= $lead['user_email'] ?></small><br>
                                        <small><?= $lead['user_mobile'] ?></small></td>
                                        <td><?= $lead['lal_created_at'] ?></td>
                                        <td><?= $lead['status_name'] ?></td>
                                        <td><?= $lead['source_name'] ?></td>

                                        <td>
                                            <a href="<?= base_url('handler/lead-profile/' . $lead['lid']) ?>" class="btn table_edit" title="Profile Open"> Edit
											</a>
                                            <button type="button" onclick="transfer(<?= $lead['lid'] ?>)"  class="btn table_warning" title="Transfer Lead"> 
                                                Transfer
                                            </button>
                                            
                                        </td>

                                    </tr>
                                <?php $count++;
                                endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    
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

                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<div class="modal fade" id="transferlead" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transferlead">Transfer Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="<?= base_url('handler/transfered-leads') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row mx-0">
                        <input type="hidden" name='lead' id="leadId" value="">
                        <!--end::Heading-->
                        <div class="form-group col-lg-12">
                            <label for="handler">Choose Handler:</label>
                            <select  id="handler" name="handler" class="form-control form-control-solid" required="">
                                <option value="">--Choose Handler--</option>
                                <?php foreach($handlers as $handler): ?>
                                    <option value="<?= $handler['lu_id'] ?>"><?= $handler['user_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-12 mx-auto">

                            <button class=" btn btn-primary font-weight-bold" name='btn' type="submit" value="transfer">Transfer</button>
                            <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
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
<script>
    function transfer(params){
        $('#leadId').val(params)
        $('#transferlead').modal('show');
    }
</script>