<div class="panel panel-inverse">

    <div class="panel-heading">
        <ol class="breadcrumb panel-title">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Lead Status</a></li>
            <li class="breadcrumb-item active">Create Status</li>
        </ol>

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
                            <label class="form-label">Status Type:</label>
                            <select class="form-select" id="type" name="type" required>
                                <option selected>--Select Type-- </option>
                                <option value="1" <?= (old('type') == 1) ? 'selected' : null ?>>Show Handler</option>
                                <option value="0" <?= (old('type') == '0') ? 'selected' : null ?>>Not Show</option>
                            </select><span class="form-text text-muted">Select Status Type</span>


                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Status Info:</label>
                            <select class="form-select" id="info" name="info" required>
                                <option selected>--Select Info-- </option>
                                <option value="1" <?= (old('info') == 1) ? 'selected' : null ?>>Get Message </option>
                                <option value="2" <?= (old('info') == 2) ? 'selected' : null ?>>Get Message and Time </option>
                                <option value="0" <?= (old('info') == '0') ? 'selected' : null ?>>No Message</option>

                            </select><span class="form-text text-muted">Select status info</span>


                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Status Score</label>
                            <input class="form-control" type="number" name="score" id="score" placeholder="Enter score" value="<?= old('score') ?? '' ?>" required /><span class="form-text text-muted">Please Enter status score</span>


                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="submit" name="btn" value="create-status" class="btn btn-primary me-5px">Add Status</button>
                    </div>
                </div>
            </fieldset>

        </form>
    </div>

</div>