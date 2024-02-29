<!-- Select CSS -->
<link href="<?= base_url() ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet" />

<div class="panel panel-inverse">

    <div class="panel-heading">
        <ol class="breadcrumb panel-title">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Leads</a></li>
            <li class="breadcrumb-item active">Create Lead</li>
        </ol>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
        </div>

    </div>

    <div class="panel-body">
        <form method="post" action="<?= base_url('handler/lead-action') ?>">
            <?= csrf_field() ?>
            <fieldset>
                <div class="row" id="newlead">
                    <div class="col-md-3 mb-3 mb-3">

                        <label class="form-label">First Name</label>
                        <input class="form-control" type="text" placeholder="Enter Name" name="firstname" value="<?= old('firstname') ?? '' ?>" required />

                    </div>
                    <div class="col-md-3 mb-3">

                        <label class="form-label">Middle
                            Name</label>
                        <input class="form-control" type="text" name="middlename" id="middlename" placeholder="Middle Name" value="<?= old('middlename') ?? '' ?>" />


                    </div>
                    <div class="col-md-3 mb-3">

                        <label class="form-label">Last
                            Name</label>
                        <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Last Name" value="<?= old('lastname') ?? '' ?>" />

                    </div>
                    <div class="col-md-3 mb-3">

                        <label class="form-label">Email:</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email" required="" value="<?= old('email') ?? '' ?>" />

                    </div>
                    <div class="col-md-3 mb-3">

                        <label class="form-label">Mobile No.</label>
                        <div class="input-group ">
                            <select class="input-group-text p-0" id="country_code" name="country_code" required="">
                                <?php foreach ($countries as $country) : ?>
                                    <option value="<?= $country['code'] ?>" <?= old('country_code') == $country['code'] ? 'selected' : ($country['code'] == '+91' ? 'selected' : null) ?>> (<?= $country['isoCode'] ?> ) <?= $country['code'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile No." required="" value="<?= old('mobile') ?? '' ?>" required data-validation-required-message="This Mobile No. field is required">

                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Department</label>
                        <div class="form-group"><select class="form-select default-select2" id="department" name="department" onchange="getProgramByDept(this.value)" required="">
                                <option value="">--Select A Disipline--</option>
                                <?php foreach ($departments as $dept) : ?>
                                    <option value="<?= $dept['dept_id'] ?>" <?= old('department') == $dept['dept_id'] ? 'selected' : null ?>><?= $dept['dept_name'] ?></option>
                                <?php endforeach; ?>
                            </select></div>

                    </div>


                    <div class="col-md-3 mb-3">

                        <label class="form-label">Program</label>
                        <select class="form-select default-select2" id="programnameid" name="programe" required="">
                            <option value="">--Select A Programe--</option>

                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Lead
                            Source</label>
                        <div> <select id='source' onchange="getScore($(this).find(':selected').attr('data-sourcescore')
                                                , 'source')" class="form-select default-select2" name="source" required="">
                                <option value="">--Select--</option>
                                <?php foreach ($sources as $source) : ?>
                                    <option data-sourcescore='<?= $source['source_score'] ?>' value="<?= $source['source_id'] ?>" <?= old('source') == $source['source_id'] ? 'selected' : null ?>><?= $source['source_name'] ?> </option>
                                <?php endforeach; ?>

                            </select></div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Lead Nationality</label>
                        <div><select id='nationality' class="form-select default-select2" name="nationality" required="">...
                                <option value="">--Select--</option>
                                <?php foreach ($student_nationalities as $nation) : ?>
                                    <option value="<?= $nation['id'] ?>" <?= old('nationality') == $nation['id'] ? 'selected' : null ?>><?= $nation['name'] ?> </option>
                                <?php endforeach; ?>

                            </select></div>

                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Lead Status</label>
                        <div><select class="form-select default-select2" id="status" name="status" required="" onchange="getInfo($(this).find(':selected').attr('data-getinfo')
                                                ); getScore($(this).find(':selected').attr('data-statusscore')
                                                , 'status')">
                                <option value="">--Select--</option>
                                <?php foreach ($statues as $status) : ?>
                                    <option data-statusscore='<?= $status['score'] ?>' data-getinfo='<?= $status['status_get_more_info'] ?>' value="<?= $status['status_id'] ?>" <?= old('status') == $status['status_id'] ? 'selected' : null ?>><?= $status['status_name'] ?> </option>
                                <?php endforeach; ?>
                            </select></div>


                    </div>
                    <div class="col-md-6">
                        <div class="row" id='getExtraField'>

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
                    <hr>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100px me-5px">Add Lead</button>
                    </div>
                </div>
            </fieldset>

        </form>
    </div>

</div>



<!-- Select2 JS -->
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<script src="<?= base_url() ?>assets/plugins/select-picker/dist/picker.min.js"></script>

<script>
    const base_url = `<?= base_url() ?>`;

    $(document).ready(function() {
        // Initialize Select2
        $(".default-select2").select2();

        // Initialize Select-Picker
        const $_SELECT_PICKER = $('#country_code');
        $_SELECT_PICKER.selectpicker();

        // Other Select-Picker initialization
        $('#department, #program, #status, #source, #nationality').picker({
            search: true
        });

        <?php if (old('status') !== 0 && old('statusinfo')) : ?>
            getInfo('<?= old('statusinfo') ?>', '<?= old('message') ?>', '<?= old('date') ?>', '<?= old('time') ?>');
        <?php endif; ?>

        <?php if (old('department')) : ?>
            getProgramByDept('<?= old('department') ?>', '<?= old('programe') ?>');
        <?php endif; ?>
    });
</script>

<script src="<?= base_url('assets/js/custum.js') ?>"></script>