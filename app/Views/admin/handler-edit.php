<div class="row">

    <div class="col-xl-12">

        <div class="panel panel-inverse">

            <div class="panel-heading">
                <ol class="breadcrumb panel-title">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Counselors</a></li>
                    <li class="breadcrumb-item active">Edit Counselor</li>
                </ol>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                </div>

            </div>

            <div class="panel-body">
                <form action="" method="post">
                    <?= csrf_field() ?>
                    <fieldset>
                        <!-- <legend class="mb-3">Legend</legend> -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Counselor Name</label>
                                    <input class="form-control" type="text" placeholder="Enter Name" name="name" value="<?= old('name') ?? $handlerDetail['user_name'] ?>" required /><span class="form-text text-muted">Please enter Counselor name</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Email:</label>
                                    <input class="form-control" type="email" name="email" required placeholder="Enter email" value="<?= old('email') ?? $handlerDetail['user_email'] ?>" disabled /><span class="form-text text-muted">Please enter Your email</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Mobile No.</label>
                                    <input class="form-control" type="tel" name="mobile" required placeholder="Enter mobile" value="<?= old('mobile') ?? $handlerDetail['user_mobile'] ?>" disabled /><span class="form-text text-muted">Please enter Your mobile</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-select" name="role" required id="exampleSelect1">
                                        <option selected>--Select Role-- </option>
                                        <option value="0" <?= (old('role') ?? $handlerDetail['user_role']) == '0' ? 'selected' : null ?>>Handler</option>
                                        <option value="1" <?= (old('role') ?? $handlerDetail['user_role']) == '1' ? 'selected' : null ?>>Team leader</option>

                                    </select><span class="form-text text-muted">Please enter Counselor Role</span>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Counselor Status</label>
                                    <select class="form-select" name="status" required id="exampleSelect2">
                                        <option value="0" <?= (old('status') ?? $handlerDetail['user_status']) == '0' ? 'selected' : null ?>>Suspended</option>
                                        <option value="1" <?= (old('status') ?? $handlerDetail['user_status']) == '1' ? 'selected' : null ?>>Active</option>

                                    </select><span class="form-text text-muted">Please enter Counselor Status</span>

                                </div>
                            </div>
                            <?php if (session('formerror')) : ?>
                                <div class="col-lg-12 mx-auto">
                                    <style>
                                        .alert>.errors>ul {
                                            padding-inline-start: 5px;
                                        }
                                    </style>
                                    <div class="alert text-danger" style="background-color: transparent;border-color: transparent;margin: 0;padding: 0;">

                                        <?= session('formerror')->listErrors() ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div>
                                <button type="submit" name="btn" value="submit" class="btn btn-primary me-5px">Edit Counselor</button>
                            </div>
                        </div>
                    </fieldset>

                </form>
            </div>

        </div>

    </div>

</div>