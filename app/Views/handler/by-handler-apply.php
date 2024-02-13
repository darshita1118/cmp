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
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step wizard_clip_success" data-wizard-state="current">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">1.<span class="d-none d-lg-flex">&nbsp;<a style="color:#fff" href="?step=payment">Payment</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 1 Nav-->
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step wizard_clip_active">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">2.<span class="d-none d-lg-flex">&nbsp;<a style="color:#fff" href="?step=profile">Profile Details</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">3.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="?step=academic">Academic Details</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 3 Nav-->
                                <!--begin::Wizard Step 4 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">4.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="?step=document-upload">Documents Upload</a></span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 4 Nav-->
                                <!--begin::Wizard Step 5 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">5.<span class="d-none d-lg-flex">&nbsp;Review and Submit</span></h3>
                                    </div>

                                </div>
                                <!--end::Wizard Step 5 Nav-->
                            </div>
                        </div>
                        <!--end::Wizard Nav-->
                        <!--begin::Wizard Body-->
                        <div class="row justify-content-center my-5 px-8 my-lg-5 px-lg-10">
                            <div class="col-xl-12 col-xxl-7">
                                <!--begin::Wizard Form-->
                                <?php if (@$_GET['step'] == '' || @$_GET['step'] == 'payment') {
                                    include('lms-payment.php');
                                } elseif (@$_GET['step'] == 'profile') {
                                    include('lms-profile-details.php');
                                } elseif (@$_GET['step'] == 'academic') {
                                    include('lms-academic-details.php');
                                } elseif (@$_GET['step'] == 'document-upload') {
                                    include('lms-document-upload.php');
                                } else {
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