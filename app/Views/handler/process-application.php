<?php
$formStep = [
    '1'=>'Payment',
    '2'=>'Payment Done and now in Profile Step.',
    '3'=>'Profile Done and now in Academic Step.',
    '4'=>'Academic Step done and Document Upload step.',
    '5'=>'Document Uploaded and now in Review step.',
    '6'=>'Review is Done and now in Scrutinizer Desk.',
    '7'=>'Scutinizer Desk given status Cleared then now go to Senior Desk.',
    '8'=>'Senior Desk given status cleared then go to Finance Desk.',
    '9'=>'Finance Desk cleared status then go to Verify Desk.',
    '10'=>'Verify Desk cleared status then go to Enrollment Desk.',
    '11'=>'Enrollment Desk cleared then your Admission done.',
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
                                        <h3 class="wizard-title d-flex">1.<span class="d-none d-lg-flex">&nbsp;<a style="color:#fff" href="<?= base_url('handler/process-application/'.$lid.'/'.$sid.'/profile-detail') ?>">Profile Details</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">2.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="<?= base_url('handler/process-application/'.$lid.'/'.$sid.'/academic-detail') ?>">Academic Details</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 3 Nav-->
                                <!--begin::Wizard Step 4 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">3.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="<?= base_url('handler/process-application/'.$lid.'/'.$sid.'/document-upload') ?>">Documents Upload</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 4 Nav-->
                                <!--begin::Wizard Step 5 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">4.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="<?= base_url('handler/process-application/'.$lid.'/'.$sid.'/review') ?>">Review and Submit</a></span></h3>
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
                                <?php if ($step == 'payment') {
                                    include('lms-payment.php');
                                } elseif (in_array($step, ['profile-detail', 'parent-detail', 'address-detail'])) {
                                    include('lms-profile-details.php');
                                } elseif ($step == 'academic-detail') {
                                    include('form-academic-detail.php');
                                } elseif ($step ==  'document-upload') {
                                    include('form-document-upload.php');
                                } elseif ($step ==  'review') {
                                    include('form-review.php');
                                }elseif ($step ==  'application-detail') {
                                    include('application-detail.php');
                                }else {
                                    include('lms-payment.php');
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