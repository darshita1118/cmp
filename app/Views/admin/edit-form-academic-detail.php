<?php

use App\Models\ApplicationModel;

function getStudentInfo($sid)
{
    $departmentModel = new ApplicationModel('student_info_' . session('year'), 'si_id', 'sso_' . session('suffix'));
    return $departmentModel->where(['sid' => $sid])->first() ?? [];
}
function getLevels($course_id)
{
    $courseModel = new ApplicationModel('session_courses_'. session('year'), 'sc_id', 'sso_' . session('suffix'));
    $courseInfo = $courseModel->select(['validation_level'])->join('course_info', 'session_courses_'. session('year').'.course_id=course_info.coi_id')->where('sc_id', $course_id)->first();
				
    $elModel = new ApplicationModel('education_level', 'el_id', 'sso_' . session('suffix'));
    $el = $elModel->select(['el_id', 'el_name'])->whereIn('el_id', json_decode($courseInfo['validation_level'] ?? ''))->where('el_status', 1)->orderBy('prority', 'ASC')->findAll();
    return $el ?? [];
}
function getEducation($sid)
{
    $academicModel = new ApplicationModel('student_education_' . session('year'), 'se_id', 'sso_' . session('suffix'));
    $academic = $academicModel->where('sid', $sid)->orderBy('education_level', 'ASC');
    return $academic->findAll() ?? [];
}

$studentInfo = getStudentInfo($sid) ?? [];
$row = getEducation($sid);
$levels = getLevels($studentInfo['program_id'] ?? '') ?? [];

?>

<div class="text-white text-center d-block d-lg-none py-2 bg-primary">
    <h4 class="mb-0 font-weight-normal">Academic Details</h4>
