<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row mt-4 mx-0">
                <div class="col-lg-12 px-3">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Edit Status</h3>

                        </div>
                        <!--begin::Form-->
                        <form class="form" method="post" action="">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    
                                    <div class="col-lg-4">
                                        <label for="name">Status Name:</label>
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Enter Status Name" value="<?= old('email') ?? $statusDetail['status_name'] ?>">
                                        <span class="form-text text-muted" required>Please enter status name</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="type">Status Type:</label>
                                        <select class="form-control form-control-lg" id="type" name="type" required>
                                            <option value="">--Select Type--</option>
                                            <option value="1" <?= ((old('type')?? $statusDetail['status_type']) == 1)?'selected':null ?>>Show Handler</option>
                                            <option value="0" <?= ((old('type')?? $statusDetail['status_type']) == '0')?'selected':null ?>>Not Show</option>
                                            
                                        </select>
                                        <span class="form-text text-muted">Please enter status type</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="info">Status Info:</label>
                                        <select class="form-control form-control-lg" id="info" name="info" required>
                                            <option value="">--Select Info--</option>
                                            <option value="1" <?= ((old('info')?? $statusDetail['status_get_more_info']) == 1)?'selected':null ?> >Get Message </option>
                                            <option value="2" <?= ((old('info')?? $statusDetail['status_get_more_info']) == 2)?'selected':null ?>>Get Message and Time </option>
                                            <option value="0" <?= ((old('info')?? $statusDetail['status_get_more_info']) == '0')?'selected':null ?>>No Message</option>
                                        </select>
                                        <span class="form-text text-muted">Please enter status info</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="score">Status Score:</label>
                                        <input type="number" name="score" id="score" class="form-control form-control-lg" placeholder="Enter score" value="<?= old('score') ?? $statusDetail['score'] ?>" required>
                                        <span class="form-text text-muted">Please enter score</span>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                        <?php if (session('formerror')) : ?>
                                            <fieldset class="col-lg-12 mx-auto">
                                                <div class="alert alert-danger">
                                                    <?= session('formerror')->listErrors() ?>
                                                </div>
                                            </fieldset>
                                        <?php endif; ?>
                                    
                                    <div class="col-lg-12 mx-auto">
                                        <button type="submit" name="btn" value="edit-status" class="btn btn-primary mr-2">Submit</button>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>