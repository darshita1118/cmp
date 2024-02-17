<?php

use App\Models\ApplicationModel;

$scModel = new ApplicationModel('student_counselling_' . session('year'), 'sc_id', SSODB . session('suffix'));
$counselling = $scModel->select(['sc_id', 'sc_time', 'sc_status', 'sc_link', 'sc_password'])->where('sid', $sid)->first() ?? [];
?>
<div id="counseling" class="form-step active">
    <div class="card border-0  mb-4">
        <div class="card-header bg-none p-3 h3 m-0 d-flex align-items-center">
            <i class="fa fa-credit-card fa-lg me-2 text-gray text-opacity-50"></i>
            <p>2. Career Counseling</p>
        </div>

        <div class="card-body  border-bottom pb-4">
            <div class="alert alert-primary rounded-0 d-flex align-items-center mb-0">
                <div class="fs-24px w-80px text-center">
                    <i class="fa fa-note-sticky fa-2x"></i>
                </div>
                <div class="flex-1 ms-3">
                    <h3>Demo Notes</h3>
                    <ul class="ps-3 mb-1">
                        <?php if (isset($counselling) && @$counselling['sc_status'] == '0') { ?>
                            <li>Career Counselling Scheduled on <strong><?= $counselling['sc_time'] ?></strong>.<br>Online meeting details will be shered with you soon by the Counselor.</li>
                        <?php } elseif (isset($counselling) && @$counselling['sc_status'] == 1) { ?>
                            <li>Career Counselling Scheduled on <?= $counselling['sc_time'] ?>.<br>Click on link <a href="<?= $counselling['sc_link'] ?>" target="_blank"><?= $counselling['sc_link'] ?></a> using password <?= $counselling['sc_password'] ?>.</li>
                            <li>If Career Counselling done than you can process with next step by submitting below feedback form.
                                <div class="col-md-12 mx-auto pt-4">
                                    <div class="input-group">
                                        <form method="post" name="once" action="<?= base_url($actionUrl . $lid . '/' . $sid) ?>">
                                            <?= csrf_field() ?>
                                            <div class="row">
                                                <div class="col-lg-4 text-center">
                                                    <label class="col-form-label-sm">Couselling Feedback</label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select class="form-control" name="feedback" required>
                                                        <option value="">---Select---</option>
                                                        <option value="1">Excellent</option>
                                                        <option value="2">Good</option>
                                                        <option value="3">Average</option>
                                                        <option value="4">Below Average</option>
                                                        <option value="5">Poor</option>
                                                    </select>
                                                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('feedback') ?></span>
                                                </div>
                                                <div class="col-lg-2 text-center">
                                                    <input class="btn btn-primary btn-sm" name="btn" type="submit" value="career-counseling" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php } else { ?>
                            <li>Training and Placement Cell, Suresh Gyan Vihar University Jaipur regularly conduct the
                                counseling and training
                                session for preparing for the competitive examinations like CAT/GMAT/GATE/GRE and other and in
                                preparedness for
                                placements. If you wanrt to take Career Counselling then Schedule Now :-
                                <div class="col-md-6 m-auto pt-4">
                                    <div class="input-group">
                                        <form method="post" name="once" action="<?= base_url($actionUrl . $lid . '/' . $sid) ?>">
                                            <?= csrf_field() ?>
                                            <div class="row">
                                                <div class="col-lg-4 text-center">
                                                    <label class="col-form-label">Set Schedule</label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <input id="datetime" type="datetime-local" class="form-control" name="cdate" placeholder="Select date & time" autocomplete="off" />
                                                    </div>
                                                    <span class="form-text text-danger"><?= \Config\Services::validation()->showError('cdate') ?></span>
                                                </div>
                                                <div class="col-lg-2 text-center">
                                                    <input class="btn btn-primary btn-sm" name="btn" type="submit" value="schedule-meeting" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 m-auto pt-4">
                <p style="padding: 0 10px; font-size: 1.10rem!important; margin: 8px 0;">
                    If you want to skip the career couselling & go to further process:- <a href="<?= base_url($skipCouselling . $sid . '/' . $lid) ?>" role="button">Click Here...</a></p>
            </div>
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