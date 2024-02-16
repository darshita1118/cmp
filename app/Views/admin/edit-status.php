<div class="row">

    <div class="col-xl-12">

        <div class="panel panel-inverse">

            <div class="panel-heading">
                <ol class="breadcrumb panel-title">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Lead Status</a></li>
                    <li class="breadcrumb-item active">Create Status</li>
                </ol>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                </div>

            </div>

            <div class="panel-body">
                <form action="" method="post">
                    <?= csrf_field() ?>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Status Name</label>
                                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter Status Name" value="<?= old('email') ?? $statusDetail['status_name'] ?>" /><span class=" form-text text-muted">Please enter status name</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Status Type:</label>
                                    <select class="form-select" id="type" name="type">
                                        <option selected>--Select Type-- </option>
                                        <option value="1" <?= ((old('type') ?? $statusDetail['status_type']) == 1) ? 'selected' : null ?>>Show Handler</option>
                                        <option value="0" <?= ((old('type') ?? $statusDetail['status_type']) == '0') ? 'selected' : null ?>>Not Show</option>

                                    </select><span class="form-text text-muted">Please enter status type</span>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Status Info:</label>
                                    <select class="form-select" id="info" name="info" required>
                                        <option selected>--Select Info-- </option>
                                        <option value="1" <?= ((old('info') ?? $statusDetail['status_get_more_info']) == 1) ? 'selected' : null ?>>Get Message </option>
                                        <option value="2" <?= ((old('info') ?? $statusDetail['status_get_more_info']) == 2) ? 'selected' : null ?>>Get Message and Time </option>
                                        <option value="0" <?= ((old('info') ?? $statusDetail['status_get_more_info']) == '0') ? 'selected' : null ?>>No Message</option>
                                    </select><span class="form-text text-muted">Please enter status info</span>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Status Score</label>
                                    <input class="form-control" type="number" name="score" id="score" placeholder="Enter score" value="<?= old('score') ?? $statusDetail['score'] ?>" required /><span class="form-text text-muted">Please enter Status Score</span>

                                </div>
                            </div>
                            <div class="row">
                                <?php if (session('formerror')) : ?>
                                    <fieldset class="col-lg-12 mx-auto">
                                        <div class="alert alert-danger">
                                            <?= session('formerror')->listErrors() ?>
                                        </div>
                                    </fieldset>
                                <?php endif; ?>


                                <div>
                                    <button type="submit" name="btn" value="edit-status" class="btn btn-primary me-5px">Edit Status</button>
                                </div>
                            </div>
                    </fieldset>

                </form>
            </div>

        </div>

    </div>

</div>