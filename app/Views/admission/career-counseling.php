<?php
use App\Models\ApplicationModel;
$scModel = new ApplicationModel('student_counselling_' . session('year'), 'sc_id', 'sso_'.session('suffix'));
$counselling = $scModel->select(['sc_id', 'sc_time', 'sc_status', 'sc_link', 'sc_password'])->where('sid', $sid)->first() ?? [];
?>
<div class="col-lg-12 pr-0 pl-0">
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header border-0 pt-2 pl-2">
            <div class="card-title">
                <div class="card-label">
                    <div class="font-weight-bolder">Career Counselling</div>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body d-flex flex-column px-0 py-2" style="position: relative;">
            <!--begin::Items-->
            <div class="flex-grow-1 row mx-0 progres">
                <!--begin::Item-->
                <div class="col-lg-12 align-items-center justify-content-between">
                    <div class="d-flex align-items-center w-100">
                        <div class="symbol symbol-50 symbol-light mr-3" style="align-self: flex-start;">
                            <div class="symbol-label">
                                <span class="symbol-label">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/General/User.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <circle fill="#3699ff" opacity="0.3" cx="12" cy="9" r="8" />
                                            <path d="M14.5297296,11 L9.46184488,11 L11.9758349,17.4645458 L14.5297296,11 Z M10.5679953,19.3624463 L6.53815512,9 L17.4702704,9 L13.3744964,19.3674279 L11.9759405,18.814912 L10.5679953,19.3624463 Z" fill="#3699ff" opacity="0.3" />
                                            <path d="M10,22 L14,22 L14,22 C14,23.1045695 13.1045695,24 12,24 L12,24 C10.8954305,24 10,23.1045695 10,22 Z" fill="#3699ff" opacity="0.3" />
                                            <path d="M9,20 C8.44771525,20 8,19.5522847 8,19 C8,18.4477153 8.44771525,18 9,18 C8.44771525,18 8,17.5522847 8,17 C8,16.4477153 8.44771525,16 9,16 L15,16 C15.5522847,16 16,16.4477153 16,17 C16,17.5522847 15.5522847,18 15,18 C15.5522847,18 16,18.4477153 16,19 C16,19.5522847 15.5522847,20 15,20 C15.5522847,20 16,20.4477153 16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 C8,20.4477153 8.44771525,20 9,20 Z" fill="#3699ff" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                        </div>
                        <div class="ml-2">
                            <?php if (isset($counselling) && @$counselling['sc_status'] == '0') { ?>
                                <p class="font-size-h6 text-dark-75 font-weight-bolder">
                                    Career Counselling Scheduled on <?= $counselling['sc_time'] ?>.<br>Online meeting details will be shered with you soon by the Counselor.
                                </p>
                            <?php } elseif (isset($counselling) && @$counselling['sc_status'] == 1) { ?>
                                <p class="font-size-h5 text-dark-75 font-weight-bolder">
                                    Career Counselling Scheduled on <?= $counselling['sc_time'] ?>.<br>Click on link <a href="<?= $counselling['sc_link'] ?>" target="_blank"><?= $counselling['sc_link'] ?></a> using password <?= $counselling['sc_password'] ?>.
                                </p><br>
                                <p class="font-size-h6 text-dark-75 mb-1">
                                    If Career Counselling done than you can process with next step by submitting below feedback form.
                                <div class="date_schedule col-lg-12">
                                    <form method="POST" name="once">
                                        <div class="row">
                                            <div class="col-lg-1 text-center"></div>
                                            <div class="col-lg-3 text-center">
                                                <label class="col-form-label-sm">Couselling Feedback</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <select class="form-control datetimepicker-input form-control-sm form-control-solid" name="feedback" required>
                                                    <option value="">---Select---</option>
                                                    <option value="1">Excellent</option>
                                                    <option value="2">Good</option>
                                                    <option value="3">Average</option>
                                                    <option value="4">Below Average</option>
                                                    <option value="5">Poor</option>
                                                </select>
                                                <span class="form-text text-danger"><?= \Config\Services::validation()->showError('feedback') ?></span>
                                            </div>
                                            <div class="sub_btn_carrer col-lg-1 text-center">
                                                <input class="btn btn-primary btn-sm" name="subfeedback" type="submit" value="Submit & Next" />
                                            </div>
                                            <div class="col-lg-2 text-center"></div>
                                        </div>
                                    </form>
                                </div>
                                </p>
                            <?php } else { ?>
                                <p class="font-size-h6 text-dark-75 font-weight-bolder">
                                    Training and Placement Cell, Suresh Gyan Vihar University Jaipur regularly conduct the
                                    counseling and training
                                    session for preparing for the competitive examinations like CAT/GMAT/GATE/GRE and other and in
                                    preparedness for
                                    placements. If you wanrt to take Career Counselling then Schedule Now :-
                                </p>
                                <div class="date_schedule col-lg-12">
                                    <form method="POST" name="once">
                                        <div class="row">

                                            <div class="col-lg-1 text-center"></div>
                                            <div class="col-lg-2 text-center">
                                                <label class="col-form-label">Set Schedule</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
                                                    <input id="datetime" type="text" class="form-control datetimepicker-input form-control-lg form-control-solid" data-toggle="datetimepicker" data-target="#datetime" name="cdate" placeholder="Select date & time" autocomplete="off" />
                                                    <div class="input-group-append" data-target="#datetime" data-toggle="datetimepicker">
                                                        <span class="input-group-text">
                                                            <i class="ki ki-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <span class="form-text text-danger"><?= \Config\Services::validation()->showError('cdate') ?></span>
                                            </div>
                                            <div class="sub_btn_carrer col-lg-2 text-center">
                                                <button type="submit" class="btn btn-primary font-weight-bolder text-uppercase" value= "schedule-meeting"name="btn">Submit</button>
                                                <input class="btn btn-primary btn-sm" name="counselling" type="submit" value="Submit" />
                                            </div>
                                            <div class="col-lg-4 text-center"></div>
                                        </div>
                                    </form>
                                </div>
                            <?php } ?>
                            <br>
                            <div class="go_to_txt">
                                <p style="padding: 0 10px; font-size: 1.10rem!important; margin: 8px 0;">
                                    If you want to skip the career couselling & go to further process:- <a href="<?= base_url($skipCouselling.$sid.'/'.$lid) ?>" role="button">Click Here...</a></p>
                            </div>
                        </div>
                    </div>

                    <!--end::Item-->
                </div>
                <!--end::Items-->
            </div>
            <!--end::Body-->
        </div>
    </div>
</div>
<script>
    function sure() {
		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, skip it!"
		}).then(function(result) {
			if (result.value) {
				window.location.href = '<?= base_url() ?>' + '/home/skip_counselling';
			}
		});
	}
</script>