<div class="panel panel-inverse">

    <div class="panel-heading">
        <ol class="breadcrumb panel-title">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Lead Source</a></li>
            <li class="breadcrumb-item active">Create Source</li>
        </ol>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
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
                            <input class="form-control" type="text" id="name" name="name" placeholder="Enter Status" value="<?= old('name') ?? '' ?>" /><span class="form-text text-muted">Please enter source same</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Source Score</label>
                            <input class="form-control" type="text" name="score" id="score" placeholder="Enter Source Score" value="<?= old('score') ?? '' ?>" required /><span class="form-text text-muted">Please enter source score</span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Choose Counsellor</label>
                            <select name="handler" id="handler" class="form-select">...
                                <option selected>--Select Counsellor-- </option>
                                <?php foreach ($handlers as $handler) : ?>
                                    <option value="<?= $handler['id'] ?>" <?= ((old('handler') ?? '') == $handler['id']) ? 'selected' : null ?>><?= $handler['name'] ?>(<?= $handler['email'] ?>)</option>
                                <?php endforeach; ?>
                            </select><span class="form-text text-muted">Please select counsellor</span>

                        </div>
                    </div>

                    <?php if (session('formerror')) : ?>
                        <fieldset class="col-lg-12 mx-auto">
                            <div class="alert alert-danger">
                                <?= session('formerror')->listErrors() ?>
                            </div>
                        </fieldset>
                    <?php endif; ?>
                    <hr>
                    <div class="text-center">

                        <button type="submit" name="btn" value="create-source" class="btn btn-primary me-5px">Add Source</button>
                    </div>
                </div>
            </fieldset>

        </form>
    </div>

</div>