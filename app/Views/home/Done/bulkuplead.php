<?= $this->extend('index') ?>
<?= $this->section('content') ?>





<div class="row">

    <div class="col-xl-12">

        <div class="panel panel-inverse">

            <div class="panel-heading">
                <ol class="breadcrumb panel-title">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Leads</a></li>
                    <li class="breadcrumb-item active">Bulk Upload Lead</li>
                </ol>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
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
                            <a target="_blank" class="btn btn-outline-primary btn-sm" href="#">Download CSV Template</a>
                        </li>
                    </ol>
                </div>

                <form action="/" method="POST">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">File Upload Here...</label>
                                    <input type="file" class="form-control" />
                                    <span class="form-text text-muted">Extension .csv allow only
                                    </span>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Lead source</label>
                                    <select class="form-select">...
                                        <option selected>--Select Source-- </option>
                                        <option value="1">Suspended</option>
                                        <option value="2">Active</option>

                                    </select><span class="form-text text-muted">Please select source</span>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Course: (Optional)</label>
                                    <select class="form-select">...
                                        <option selected>--Select Course-- </option>
                                        <option value="1">Suspended</option>
                                        <option value="2">Active</option>

                                    </select><span class="form-text text-muted">Please Select Course</span>

                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary w-100px me-5px">Add Lead</button>
                            </div>
                        </div>
                    </fieldset>

                </form>
            </div>

        </div>

    </div>

</div>




<?= $this->endSection() ?>