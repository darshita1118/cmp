<?php

use App\Models\ApplicationModel;

$config  = new \Config\Encryption();
$encrypter = \Config\Services::encrypter($config);
$seeModel = new ApplicationModel('student_entrance_exam_' . session('year'), 'see_id', 'sso_' . session('suffix'));
$see = $seeModel->select(['exam_id', 'exam_name', 'exam_type', 'exam_status', 'question_count', 'exam_result'])->join('entrance_exams', 'student_entrance_exam_' . session('year') . '.exam_id=entrance_exams.ee_id')->where('sid', $sid)->orderBy('see_id', 'DESC')->first();
if (@$see['exam_type'] == '0') {

    $seerModel = new ApplicationModel('student_entrance_exam_result_' . session('year'), 'rid', 'sso_' . session('suffix'));
    $seer = $seerModel->select(['total_marks', 'marks_obtain', 'lhid'])
        ->join('student_entrance_exam_history_' . session('year'), 'student_entrance_exam_history_' . session('year') . '.lhid=student_entrance_exam_result_' . session('year') . '.live_test_id')
        ->where(['student_entrance_exam_history_' . session('year') . '.user_id' => $sid, 'test_series_id' => $see['exam_id']])
        ->first();
    //dd($seer);
    if (@$seer['lhid'] != '') {
        $totalMarks = @$seer['total_marks'];
        $obtain = @$seer['marks_obtain'];
    } else {
        $totalMarks = $see['question_count'];
        $obtain = $see['exam_result'];
    }
} else {
    $totalMarks = 100;
    $obtain = @$see['exam_result'];
}
?>

<div id="exam" class="form-step active">
    <div class="card border-0 mb-4 pb-3">
        <div class="card-header bg-none p-3 h3 m-0 d-flex align-items-center">
            <i class="fa fa-shopping-bag fa-lg me-2 text-gray text-opacity-50"></i>
            3.Entrance Exam
        </div>
        <div class="card-body p-3 text-dark fw-bold border-bottom pb-4">

            <div class="alert alert-primary rounded-0 d-flex align-items-center mb-0">
                <div class="fs-24px w-80px text-center">
                    <i class="fa fa-lightbulb fa-2x"></i>
                </div>
                <div class="flex-1 ms-3">
                    <h3>Notes</h3>
                    <ul class="ps-3 mb-1">
                        <?php if (@$see == null) {
                            echo '<li>Dear Student, Entrance Exam not allotted yet.</li>';
                        } else {
                            if ($see['exam_status'] == 1) {
                                echo '<li>Dear Student, You have given <b>' . $see['exam_name'] . '</b>(' . (($see['exam_type'] == 1) ? 'Interview' : 'Exam') . '). Your score is <b>' . $obtain . '</b> out of <b>' . $totalMarks . '</b>.</li>';
                                if ($see['exam_type'] == '0') {
                                    if ($seer['lhid'] != '') { ?>
                                        <li><a class="btn-sumbit" href="<?= base_url('quiz/test-series-result/' . $seer['lhid']) ?>">Answer Sheet</a></li>
                                    <?php }
                                }
                            } else {
                                echo '<li>Dear Student, <b>' . $see['exam_name'] . '</b>(' . (($see['exam_type'] == 1) ? 'Interview' : 'Exam') . ') allotted to you.</li>';
                                if ($see['exam_type'] == '0') { ?>
                                    <li><a class="btn" href="<?= base_url('quiz/test-series/' . bin2hex($encrypter->encrypt($see['exam_id'] . '&&1'))) ?>" style="background:#1b449c; color:#fff;">Starts Test</a></li>
                        <?php } else {
                                    echo ' <li>Interviewer will contact you soon.</li>';
                                }
                            }
                        } ?>
                    </ul>
                </div>
            </div>

        </div>
        <!-- <div class=" d-flex p-2 ">
            <a href="#" class="btn btn-default m-auto me-3 " onclick="prevStep()">Privious</a>
            <a href="#" class="btn btn-primary " onclick="nextStep()">Next</a>
        </div> -->
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
                window.location.href = '<?= base_url($skipCouselling . 'skip_counselling/' . $sid . '/' . $lid) ?>';
            }
        });
    }
</script>