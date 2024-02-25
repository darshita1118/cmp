<div class="panel panel-inverse">

    <div class="panel-heading">
        <ol class="breadcrumb panel-title">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Leads</a></li>
            <li class="breadcrumb-item active">Edit Lead</li>
        </ol>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
        </div>

    </div>
    <div class="panel-body">
        <form action="<?= base_url('admin/lead-action/' . $profile_detail['lid']) ?>" method="post">
            <?= csrf_field() ?>
            <fieldset>
                <!-- <legend class="mb-3">Legend</legend> -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="firstname">First Name</label>
                            <input class="form-control" type="text" name="firstname" id="firstname" required="" value="<?= old('firstname') ?? $profile_detail['lead_first_name'] ?>" data-validation-required-message="This First Name field is required" placeholder="First Name" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="middlename">Middle Name</label>
                            <input class="form-control" type="text" name="middlename" id="middlename" placeholder="Middle Name" value="<?= old('middlename') ?? $profile_detail['lead_middle_name'] ?>" data-validation-required-message="This Middle Name field is required">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="lastname">Last Name</label>
                            <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Last Name" value="<?= old('lastname') ?? $profile_detail['lead_last_name'] ?>" data-validation-required-message="This Last Name field is required" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="email">Email:</label>
                            <input class="form-control" type="email" placeholder="Enter email" name="email" id="email" value="<?= old('email') ?? $profile_detail['lead_email'] ?>" required data-validation-required-message="This Email field is required" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Mobile No .</label>
                            <div class="input-group ">
                                <select class="input-group-text p-0" id="country_code" name="country_code" required>
                                    <?php foreach ($countries as $country) : ?>
                                        <option value="<?= $country['code'] ?>" <?= (old('country_code') ?? $profile_detail['lead_country_code']) == $country['code'] ? 'selected' : ($country['code'] == '+91' ? 'selected' : null) ?>> (<?= $country['isoCode'] ?> ) <?= $country['code'] ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                <input class="form-control" type="text" name="mobile" id="mobile" placeholder="Mobile No." value="<?= old('mobile') ?? $profile_detail['lead_mobile'] ?>" required data-validation-required-message="This Mobile No. field is required" />

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select class="form-select" id="department" name="department" onchange="getProgramByDept(this.value)" required="">
                                <option value="">--Select A Disipline--</option>
                                <?php foreach ($departments as $dept) : ?>
                                    <option value="<?= $dept['dept_id'] ?>" <?= (old('department') ?? $profile_detail['lead_department']) == $dept['dept_id'] ? 'selected' : null ?>><?= $dept['dept_name'] ?></option>
                                <?php endforeach; ?> ?>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="programnameid">Program</label>
                            <select id="programnameid" name="programe" class="form-select" required="">
                                <option value="">--Select A Programe--</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="status">Lead Status</label>
                            <select class="form-select" id="status" name="status" required="" onchange="getInfo($(this).find(':selected').attr('data-getinfo')
                                                ); getScore($(this).find(':selected').attr('data-statusscore')
                                                , 'status')">
                                <option value="">--Select--</option>
                                <?php foreach ($statues as $status) : ?>
                                    <option data-statusscore='<?= $status['score'] ?>' data-getinfo='<?= $status['status_get_more_info'] ?>' value="<?= $status['status_id'] ?>" <?= (old('status') ?? $profile_detail['lead_status']) == $status['status_id'] ? 'selected' : null ?>><?= $status['status_name'] ?> </option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                    <div>
                        <?php

                        $indexOfCurrentStatus = array_search($profile_detail['lead_status'], array_column($statues, 'status_id'));
                        $statusGetInfoType = $statues[$indexOfCurrentStatus]['status_get_more_info'];
                        ?>
                        <?php if ($statusGetInfoType) : ?>
                            <?php if ($statusMessage) : ?>
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
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" for="source">Lead Source</label>
                            <select id='source' onchange="getScore($(this).find(':selected').attr('data-sourcescore')
                                                , 'source')" class="form-select" name="source" required="">
                                <option value="">--Select--</option>
                                <?php foreach ($sources as $source) : ?>
                                    <option data-sourcescore='<?= $source['source_score'] ?>' value="<?= $source['source_id'] ?>" <?= (old('source') ?? $profile_detail['lead_source']) == $source['source_id'] ? 'selected' : null ?>><?= $source['source_name'] ?> </option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Lead Nationality</label>
                            <select id='nationality' class="form-select" name="nationality" required="">
                                <option value="">--Select--</option>

                                <?php foreach ($student_nationalities as $nation) : ?>
                                    <option value="<?= $nation['id'] ?>" <?= (old('nationality') ?? $profile_detail['lead_nationality']) == $nation['id'] ? 'selected' : null ?>><?= $nation['name'] ?> </option>
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
                    <input type="hidden" id='statusinfo' name="statusinfo" value="<?= old('statusinfo') ?? '0' ?>">
                    <input type="hidden" id='scorestatus' max name="score[status]" value="<?= old('score')['status'] ?? '0' ?>">
                    <input type="hidden" id='scoresource' name="score[source]" value="<?= old('score')['source'] ?? '0' ?>">
                    <div>
                        <button type="submit" class="btn btn-primary w-100px me-5px">Edit Lead</button>
                    </div>
                </div>
            </fieldset>

        </form>
    </div>

</div>

<script>
    function getProgramByDept(dept = '', prog = '') {
        if (dept !== '') {
            $.ajax({
                url: base_url + '/helper/get-program-by-dept',
                type: 'post',
                data: {
                    'deptm': dept
                },
                dataType: 'JSON',
                async: false,
                success: function(result) {
                    //console.log(result)
                    if (result.isOk == false) {
                        showFire('error', `Something Went Wrong`);
                    } else {
                        $('#programnameid').find('option').remove().end().append('<option value="">-- Select Program --</option>');
                        var programs = result.data
                        for (let i = 0; i < programs.length; i++) {
                            if (prog === programs[i].id) {
                                $('#programnameid').append($("<option/>", {
                                    value: programs[i].id,
                                    text: programs[i].name,
                                    selected: 'selected'
                                }));
                            } else {
                                $('#programnameid').append($("<option/>", {
                                    value: programs[i].id,
                                    text: programs[i].name,
                                }));
                            }

                        }
                        // remove selected option all 
                        // add --select-- option
                        // start for loop
                        // and append to program
                        console.log(result.data)
                    }
                },
                error: function() {
                    //console.log(result)
                    showFire(`error`, `Something Went Wrong on Server Side`);
                }

            });
        } else {
            $('#programnameid').find('option').remove().end().append('<option value="">-- Select Program --</option>');
        }

    }
</script>
<script>
    const base_url = `<?= base_url() ?>`

    <?php if (old('status') !== 0 && old('statusinfo')) : ?>
        getInfo('<?= old('statusinfo') ?>', '<?= old('message') ?>', '<?= old('date') ?>', '<?= old('time') ?>');
    <?php endif; ?>
    <?php if (old('department') ?? $profile_detail['lead_department']) : ?>
        getProgramByDept('<?= old('department') ?? $profile_detail['lead_department'] ?>', '<?= old('programe') ?? $profile_detail['lead_programe'] ?>');
    <?php endif; ?>
</script>
</script>
<script>
    const $_SELECT_PICKER = $('#country_code');
    $_SELECT_PICKER.selectpicker();
</script>