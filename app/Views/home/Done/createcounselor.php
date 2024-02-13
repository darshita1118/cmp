<?= $this->extend('index') ?>
<?= $this->section('content') ?>





<div class="row">

    <div class="col-xl-12">

        <div class="panel panel-inverse">

            <div class="panel-heading">
                <ol class="breadcrumb panel-title">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Counselors</a></li>
                    <li class="breadcrumb-item active">Create Counselor</li>
                </ol>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                </div>

            </div>





            <div class="panel-body">
                <form action="/" method="POST">
                    <fieldset>
                        <!-- <legend class="mb-3">Legend</legend> -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Counselor Name</label>
                                    <input class="form-control" type="text" placeholder="Enter Name" /><span class="form-text text-muted">Please enter Counselor name</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Email:</label>
                                    <input class="form-control" type="email" placeholder="Enter email" /><span class="form-text text-muted">Please enter Your email</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Mobile No.</label>
                                    <input class="form-control" type="tel" placeholder="Mobile No." /><span class="form-text text-muted">Please enter Your mobile</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select class="form-select">...
                                        <option selected>--Select Role-- </option>
                                        <option value="1">Admin</option>
                                        <option value="2">Handler</option>

                                    </select><span class="form-text text-muted">Please enter Counselor Role</span>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <select class="form-select">...
                                        <option selected>--Select-- </option>
                                        <option value="1">Suspended</option>
                                        <option value="2">Active</option>

                                    </select><span class="form-text text-muted">Please enter Counselor Password</span>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Counselor Status</label>
                                    <select class="form-select">...
                                        <option selected>--Select-- </option>
                                        <option value="1">Suspended</option>
                                        <option value="2">Active</option>

                                    </select><span class="form-text text-muted">Please enter Counselor Status</span>

                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary me-5px">Add Counselor</button>
                            </div>
                        </div>
                    </fieldset>

                </form>
            </div>

        </div>

    </div>

</div>




<?= $this->endSection() ?>