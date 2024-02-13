<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">

            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-2 px-3">
                    <div class="card-title">
                        <h3 class="card-label font-weight-bolder">Student Learning Report [Totals: <?= $total_records??0 ?>]</h3>
                    </div>

                </div>
                <div class="card-body mx-3">

                    <div class="row align-items-center">
                        <form action="" method="get">
                            <div class="col-lg-12 col-xl-12">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 col-xl-2">
                                        <div class="form-group">
                                            <label for="sid">SID</label>
                                            <div class="input-icon">
                                                <input type="tel" name="sid" class="form-control" placeholder="Search SID" value="<?= isset($_GET['sid']) ? $_GET['sid'] : null ?>">
                                                <span>
                                                    <i class="flaticon2-search-1 text-muted"></i>
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">
                                            <label for="desk">Desk</label>
                                            <select name="desk[]" id="desk" class="form-control selectpicker" multiple>
                                                <?php foreach ($desks as $desk) : ?>
                                                    <option value="<?= $desk['dr_id'] ?>" <?= (in_array($desk['dr_id'], $_GET['desk'] ?? [])) ? 'selected' : null ?>><?= ucwords($desk['dr_name']) ?> </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-xl-2">
                                        <div class="input-icon form-group">
                                            <label for="from">From</label>
                                            <input type="text" name="from" id="from1" class="form-control" value="<?php if (!empty($_GET['from'])) echo date('d-m-Y', strtotime($_GET['from'])) ?? null; ?>" autocomplete="off" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-xl-2">
                                        <div class="input-icon form-group">
                                            <label for="to">To</label>
                                            <input type="text" name="to" id="to1" class="form-control" value="<?php if (!empty($_GET['to'])) echo date('d-m-Y', strtotime($_GET['to'])) ?? null; ?>" autocomplete="off" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="source">Source</label>
                                                <select name="source[]" id="source" class="form-control selectpicker" multiple>
                                                    <option value="">--Select--</option>
                                                    <?php foreach ($sources as $key) : ?>
                                                        <option value="<?= $key['st_id'] ?>" <?= (in_array($key['st_id'], $_GET['source'] ?? [])) ? 'selected' : null ?>><?= $key['st_name'] ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="learner_class">Learner Class</label>
                                                <select name="learner_class" id="learner_class" class="form-control selectpicker">
                                                    <option value="">--Select--</option>
                                                    <?php foreach ($learner_classes as $k => $v) : ?>
                                                        <option value="<?= $v ?>" <?= ($v == ($_GET['learner_class'] ?? '')) ? 'selected' : null ?>><?= ucfirst($v) ?> Learner</option>
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
                                                        <option value="<?= $program['coi_id'] ?>" <?= (in_array($program['coi_id'], $_GET['program'] ?? [])) ? 'selected' : null ?>><?= $program['course_name'] ?> </option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">
                                            <div class="m-auto ">
                                                <label for="medium">Medium</label>
                                                <select name="medium" id="medium" class="form-control">
                                                    <option value="">---Select---</option>
                                                    <option value="0" <?= (@$_GET['medium'] === '0') ? 'selected' : null ?>>English</option>
                                                    <option value="1" <?= (@$_GET['medium'] === '1') ? 'selected' : null ?>>Hindi</option>
                                                    <option value="null" <?= (@$_GET['medium'] === 'null') ? 'selected' : null ?>>Pending</option>
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
                    </div>




                    <!--begin: Datatable-->
                    <div class="datatable datatable-default datatable-bordered datatable-loaded">
                        <table class="table table-bordered table-checkable" id="scrut">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name<br>
                                        <span class="text-muted" style="font-size: .8rem;">E-mail<span>
                                    </th>
                                    <th>SID</th>
                                    <th>Mobile</th>
                                    <th>Department</th>
                                    <th>Program</th>
                                    <th>Medium</th>
                                    <th>Source</th>
                                    <th>Last Qualification</th>
                                    <th>Grade</th>
                                    <th>Learner Class</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($leads as $lead) : ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= trim(ucwords($lead['si_first_name'] . ' ' . $lead['si_middle_name'] . ' ' . $lead['si_last_name'])) ?><br>
                                            <span class="text-muted" style="font-size: .8rem;"><?= $lead['sci_email'] ?><span>
                                        </td>
                                        <td><?= $lead['sid'] ?></td>
                                        <td><?= "(" . $lead['sci_country_code'] . ")" ?>-<?= $lead['sci_mobile'] ?></td>
                                        <td><?= $lead['dept_name'] ?></td>
                                        <td><?= $lead['course_name'] ?></td>
                                        <td><?= ($lead['medium'] === '0') ? 'English' : (($lead['medium'] === '1') ? 'Hindi' : null) ?></td>
                                        <td><?= $lead['st_name'] ?></td>
                                        <td>
                                            <small>
                                                Level: <b><?= $lead['el_name'] ?></b><br>
                                                Board/University:<b><?= $lead['board_university'] ?></b><br>
                                                Institude/School:<b><?= $lead['institute_school'] ?></b><br>
                                                Year:<b><?= $lead['year'] ?></b>
                                            </small>
                                        </td>
                                        <td>
                                            <?= $lead['grade'] ?>
                                        </td>
                                        <td>
                                            <?= $lead['learner_class'] ?>
                                        </td>
                                    </tr>
                                <?php $count++;
                                endforeach; ?>
                            </tbody>
                        </table>
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

                    <!--end: Datatable-->
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
            var table = $('#scrut');

            // begin first table
            table.DataTable({
                responsive: true,
                // Pagination settings
                dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
				<'row'<'col-sm-12'tr>>
				<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

                buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
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