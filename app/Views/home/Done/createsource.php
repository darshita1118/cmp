<?= $this->extend('index') ?>
<?= $this->section('content') ?>





<div class="row">

    <div class="col-xl-12">

        <div class="panel panel-inverse">

            <div class="panel-heading">
                <ol class="breadcrumb panel-title">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Lead Source</a></li>
                    <li class="breadcrumb-item active">Create Source</li>
                </ol>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                </div>

            </div>





            <div class="panel-body">
                <form action="/" method="POST">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Source Name</label>
                                    <input class="form-control" type="text" placeholder="Enter Status" /><span class="form-text text-muted">Please enter Source name</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Source Score</label>
                                    <input class="form-control" type="text" placeholder="Enter Source Score" /><span class="form-text text-muted">Please Enter Source Score</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Choose Counselor</label>
                                    <select class="form-select">...
                                        <option selected>--Select Counselor-- </option>
                                        <option value="1">Admin</option>
                                        <option value="2">Handler</option>

                                    </select><span class="form-text text-muted">Please Select Counselor</span>

                                </div>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary me-5px">Add Source</button>
                            </div>
                        </div>
                    </fieldset>

                </form>
            </div>

        </div>

    </div>

</div>




<?= $this->endSection() ?>