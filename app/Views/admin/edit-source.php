<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row mt-4 mx-0">
                <div class="col-lg-12 px-3">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Edit Source</h3>

                        </div>
                        <!--begin::Form-->
                        <form class="form" method="post" action="">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    
                                    <div class="col-lg-6">
                                        <label for="name">Source Name:</label>
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Enter Source Name" value="<?= old('email') ?? $sourceDetail['source_name'] ?>">
                                        <span class="form-text text-muted" required>Please enter Source name</span>
                                    </div>
                                    
                                    
                                    <div class="col-lg-6">
                                        <label for="score">Status Score:</label>
                                        <input type="number" name="score" id="score" class="form-control form-control-lg" placeholder="Enter score" value="<?= old('score') ?? $sourceDetail['source_score'] ?>" required>
                                        <span class="form-text text-muted">Please enter score</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="status">Status Type:</label>
                                        <select class="form-control form-control-lg" id="status" name="status" required>
                                            <option value="">--Select Type--</option>
                                            <option value="1" <?= ((old('status')?? $sourceDetail['source_status']) == 1)?'selected':null ?>>Active</option>
                                            <option value="0" <?= ((old('status')?? $sourceDetail['source_status']) == '0')?'selected':null ?>>Dective</option>
                                            
                                        </select>
                                        <span class="form-text text-muted">Please enter status type</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="handler">Choose Handler:</label>
                                        <select class="form-control form-control-lg selectpicker" id="handler" data-placehodler="Choose handler" name="handler" data-live-search="true" >
                                            <option value="">Choose Handler</option>
                                            <?php foreach($handlers as $handler): ?>
                                            <option value="<?= $handler['id'] ?>" <?= ((old('handler')??($sourceDetail['handler_id']??'')) == $handler['id'])?'selected':null ?>><?= $handler['name'] ?>(<?= $handler['email'] ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="form-text text-muted">Please enter handler</span>
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
                                        <button type="submit" name="btn" value="edit-source" class="btn btn-primary mr-2">Submit</button>
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