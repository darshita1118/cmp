<!-- Select CSS -->
<link href="<?= base_url() ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet" />

<div class="panel panel-inverse">
    <div class="panel-heading">
        <ol class="breadcrumb panel-title">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Leads</a></li>
            <li class="breadcrumb-item active">Bulk Upload Lead</li>
        </ol>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
        </div>

    </div>

    <div class="panel-body">
        <div class="alert alert-info alert-dismissible rounded-0 mb-2 fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert">
            </button>
            <ol>
                <li>Required Feilds
                    <ul>
                        <li>firstname</li>
                        <li>mobile</li>
                        <li>mobile_code (default is +91)</li>
                        <li>email if email is not present then use demo@gmail.com</li>
                    </ul>
                </li>
                <li>Not requied feilds
                    <ul>
                        <li>lastname</li>
                        <li>middlename</li>

                    </ul>
                </li>
                <li>
                    <a target="_blank" class="btn btn-outline-primary btn-sm" href="<?= base_url('assets/csv-template.csv') ?>">Download CSV Template</a>
                </li>
            </ol>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="csvfile" class="form-label">File Upload Here...</label>
                            <input type="file" name="csvfile" id="csvfile" class="form-control" required />
                            <span class="form-text text-muted">Extension .csv allow only
                            </span>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="source">Lead source</label>
                            <select class="form-select" id="source" name="source" required>
                                <option selected>--Select Source-- </option>
                                <?php foreach ($sources as $row) : ?>
                                    <option data-score='<?= $row['source_score'] ?>' value="<?= $row['source_id'] ?>"><?= $row['source_name'] ?></option>
                                <?php endforeach; ?>

                            </select><span class="form-text text-muted">Please select source</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="course" class="form-label">Course: (Optional)</label>
                            <select onchange="$('#department').val($(this).find(':selected').attr('data-dept'));" class="form-select" id="course" name="course">
                                <option selected>--Select Course-- </option>
                                <?php foreach ($courses as $row) : ?>
                                    <option data-dept="<?= $row['dept_id'] ?>" value="<?= $row['coi_id'] ?>"><?= $row['course_name'] ?></option>
                                <?php endforeach; ?>

                            </select><span class="form-text text-muted">Please Select Course</span>

                        </div>
                    </div>
                    <input type="hidden" name="department" value="<?= set_value('department') ?? '' ?>" id="department">
                    <div class="text-center">
                        <button type="submit" name="btn" value="upload-lead" class="btn btn-primary w-100px me-5px">Submit</button>
                    </div>
                </div>
            </fieldset>

        </form>
        <?php if (session('formerror')) : ?>
            <div class="row">
                <fieldset class="col-lg-12 mx-auto">
                    <div class="alert alert-danger">
                        <?php foreach (session('formerror') as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
            </div>
        <?php endif; ?>

    </div>

</div>

<!-- Select2 JS -->
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<script src="<?= base_url() ?>assets/plugins/select-picker/dist/picker.min.js"></script>


<script>
    // Other Select-Picker initialization
    $('#source, #course').picker({
        search: true
    });
</script>