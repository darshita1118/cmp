
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid ">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-body p-0">

                    <!--begin::Wizard-->
                    <div class="wizard wizard-1 " id="kt_wizards" data-wizard-state="step-first" data-wizard-clickable="false">
                        <!--begin::Wizard Nav-->
                        <div class="wizard-nav border-bottom py-2 ">
                            <div class="wizard-steps flex-row ">

                                <?php $count=1; foreach($formSteps as $step): ?>
                                    
                                    <?php if($availablePosition >= $step['position']): ?>
                                        <?php if(in_array($step['position'], [1,2,3]) !== false): ?>
                                            <?php if($step['position'] == $currentPosition): ?>
                                                <div class="wizard-step wizard_clip_active" >
                                                    <div class="wizard-label">
                                                        <h3 class="wizard-title d-flex"><?= $count++; ?>.<span class="d-none d-lg-flex">&nbsp;<a style="color:#fff" href="<?= base_url($route.$lid.'/'.$sid.'/'.$step['slug']) ?>"><?= $step['fs_name'] ?></a></span></h3>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="wizard-step wizard_clip_success" >
                                                    <div class="wizard-label">
                                                        <h3 class="wizard-title d-flex"><?= $count++; ?>.<span class="d-none d-lg-flex">&nbsp;<a style="color:#fff" href="javascript:showFire('info', 'This Form Step has been lock.')"><?= $step['fs_name'] ?></a></span></h3>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            
                                        <?php else: ?>
                                            <div class="wizard-step <?= $step['position'] == $currentPosition?'wizard_clip_active':'wizard_clip_success' ?>" >
                                                <div class="wizard-label">
                                                    <h3 class="wizard-title d-flex"><?= $count++; ?>.<span class="d-none d-lg-flex">&nbsp;<a style="color:#fff" href="<?= base_url($route.$lid.'/'.$sid.'/'.$step['slug']) ?>"><?= $step['fs_name'] ?></a></span></h3>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                    <?php else: ?>
                                        <div class="wizard-step wizard_clip_unprogress" style="cursor: not-allowed !important;" >
                                            <div class="wizard-label">
                                                <h3 class="wizard-title d-flex"><?= $count++; ?>.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="javascript:showFire('error', 'This Form Step not available')"><?= $step['fs_name'] ?></a></span></h3>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <?php /*
                                
                                <!--begin::Wizard Step 2 Nav-->
                                
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">2.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="<?= base_url($route.$lid.'/'.$sid.'/academic-detail') ?>">Academic Details</a></span></h3>
                                    </div>
                                </div>
                                <!--end::Wizard Step 3 Nav-->
                                <!--begin::Wizard Step 4 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">3.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="<?= base_url($route.$lid.'/'.$sid.'/document-upload') ?>">Documents Upload</a></span></h3>
                                    </div>
                                </div>
                                <!--end::Wizard Step 4 Nav-->
                                <!--begin::Wizard Step 5 Nav-->
                                <div class="wizard-step wizard_clip_unprogress">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title d-flex">4.<span class="d-none d-lg-flex">&nbsp;<a style="color:#000" href="<?= base_url($route.$lid.'/'.$sid.'/review') ?>">Review and Submit</a></span></h3>
                                    </div>
                                </div>
                                <!--end::Wizard Step 5 Nav-->
                                */ 
                                ?>
                            </div>
                        </div>
                        <!--end::Wizard Nav-->
                        <!--begin::Wizard Body-->
                        <div class="row justify-content-center my-5 px-8 my-lg-5 px-lg-10">
                            <div class="col-xl-12 col-xl-12">
                                <!--begin::Wizard Form-->
                                <?= $this->include($formView); ?>
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