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
                                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter Status Name" value="<?= old('name') ?? '' ?>" /><span class="form-text text-muted">Please enter Status name</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Status Type</label>
                                    <input class="form-control" type="text" placeholder="Enter Status Type" /><span class="form-text text-muted">Please enter Status Type</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Status Info:</label>
                                    <select class="form-select">...
                                        <option selected>--Select Info-- </option>
                                        <option value="1" <?= (old('info') == 1) ? 'selected' : null ?>>Get Message </option>
                                        <option value="2" <?= (old('info') == 2) ? 'selected' : null ?>>Get Message and Time </option>
                                        <option value="0" <?= (old('info') == '0') ? 'selected' : null ?>>No Message</option>

                                    </select><span class="form-text text-muted">Please enter status info</span>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Status Score</label>
                                    <input class="form-control" type="number" name="score" id="score" placeholder="Enter score" value="<?= old('score') ?? '' ?>" required /><span class="form-text text-muted">Please enter Status Score</span>

                                </div>
                            </div>


                            <div>
                                <button type="submit" name="btn" value="create-status" class="btn btn-primary me-5px">Add Status</button>
                            </div>
                        </div>
                    </fieldset>

                </form>
            </div>

        </div>

    </div>

</div>