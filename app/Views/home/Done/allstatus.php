<?= $this->extend('index') ?>
<?= $this->section('content') ?>


<div class="row">

    <div class="col-xl-12">
        <div class="panel panel-inverse" data-sortable-id="table-basic-7">
            <div class="panel-heading">
                <ol class="breadcrumb panel-title">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Lead Status</a></li>
                    <li class="breadcrumb-item active">All Status</li>
                </ol>

                <div class="mb-1 me-2">
                    <span class="badge bg-green text-white">Total Status: 30</span>
                </div>

                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>

                </div>

            </div>


            <div class="panel-body" style="box-sizing: border-box; display: block;">

                <div class="table-responsive">
                    <table class="table table-striped mb-0 align-middle table-bordered">
                        <thead>
                            <tr>
                                <th>#S. No. </th>
                                <th>Status Name </th>
                                <th>Status Type </th>
                                <th>Status Info </th>
                                <th>Status Score </th>
                                <th width="1%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>Nicky Almera</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td nowrap="">
                                    <a href="#" class="btn btn-sm btn-primary me-1">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    2
                                </td>
                                <td>Edmund Wong</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td nowrap="">
                                    <a href="#" class="btn btn-sm btn-primary me-1">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    3
                                </td>
                                <td>Harvinder Singh</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td class="with-btn" nowrap="">
                                    <a href="#" class="btn btn-sm btn-primary me-1">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>


        </div>
    </div>
</div>


<?= $this->endSection() ?>