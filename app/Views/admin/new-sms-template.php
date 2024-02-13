<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row mt-4 mx-0">
                <div class="col-lg-12 px-3">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">New SMS Template</h3>

                        </div>
                        <!--begin::Form-->
                        <form class="form" method="post" action="" >
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    
                                    <div class="col-lg-4">
                                        <label for="name">Template Name:</label>
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Enter Template Name" value="<?= old('name') ?? '' ?>" required>
                                        <span class="form-text text-muted" required>Please enter Template name</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="approved_id">Approved ID:</label>
                                        <input type="text" name="approved_id" id="approved_id" class="form-control form-control-lg" required placeholder="SMS Provider Approved Id" value="<?= old('approved_id') ?? '' ?>">
                                        <span class="form-text text-muted">SMS provider approve Id</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="type">Template Type:</label>
                                        <select class="form-control form-control-lg" id="type" name="type" required>
                                            <option value="">--Select Type--</option>
                                            <option value="1" <?= (old('type') == 1)?'selected':null ?> >Show Handler</option>
                                            
                                            <option value="0" <?= (old('type') == '0')?'selected':null ?>>System Email</option>
                                        </select>
                                        <span class="form-text text-muted">Please enter Template Type</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="parameters">Parameters:</label>
                                        
                                        <select name="parameter[]" id="parameter" class="form-control form-control-lg selectpicker" multiple required>
                                            <option value="">--Select--</option>
                                            <option value="name" <?= (in_array('name', old('parameter')??[]) !== false)?'selected':null ?> >Name</option>
                                            <option value="sid" <?= (in_array('sid', old('parameter')??[]) !== false)?'selected':null ?> >Sid</option>
                                            <option value="password" <?= (in_array('password', old('parameter')??[]) !== false)?'selected':null ?> >Password</option>
                                            <option value="link" <?= (in_array('link', old('parameter')??[]) !== false)?'selected':null ?> >Link</option>
                                        </select>
                                        <span class="form-text text-muted">Please enter Parameters</span>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label for="score">Score:</label>
                                        <input type="number" name="score" id="score" class="form-control form-control-lg" placeholder="Enter score" value="<?= old('score') ?? '' ?>" required>
                                        <span class="form-text text-muted">Please enter score</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="message">Message:</label>
                                        <input type="text" name="message" id="message" class="form-control form-control-lg" placeholder="Enter message" value="<?= old('message') ?? '' ?>" required>
                                        <span class="form-text text-muted">Please enter Message and maximum length 255 supported.</span>
                                    </div>
                                    
                                    
                                </div>
                                <div class="row">
                                        <?php if (session('formerror')) : ?>
                                            <fieldset class="col-lg-12 mx-auto">
                                                <div class="alert alert-danger">
                                                   <?php foreach(session('formerror') as $error): ?>
                                                    <li><?= $error ?></li>
                                                   <?php endforeach; ?>
                                                </div>
                                            </fieldset>
                                        <?php endif; ?>
                                    <div class="col-lg-12">
                                        <p>You Can use parameter in message by this example:-
                                            Hello {name} and your {sid} and {password} this and login on {link}
                                        </p>
                                    </div>
                                    
                                    <div class="col-lg-12 mx-auto">
                                        <button type="submit" name="btn" value="create-sms-template" class="btn btn-primary mr-2">Submit</button>
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
