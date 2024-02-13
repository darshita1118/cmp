<!--begin::Content-->
<style>
    .filter-option-inner-inner > img{width: 20px;}
    .dropdown-item > .text > img{
        width: 20px;
    }
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row mt-4 mx-0">
                <div class="col-lg-8 px-3">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form">Edit Lead</h4>

                        </div>
                        <div class="card-body">

                            <div class="row mx-0" id="account" aria-labelledby="account-tab" role="tabpanel">
                                <div class="col-md-12">

                                    <form method="post" action="<?= base_url('admin/lead-action/'.$profile_detail['lid']) ?>">
                                        <?= csrf_field() ?>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" for="firstname">First
                                                Name</label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input type="text" class="form-control form-control-lg form-control-solid" name="firstname" id="firstname" required="" value="<?= old('firstname') ?? $profile_detail['lead_first_name'] ?>" data-validation-required-message="This First Name field is required" placeholder="First Name">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" for="middlename">Middle
                                                Name</label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input type="text" class="form-control form-control-lg form-control-solid" name="middlename" id="middlename" placeholder="Middle Name" value="<?= old('middlename') ?? $profile_detail['lead_middle_name'] ?>" data-validation-required-message="This Middle Name field is required">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" for="lastname">Last
                                                Name</label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input type="text" class="form-control form-control-lg form-control-solid" name="lastname" id="lastname" placeholder="Last Name" value="<?= old('lastname') ?? $profile_detail['lead_last_name'] ?>" data-validation-required-message="This Last Name field is required">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" for="email">Email</label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input type="email" class="form-control form-control-lg form-control-solid" name="email" id="email" placeholder="Email" required="" value="<?= old('email') ?? $profile_detail['lead_email'] ?>" data-validation-required-message="This Email field is required">
                                                <div class="help-block"></div>
                                                <span>if Email is Not Available then use demo@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" for="mobile">Mobile
                                                No.</label>
                                            <div class="col-lg-9 col-xl-9">
                                            	<div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <select id="country_code" data-live-search="true" name="country_code" class="form-control form-control-lg form-control-solid" required="">
                                                                                <?php foreach($countries as $country): ?>
                                                                                    
                                                                                    <option  value="<?= $country['code'] ?>" <?= (old('country_code')??$profile_detail['lead_country_code']) == $country['code'] ? 'selected' : ($country['code'] == '+91'?'selected':null) ?>> (<?= $country['isoCode'] ?> ) <?= $country['code'] ?> </option>
                                                            			<?php endforeach; ?>
                                                                                
                                                                            </select>
                                                        </div>
                                                        <input type="text" class="form-control form-control-lg form-control-solid" name="mobile" id="mobile" placeholder="Mobile No." required="" value="<?= old('mobile') ?? $profile_detail['lead_mobile'] ?>" data-validation-required-message="This Mobile No. field is required">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                       
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" for="department">Department
                                            </label>
                                            <div class="col-lg-9 col-xl-9" id="getprogram">

                                                <select id="department" name="department" onchange="getProgramByDept(this.value)" class="form-control form-control-lg form-control-solid" required="">
                                                    <option value="">--Select A Desipline--</option>
                                                    <?php foreach($departments as $dept): ?>
                                                        <option value="<?= $dept['dept_id'] ?>" <?= (old('department')??$profile_detail['lead_department']) == $dept['dept_id'] ? 'selected' : null ?>><?= $dept['dept_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" for="programnameid">Interested
                                                Program</label>
                                            <div class="col-lg-9 col-xl-9" id="getprogram">

                                                <select id="programnameid" name="programe" class="form-control form-control-lg form-control-solid" required="">
                                                    <option value="">--Select A Programe--</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" for="status">Lead
                                                Status</label>
                                            <div class="col-lg-9 col-xl-9">
                                                <select  class="form-control form-control-lg form-control-solid" id="status" name="status" required="" onchange="getInfo($(this).find(':selected').attr('data-getinfo')
                                                ); getScore($(this).find(':selected').attr('data-statusscore')
                                                , 'status')">
                                                    <option value="">--Select--</option>
                                                    <?php foreach($statues as $status): ?>
                                                        <option data-statusscore='<?= $status['score'] ?>' data-getinfo='<?= $status['status_get_more_info'] ?>' value="<?= $status['status_id'] ?>" <?= (old('status')??$profile_detail['lead_status']) == $status['status_id'] ? 'selected' : null ?>><?= $status['status_name'] ?> </option>
                                                    <?php endforeach; ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div id='getExtraField'>
                                        <?php 
                                            
                                            $indexOfCurrentStatus = array_search($profile_detail['lead_status'],array_column($statues, 'status_id'));
                                            $statusGetInfoType = $statues[$indexOfCurrentStatus]['status_get_more_info'];
                                        ?>
                                        <?php if($statusGetInfoType): ?>
                                            <?php if($statusMessage): ?>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label" for="message">Message
                                                    </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input type="message" class="form-control form-control-lg form-control-solid" name="message" id="message" placeholder="Enter Your Message Here" value="<?= $statusMessage['message'] ?? '' ?>" required data-validation-required-message="This Message field is required">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($leadstatus) : ?>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label" for="message">Date & Time </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-xl-6">
                                                                <input type="date" class="form-control form-control-lg form-control-solid" name="date" id="date" value="<?= $leadstatus['ls_date'] ?? '' ?>" required>
                                                                <div class="help-block"></div>
                                                            </div>
                                                            <div class="col-lg-6 col-xl-6">

                                                                <input type="time" class="form-control form-control-lg form-control-solid" name="time" id="time" value="<?php if ($leadstatus['ls_time']) : $da = date("H:i", strtotime($leadstatus['ls_time'] ?? ''));
                                                                                                                                                                        endif;
                                                                                                                                                                        echo $da ?? ''; ?>" required>
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            <?php endif; ?>
                                       
                                        <?php endif; ?>
                                            
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" for="source">Lead
                                                Source</label>
                                            <div class="col-lg-9 col-xl-9">
                                                <select id='source' onchange="getScore($(this).find(':selected').attr('data-sourcescore')
                                                , 'source')" class="form-control form-control-lg form-control-solid" name="source" required="">
                                                    <option value="">--Select--</option>
                                                    <?php foreach($sources as $source): ?>
                                                        <option data-sourcescore='<?= $source['source_score'] ?>' value="<?= $source['source_id'] ?>" <?= (old('source')??$profile_detail['lead_source']) == $source['source_id'] ? 'selected' : null ?>><?= $source['source_name'] ?> </option>
                                                    <?php endforeach; ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" for="source">Lead
                                                Nationality</label>
                                            <div class="col-lg-9 col-xl-9">
                                                <select id='nationality' class="form-control form-control-lg form-control-solid" name="nationality" required="">
                                                    <option value="">--Select--</option>
                                                    <?php foreach($student_nationalities as $nation): ?>
                                                        <option value="<?= $nation['id'] ?>" <?= (old('nationality')??$profile_detail['lead_nationality']) == $nation['id'] ? 'selected' : null ?>><?= $nation['name'] ?> </option>
                                                    <?php endforeach; ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <?php if (session('formerror')) : ?>
                                            <fieldset>
                                                <div class="alert alert-danger">
                                                    <?= session('formerror')->listErrors() ?>
                                                </div>
                                            </fieldset>
                                        <?php endif; ?>

                                        
                                        <input type="hidden"  id='statusinfo' name="statusinfo" value="<?= old('statusinfo')??'0' ?>">
                                        <input type="hidden"  id='scorestatus' name="score[status]" value="<?= old('score')['status']??'0' ?>">
                                        <input type="hidden"  id='scoresource' name="score[source]" value="<?= old('score')['source']??'0' ?>">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mb-3">Edit Lead
                                            </button>
                                        </div>
                                    </form>
                                    <!-- users edit account form ends -->
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/custum.js') ?>" ></script>
	
<script>
    
    const base_url = `<?= base_url() ?>`

    <?php if(old('status')!==0 && old('statusinfo')): ?>
        getInfo('<?= old('statusinfo') ?>', '<?= old('message') ?>', '<?= old('date') ?>', '<?= old('time') ?>');
    <?php endif; ?>
    <?php if(old('department')??$profile_detail['lead_department']): ?>
        getProgramByDept('<?= old('department')??$profile_detail['lead_department'] ?>', '<?= old('programe')??$profile_detail['lead_programe'] ?>');
    <?php endif; ?>
</script>
</script>
<script>
	const $_SELECT_PICKER = $('#country_code');
    $_SELECT_PICKER.selectpicker();
</script>