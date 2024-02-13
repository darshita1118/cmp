<?php

use App\Models\ApplicationModel;

$config  = new \Config\Encryption();
$encrypter = \Config\Services::encrypter($config);
$seeModel = new ApplicationModel('student_entrance_exam_' . session('year'), 'see_id', 'sso_'.session('suffix'));
$see = $seeModel->select(['exam_id', 'exam_name', 'exam_type', 'exam_status', 'question_count', 'exam_result'])->join('entrance_exams', 'student_entrance_exam_' . session('year') . '.exam_id=entrance_exams.ee_id')->where('sid', $sid)->orderBy('see_id','DESC')->first();
if (@$see['exam_type'] == '0') {
    $seerModel = new ApplicationModel('student_entrance_exam_result_' . session('year'), 'rid', 'sso_'.session('suffix'));
    $seer = $seerModel->select(['total_marks', 'marks_obtain', 'lhid'])
        ->join('student_entrance_exam_history_' . session('year'), 'student_entrance_exam_history_' . session('year') . '.lhid=student_entrance_exam_result_' . session('year') . '.live_test_id')
        ->where(['student_entrance_exam_history_' . session('year') . '.user_id' => $sid, 'test_series_id' => $see['exam_id']])->first();
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
<div class="col-lg-12 pr-0 pl-0">
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header border-0 pt-2 pl-2">
            <div class="card-title">
                <div class="card-label">
                    <div class="font-weight-bolder">Entrance Exam</div>
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
                            <?php if (@$see == null) {
                                echo 'Dear Student, Entrance Exam not allotted yet.';
                            } else {
                                if ($see['exam_status'] == 1) {
                                    echo 'Dear Student, You have given <b>' . $see['exam_name'] . '</b>(' . (($see['exam_type'] == 1) ? 'Interview' : 'Exam') . '). Your score is <b>' . $obtain . '</b> out of <b>' . $totalMarks . '</b>.';
                                    if ($see['exam_type'] == '0') {
                                        if ($seer['lhid'] != '') { ?>
                                            <a class="btn-sumbit" href="<<?= $ssoUrl; ?>" target="_blank">Answer Sheet</a>
                                        <?php }
                                    }
                                } else {
                                    echo 'Dear Student, <b>' . $see['exam_name'] . '</b>(' . (($see['exam_type'] == 1) ? 'Interview' : 'Exam') . ') allotted to you.';
                                    if ($see['exam_type'] == '0') { ?>
                                        <a class="btn" href="<?= $ssoUrl; ?>" style="background:#1b449c; color:#fff;" target="_blank">Starts Test</a>
                            <?php } else {
                                        echo ' Interviewer will contact you soon.';
                                    }
                                }
                            } ?>
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
                window.location.href = '<?= base_url($skipCouselling.'skip_counselling/'.$sid.'/'.$lid) ?>';
            }
        });
    }
</script>