<div class="panel panel-inverse">

    <div class="panel-heading">
        <ol class="breadcrumb panel-title">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Counselors</a></li>
            <li class="breadcrumb-item active">Create Counselor</li>
        </ol>
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
                            <input class="form-control" type="text" placeholder="Enter Name" name="name" value="<?= old('name') ?>" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input class="form-control" type="email" name="email" required placeholder="Enter email" value="<?= old('email') ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Mobile No.</label>
                            <input class="form-control" type="tel" name="mobile" required placeholder="Enter mobile" value="<?= old('mobile') ?>" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" required id="exampleSelect1">
                                <option selected>--Select Role-- </option>
                                <option value="0" <?= old('role') == '0' ? 'selected' : null ?>>Handler</option>
                                <option value="1" <?= old('role') == '1' ? 'selected' : null ?>>Team leader</option>

                            </select>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input class="form-control" type="password" placeholder="Enter Name" name="password" value="<?= old('password') ?>" required placeholder="Enter password" />


                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Counselor Status</label>
                            <select class="form-select" name="status" required id="exampleSelect2">
                                <option selected>--Select-- </option>
                                <option value="0" <?= old('status') == '0' ? 'selected' : null ?>>Suspended</option>
                                <option value="1" <?= old('status') == '1' ? 'selected' : null ?>>Active</option>

                            </select>

                        </div>
                    </div>

                    <div>
                        <button type="submit" name="btn" value="submit" class="btn btn-primary me-5px">Add Counselor</button>
                    </div>
                </div>
            </fieldset>

        </form>
    </div>

</div>