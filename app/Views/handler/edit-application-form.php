<?php
$formStep = [
        '1'=>'Payment',
        '2'=>'Payment Done and now in Profile Step.',
        '3'=>'Profile Done and now in Academic Step.',
        '4'=>'Academic Step done and Document Upload step.',
        '5'=>'Document Uploaded and now in Review step.',
        '11'=>'Now Your Application Form in Counselor Desk.',
        '12'=>'Now Your Application Form in Entrance Exam Desk.',
        '13'=>'Now Your Application Form in Scrutinizer Desk.',
        '14'=>'Now Your Application Form in Senior Desk.',
        '15'=>'Now Your Application Form in Finance Desk.',
        '16'=>'Now Your Application Form in Verification Desk.',
        '17'=>'Now Your Application Form in Enrollment Desk.',
        '18'=>'Enrollment Desk Cleared.'
];
$admissionStatus = [
    'Open For Student.',
    'Application Submited by student.',
    'Application Under Process.',
    'Application Reject by Respected Desk.',
    'Application is a span type given by Respected Desk.',
    'Application Admission process done.'
];
?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-body p-0">

                    <!--begin::Wizard-->
                    <div class="wizard wizard-1" id="kt_wizards" data-wizard-state="step-first" data-wizard-clickable="false">
                        <!--begin::Wizard Nav-->
                        <div class="wizard-nav border-bottom py-2">
                            <div class="wizard-steps flex-row">
                                
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step wizard_clip_active" data-wizard-state="current">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">1.<span class="d-none d-lg-flex">&nbsp;<a style="color:#fff" href="<?= base_url('handler/edit-application-form/'.$lid.'/'.$sid.'/profile-detail') ?>">Profile Details</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">2.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="<?= base_url('handler/edit-application-form/'.$lid.'/'.$sid.'/academic-detail') ?>">Academic Details</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 3 Nav-->
                                <!--begin::Wizard Step 4 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">3.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="<?= base_url('handler/edit-application-form/'.$lid.'/'.$sid.'/document-upload') ?>">Documents Upload</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 4 Nav-->
                                <!--begin::Wizard Step 5 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">4.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="<?= base_url('handler/edit-application-form/'.$lid.'/'.$sid.'/review') ?>">Review and Submit</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 5 Nav-->
                            </div>
                        </div>
                        <!--end::Wizard Nav-->
                        <!--begin::Wizard Body-->
                        <div class="row justify-content-center my-5 px-8 my-lg-5 px-lg-10">
                            <div class="col-xl-12 col-xl-12">
                                <!--begin::Wizard Form-->
                                <?php if (in_array($step, ['profile-detail', 'parent-detail', 'address-detail'])) {
                                    include('lms-profile-details-edit.php');
                                } elseif ($step == 'academic-detail') {
                                    include('edit-form-academic-detail.php');
                                } elseif ($step ==  'document-upload') {
                                    include('edit-form-document-upload.php');
                                } elseif ($step ==  'review') {
                                    include('edit-form-review.php');
                                }elseif ($step ==  'application-detail') {
                                    include('application-detail.php');
                                }else {
                                    include('edit-form-review.php');
                                }
                            ?>

                            <!--end::Wizard Form-->

                            </div>
                        </div>
                        <!--end::Wizard Body-->
                    </div>
                    <!--end::Wizard-->
                </div>
                <!--end::Wizard-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

<!--end::Content-->