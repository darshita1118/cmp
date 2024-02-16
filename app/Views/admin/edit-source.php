<div class="row">

    <div class="col-xl-12">

        <div class="panel panel-inverse">

            <div class="panel-heading">
                <ol class="breadcrumb panel-title">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Lead Source</a></li>
                    <li class="breadcrumb-item active">Edit Source</li>
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
                                    <label class="form-label">Source Name</label>
                                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter Source Name" value="<?= old('email') ?? $sourceDetail['source_name'] ?>" /><span class="form-text text-muted">Please enter Source name</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Source Score</label>
                                    <input class="form-control" type="number" name="score" id="score" placeholder="Enter Source Score" value="<?= old('score') ?? $sourceDetail['source_score'] ?>" required /><span class="form-text text-muted">Please Enter Source Score</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Status Type</label>
                                    <select id="status" name="status" class="form-select" required>
                                        <option selected>--Select Status Type-- </option>
                                        <option value="1" <?= ((old('status') ?? $sourceDetail['source_status']) == 1) ? 'selected' : null ?>>Active</option>
                                        <option value="0" <?= ((old('status') ?? $sourceDetail['source_status']) == '0') ? 'selected' : null ?>>Dective</option>
                                    </select><span class="form-text text-muted">Please Select Status Type</span>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Choose Counsellor</label>
                                    <select name="handler" id="handler" class="form-select">
                                        <option value="">Choose Handler</option>
                                        <?php foreach ($handlers as $handler) : ?>
                                            <option value="<?= $handler['id'] ?>" <?= ((old('handler') ?? ($sourceDetail['handler_id'] ?? '')) == $handler['id']) ? 'selected' : null ?>><?= $handler['name'] ?>(<?= $handler['email'] ?>)</option>
                                        <?php endforeach; ?>
                                    </select><span class="form-text text-muted">Please Select Counsellor</span>

                                </div>
                            </div>
                            <?php if (session('formerror')) : ?>
                                <fieldset class="col-lg-12 mx-auto">
                                    <div class="alert alert-danger">
                                        <?= session('formerror')->listErrors() ?>
                                    </div>
                                </fieldset>
                            <?php endif; ?>


                            <div>

                                <button type="submit" name="btn" value="edit-source" class="btn btn-primary me-5px">Edit Source</button>
                            </div>
                        </div>
                    </fieldset>

                </form>
            </div>

        </div>

    </div>

</div>