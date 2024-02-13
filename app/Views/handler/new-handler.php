<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row mt-4 mx-0">
                <div class="col-lg-12 px-3">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">New Member</h3>

                        </div>
                        <!--begin::Form-->
                        <form class="form" method="post">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    
                                    <div class="col-lg-4">
                                        <label>Name:</label>
                                        <input type="text" class="form-control form-control-lg" name="name" required placeholder="Enter name" value="<?= old('name')?>">
                                        <span class="form-text text-muted">Please enter your name</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Email:</label>
                                        <input type="email" class="form-control form-control-lg" name="email" required placeholder="Enter email" value="<?= old('email')?>">
                                        <span class="form-text text-muted">Please enter your email</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Mobile:</label>
                                        <input type="tel" class="form-control form-control-lg" name="mobile" required placeholder="Enter mobile" value="<?= old('mobile')?>">
                                        <span class="form-text text-muted">Please enter your mobile</span>
                                    </div>
                                   
                                    
                                    <div class="col-lg-4">
                                        <label>Password:</label>
                                        <input type="password" class="form-control form-control-lg" name="password" value="<?= old('password')?>" required placeholder="Enter password">
                                        <span class="form-text text-muted">Please enter your password</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Status:</label>
                                        <select class="form-control form-control-lg" name="status" required id="exampleSelect2">
                                            <option value="">-- Select Status --</option>
                                            <option value="0" <?= old('status') == '0' ? 'selected' : null ?>>Suspended</option>
                                            <option value="1" <?= old('status') == '1' ? 'selected' : null ?>>Active</option>

                                        </select>
                                        <span class="form-text text-muted">Please enter handler role</span>
                                    </div>
                                    
                                    
                                    
                                </div>
                                <?php if (session('formerror')) : ?>
                                        <div class="col-lg-12 mx-auto">
                                            <style>
                                                .alert>.errors>ul{
                                                    padding-inline-start: 5px;
                                                }
                                            </style>
                                            <div class="alert text-danger" style="background-color: transparent;border-color: transparent;margin: 0;padding: 0;">
                                        
                                                <?= session('formerror')->listErrors() ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <div class="row">
                                    
                                    <div class="col-lg-12 mx-auto">
                                        <button type="submit" name="btn" value="submit" class="btn btn-primary mr-2">Submit</button>
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