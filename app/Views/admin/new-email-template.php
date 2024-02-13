<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row mt-4 mx-0">
                <div class="col-lg-12 px-3">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">New Email Template</h3>

                        </div>
                        <!--begin::Form-->
                        <form class="form" method="post" action="" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="form-group row">
                                    
                                    <div class="col-lg-4">
                                        <label for="name">Template Name:</label>
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Enter Template Name" value="<?= old('name') ?? '' ?>" required>
                                        <span class="form-text text-muted" required>Please enter Template name</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="template">Template File:</label>
                                        <input type="file" name="template" id="template" class="form-control form-control-lg" required>
                                        <span class="form-text text-muted">Extension .php allow only</span>
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
                                        <label for="have_attachment">Have Attachment:</label>
                                        <select class="form-control form-control-lg" id="have_attachment" name="have_attachment" onchange="getAttachmentFeild(this.value);getAttachmentname(this.value);" required>
                                            <option value="">--Select Attachment--</option>
                                            <option value="1" <?= (old('have_attachment') == 1)?'selected':null ?>>Yes</option>
                                            <option value="0" <?= (old('have_attachment') == '0')?'selected':null ?>>No</option>
                                            
                                        </select>
                                        <span class="form-text text-muted">Please enter Have Attachment</span>
                                    </div>
                                    <div class="" id="attachmentfield">
                                        
                                    </div>
                                    <div class="" id="attachmentname">
                                        
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="score">Score:</label>
                                        <input type="number" name="score" id="score" class="form-control form-control-lg" placeholder="Enter score" value="<?= old('score') ?? '' ?>" required>
                                        <span class="form-text text-muted">Please enter score</span>
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
                                        
                                    
                                    <div class="col-lg-12 mx-auto">
                                        <button type="submit" name="btn" value="create-email-template" class="btn btn-primary mr-2">Submit</button>
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
<script>
    function getAttachmentFeild(params){
        if(params == 1){
            $('#attachmentfield').html(`
                                            <label for="attachment">Attachment</label>
                                            <input type="file" name="attachment" id="attachment" class="form-control form-control-lg" required>
                                            <span class="form-text text-muted">Upload Template file</span>
                                       `).addClass('col-lg-4')
        }else{
            $('#attachmentfield').html(``).removeClass('col-lg-4');
        }
    }
    function getAttachmentname(params){
        if(params == 1){
            $('#attachmentname').html(`
                                            <label for="attachment_name">Attachment Name</label>
                                            <input type="text" name="attachment_name" id="attachment_name" class="form-control form-control-lg" required placeholder="Enter file name " value="<?= old('attachment_name') ?? '' ?>">
                                            <span class="form-text text-muted">Enter file name that show when mail send</span>
                                       `).addClass('col-lg-4')
        }else{
            $('#attachmentname').html(``).removeClass('col-lg-4');
        }
    }
    <?php if(old('have_attachment') == 1): ?>
        getAttachmentFeild(<?= old('have_attachment') ?>)
        getAttachmentname(<?= old('have_attachment') ?>)
    <?php endif; ?>

</script>