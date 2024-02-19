<?php

use App\Models\ApplicationModel;

$studentParentModel = new ApplicationModel('student_family_info_' . session('year'), 'sfi_id', 'sso_' . session('suffix'));
$parentDetail = $studentParentModel->where(['sid' => $sid])->first() ?? [];
$index = array_search($subStep, $validSubSlug);
?>


<div class="tab-pane fade active show" id="parent-details">
    <!--begin::Form-->
    <form class="px-1" novalidate="novalidate" id="kt_form" method="post" action="<?= base_url($actionUrl . $lid . '/' . $sid) ?>">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-4 mb-3">

                <label class="form-label" title="Enter your father's name">Father's Name </label>
                <input type="text" id="father_name" class="form-control" name="father_name" value="<?= old('father_name') ?? ($parentDetail['father_name'] ?? ''); ?>" placeholder="Father's Name" />
                <span class="form-text text-danger"><?= \Config\Services::validation()->showError('father_name'); ?></span>

            </div>
            <div class="col-md-4 mb-3">

                <label class="form-label" title="Kindly fill your father's occupation">Father's Occupation</label>
                <input type="text" id="father_occupation" class="form-control" name="father_occupation" value="<?= old('father_occupation') ?? ($parentDetail['father_occupation'] ?? ''); ?>" placeholder="Father's Occupation" />
                <span class="form-text text-danger"><?= \Config\Services::validation()->showError('father_occupation'); ?></span>

            </div>
            <div class="col-md-4 mb-3">

                <label class="form-label" title="Kindly fill your father's annual income as per the documents of Income Tax Return/Income Certificate.">Annual Income</label>
                <input type="text" class="form-control" name="father_income" value="<?= old('father_income') ?? ($parentDetail['father_income'] ?? ''); ?>" placeholder="Annual Income" />
                <span class="form-text text-danger"><?= \Config\Services::validation()->showError('father_income'); ?></span>

            </div>
            <div class="col-md-4 mb-3">

                <label class="form-label" title="Enter your mother's name">Mother's Name</label>
                <input type="text" class="form-control" name="mother_name" value="<?= old('mother_name') ?? ($parentDetail['mother_name'] ?? ''); ?>" placeholder="Mother's Name" />
                <span class="form-text text-danger"><?= \Config\Services::validation()->showError('mother_name'); ?></span>

            </div>
            <div class="col-md-4 mb-3">

                <label class="form-label" title="Kindly fill your mother's occupation">Mother's Occupation</label>
                <input type="text" class="form-control" name="mother_occupation" value="<?= old('mother_occupation') ?? ($parentDetail['mother_occupation'] ?? ''); ?>" placeholder="Mother's Occupation" />
                <span class="form-text text-danger"><?= \Config\Services::validation()->showError('mother_occupation') ?></span>

            </div>
            <div class="col-md-4 mb-3">

                <label class="form-label" title="Kindly fill your mother's annual income as per the documents of Income Tax Return/Income Certificate.">Annual Income</label>
                <input type="text" class="form-control" name="mother_income" value="<?= old('mother_income') ?? ($parentDetail['mother_income'] ?? ''); ?>" placeholder="Annual Income" />
                <span class="form-text text-danger"><?= \Config\Services::validation()->showError('mother_income'); ?></span>

            </div>
            <div class="col-md-4 mb-3">

                <label class="form-label" title="Kindly mention your parent's email id, if any.">Parent's Email</label>
                <input type="text" class="form-control" name="parent_email" value="<?= old('parent_email') ?? ($parentDetail['parent_email'] ?? ''); ?>" placeholder="Parent's Email" />
                <span class="form-text text-danger"><?= \Config\Services::validation()->showError('parent_email'); ?></span>

            </div>
            <div class="col-md-4 mb-3">
                <label for="" class="form-label" title="Kindly mention your parent's or guardian's mobile number for future reference.">Parent's
                    Mobile No.</label>
                <input type="text" class="form-control" name="parent_mobile" value="<?= old('parent_mobile') ?? ($parentDetail['parent_mobile'] ?? ''); ?>" placeholder="Parent's Mobile No. " />
                <span class="form-text text-danger"><?= \Config\Services::validation()->showError('parent_mobile'); ?></span>
            </div>
        </div>
        <!--begin: Wizard Actions-->
        <div class="d-flex justify-content-between pt-7">
            <div class="mr-2">
                <a href="<?= base_url($route . $lid . '/' . $sid . '/' . $slug . '/' . $validSubSlug[$index - 1]) ?>" class="btn btn-light-primary font-weight-bolder text-uppercase">
                    Previous</a>
            </div>
            <div>
                <input type="hidden" name="parent" value="<?= $parentDetail['sfi_id'] ?? ''; ?>">
                <button type="submit" class="btn btn-primary font-weight-bolder text-uppercase" name="btn" value="parent-detail">Save & Next</button>
                <a href="<?= base_url($route . $lid . '/' . $sid . '/' . $slug . '/' . $validSubSlug[$index + 1]) ?>" class="btn btn-light-primary font-weight-bolder text-uppercase">NEXT</a>
            </div>
        </div>
        <!--end: Wizard Actions-->
    </form>
</div>