</div>
<div class="px-4 py-2">
    <form id="kt_forms" action="<?= base_url('admin/edit-profile-step-action/'.$lid.'/'.$sid) ?>" novalidate="novalidate" method="POST">

        <!--begin::Wizard Step 1-->
        <div class="pb-5" >
            <?= csrf_field() ?>
            <?php
            foreach ($levels as $lev) : $i = $lev['el_id']; ?>

                <div class="mb-4">
                    <h5><?= $lev['el_name']; ?> Details</h5>
                </div>
                <?php

                // search education level present or not than
                if (in_array($lev['el_id'], array_column($row, 'education_level')) !== false) :
                    $key = (int) array_search($lev['el_id'], array_column($row, 'education_level'), true); ?>

                    <div class="form-group row">

                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="board<?= $i; ?>">Board/University</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="board<?= $i; ?>" id="board<?= $i; ?>" type="text" placeholder="Board/University" value="<?= old("board$i") ?? ($row[$key]['board_university'] ?? '') ?>" required />
                            <span class="form-text text-danger"><?= \Config\Services::validation()->showError('board' . $i); ?></span>
                        </div>

                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="inst_name<?= $i; ?>">Institute/School Name</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="inst_name<?= $i; ?>" id="inst_name<?= $i; ?>" type="text" placeholder="Institute/School Name" value="<?= old("inst_name$i") ?? ($row[$key]['institute_school'] ?? '') ?>" required />
                            <span class="form-text text-danger"><?= \Config\Services::validation()->showError('inst_name' . $i); ?></span>
                        </div>
                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="year<?= $i; ?>">Passing Year</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="year<?= $i; ?>" id="year<?= $i; ?>" type="text" placeholder="Passing Year" value="<?= old("year$i") ?? ($row[$key]['year'] ?? '') ?>" required />
                            <span class="form-text text-danger"><?= \Config\Services::validation()->showError('year' . $i); ?></span>
                        </div>
                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="max_marks<?= $i; ?>">Max Marks</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="max_marks<?= $i; ?>" id="max_marks<?= $i; ?>" type="text" placeholder="Max Marks" value="<?= old("max_marks$i") ?? ($row[$key]['total_marks'] ?? '') ?>" required />
                            <span class="form-text text-danger"><?= \Config\Services::validation()->showError('max_marks' . $i); ?></span>
                        </div>

                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="obtained<?= $i; ?>">Obtained Marks</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="obtained<?= $i; ?>" id="obtained<?= $i; ?>" type="text" placeholder="Obtained Marks" value="<?= old("obtained$i") ?? ($row[$key]['obtain_marks'] ?? '') ?>" required />
                            <span class="form-text text-danger"><?= \Config\Services::validation()->showError('obtained' . $i); ?></span>
                        </div>
                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="resulttype<?= $i; ?>">Result Type</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <select name="resulttype<?= $i; ?>" id="resulttype<?= $i; ?>" class="form-control form-control-solid form-control-lg">
                                <option value="">--select--</option>
                                <option value="0" <?php if ((old("resulttype$i") ?? ($row[$key]['grade_type'] ?? '')) == 0) echo "selected"; ?>>Percentage</option>
                                <option value="1" <?php if ((old("resulttype$i") ?? ($row[$key]['grade_type'] ?? '')) == 1) echo "selected"; ?>>Grade</option>
                            </select>
                            <span class="form-text text-danger"><?= \Config\Services::validation()->showError('resulttype' . $i); ?></span>
                        </div>
                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="percentage<?= $i; ?>">Percentage/Grade</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="percentage<?= $i; ?>" id="percentage<?= $i; ?>" type="text" placeholder="Percentage/Grade" value="<?= old("percentage$i") ?? ($row[$key]['grade_precentage'] ?? '') ?>" required />
                            <span class="form-text text-danger"><?= \Config\Services::validation()->showError('percentage' . $i); ?></span>
                        </div>
                    </div>
                    <input type="hidden" name="education_level<?= $i; ?>" value="<?= $i; ?>">
                <?php unset($key);
                else :

                ?>

                    <div class="form-group row">

                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="board<?= $i; ?>">Board/University</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="board<?= $i; ?>" id="board<?= $i; ?>" type="text" placeholder="Board/University" value="<?= old("board$i") ?>" required />
                        </div>

                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="inst_name<?= $i; ?>">Institute/School Name</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="inst_name<?= $i; ?>" id="inst_name<?= $i; ?>" type="text" placeholder="Institute/School Name" value="<?= old("inst_name$i") ?>" required />
                        </div>
                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="year<?= $i; ?>">Passing Year</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="year<?= $i; ?>" id="year<?= $i; ?>" type="text" placeholder="Passing Year" value="<?= old("year$i") ?>" required />
                        </div>
                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="max_marks<?= $i; ?>">Max Marks</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="max_marks<?= $i; ?>" id="max_marks<?= $i; ?>" type="text" placeholder="Max Marks" value="<?= old("max_marks$i") ?>" required />
                        </div>

                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="obtained<?= $i; ?>">Obtained Marks</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="obtained<?= $i; ?>" id="obtained<?= $i; ?>" type="text" placeholder="Obtained Marks" value="<?= old("obtained$i") ?>" required />
                        </div>
                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="resulttype<?= $i; ?>">Result Type</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <select name="resulttype<?= $i; ?>" id="resulttype<?= $i; ?>" class="form-control form-control-solid form-control-lg">
                                <option value="">Select</option>
                                <option value="0" <?php if (old("resulttype$i") == '0') echo "selected"; ?>>Percentage</option>
                                <option value="1" <?php if (old("resulttype$i") == 1) echo "selected"; ?>>Grade</option>
                            </select>
                        </div>
                        <label class="col-xl-2 col-lg-2 col-form-label px-2 mb-3" for="percentage<?= $i; ?>">Percentage/Grade</label>
                        <div class="col-lg-4 col-xl-4 px-2 mb-3">
                            <input class="form-control form-control-lg form-control-solid" name="percentage<?= $i; ?>" id="percentage<?= $i; ?>" type="text" placeholder="Percentage/Grade" value="<?= old("percentage$i") ?>" required />
                        </div>
                    </div>
                    <input type="hidden" name="education_level<?= $i; ?>" value="<?= $i; ?>">
                <?php endif; ?>

            <?php endforeach; ?>

        </div>
        <!--end::Wizard Step-->
        <!--begin::Wizard Step 1-->

        <!--begin::Wizard Actions-->
        <div class="d-flex justify-content-between border-top mt-5 pt-5">
            <div class="mr-2">
                <a href="<?= base_url('admin/edit-application-form/' . $lid . '/' . $sid . '/profile-detail') ?>" class="btn btn-light-primary font-weight-bolder text-uppercase">Previous</a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary font-weight-bolder text-uppercase" name="btn" value="academic-detail">Save & Next</button>
            </div>
        </div>
        <!--end::Wizard Actions-->
    </form>
</div>