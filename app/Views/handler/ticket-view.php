<?= $this->extend('index') ?>

<?= $this->section('content') ?>
<script src="<?= base_url('assets/js/jquery-3.6.4.min.js') ?>"></script>
<link href="<?= base_url('assets/plugins/tag-it/css/jquery.tagit.css') ?>" rel=" stylesheet">
<link href="<?= base_url('assets/plugins/summernote/dist/summernote-lite.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/summernote/dist/summernote-lite.min.js') ?>"></script>
<div class="mailbox-content">
    <div class="mailbox-content-header">

        <div class="btn-toolbar align-items-center">
            <div class="btn-group me-2">
                <a href="javascript:;" class="btn btn-white btn-sm"><i class="fa fa-fw fa-envelope"></i> <span class="hidden-xs">Send</span></a>
                <a href="javascript:;" class="btn btn-white btn-sm"><i class="fa fa-fw fa-paperclip"></i> <span class="hidden-xs">Attach</span></a>
            </div>
            <div>
                <a href="#" class="btn btn-white btn-sm" data-bs-toggle="dropdown"><i class="fa fa-fw fa-ellipsis-h"></i></a>
                <div class="dropdown-menu dropdown-menu-end position-fixed">
                    <a href="javascript:;" class="dropdown-item">Save draft</a>
                    <a href="javascript:;" class="dropdown-item">Show From</a>
                    <a href="javascript:;" class="dropdown-item">Check names</a>
                    <a href="javascript:;" class="dropdown-item">Switch to plain text</a>
                    <a href="javascript:;" class="dropdown-item">Check for accessibility issues</a>
                </div>
            </div>
            <div class="ms-auto">
                <a href="email_inbox.html" class="btn btn-white btn-sm"><i class="fa fa-fw fa-times"></i> <span class="hidden-xs">Discard</span></a>
            </div>
        </div>

    </div>
    <div class="mailbox-content-body">

        <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">

            <form action="/" method="POST" name="email_to_form" class="mailbox-form">

                <div class="mailbox-to">
                    <label class="control-label">To:</label>
                    <ul id="email-to" class="primary line-mode">
                        <li><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3755585843444345564777505a565e5b1954585a">[email&#160;protected]</a></li>
                        <li><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1b7c74747c777e5b7c767a727735787476">[email&#160;protected]</a></li>
                    </ul>
                    <div class="mailbox-float-link">
                        <a href="#" data-click="add-cc" data-name="Cc" class="me-5px">Cc</a>
                        <a href="#" data-click="add-cc" data-name="Bcc">Bcc</a>
                    </div>
                </div>

                <div data-id="extra-cc"></div>

                <div class="mailbox-subject">
                    <input type="text" class="form-control" placeholder="Subject">
                </div>


                <div class="mailbox-input">
                    <textarea class="summernote"></textarea>
                </div>

            </form>

        </div>

    </div>
    <div class="mailbox-content-footer d-flex align-items-center justify-content-end">
        <button type="submit" class="btn btn-white ps-40px pe-40px me-5px">Discard</button>
        <button type="submit" class="btn btn-primary ps-40px pe-40px">Send</button>
    </div>
</div>



<!-- <div class="mailbox">

    <div class="mailbox-sidebar">
        <div class="mailbox-sidebar-header d-flex justify-content-center">
            <a href="#emailNav" data-bs-toggle="collapse" class="btn btn-dark btn-sm me-auto d-block d-lg-none">
                <i class="fa fa-cog"></i>
            </a>
            <a href="email_compose.html" class="btn btn-dark ps-40px pe-40px btn-sm">
                Compose
            </a>
        </div>
        <div class="mailbox-sidebar-content collapse d-lg-block" id="emailNav">

            <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
                <div class="nav-title"><b>FOLDERS</b></div>
                <ul class="nav nav-inbox">
                    <li><a href="email_inbox.html"><i class="fa fa-hdd fa-lg fa-fw me-2"></i> Inbox <span class="badge bg-gray-600 fs-10px rounded-pill ms-auto fw-bolder pt-4px pb-5px px-8px">52</span></a></li>
                    <li><a href="email_inbox.html"><i class="fa fa-flag fa-lg fa-fw me-2"></i> Important</a></li>
                    <li><a href="email_inbox.html"><i class="fa fa-envelope fa-lg fa-fw me-2"></i> Sent</a></li>
                    <li><a href="email_inbox.html"><i class="fa fa-save fa-lg fa-fw me-2"></i> Drafts</a></li>
                    <li><a href="email_inbox.html"><i class="fa fa-trash-alt fa-lg fa-fw me-2"></i> Trash</a></li>
                </ul>

            </div>

        </div>
    </div>


    <div class="mailbox-content">
        <div class="mailbox-content-header">

            <div class="btn-toolbar align-items-center">
                <div class="btn-group me-2">
                    <a href="javascript:;" class="btn btn-white btn-sm"><i class="fa fa-fw fa-envelope"></i> <span class="hidden-xs">Send</span></a>
                    <input type="file" id="attachmentInput" style="display: none;" onchange="handleFileChange()">
                    <a href="#" class="btn btn-white btn-sm" onclick="openAttachmentInput()">
                        <i class="fa fa-fw fa-paperclip"></i> <span class="hidden-xs">Attach</span>
                    </a>
                </div>
                <div>
                    <a href="#" class="btn btn-white btn-sm" data-bs-toggle="dropdown"><i class="fa fa-fw fa-ellipsis-h"></i></a>
                    <div class="dropdown-menu dropdown-menu-end position-fixed">
                        <a href="javascript:;" class="dropdown-item">Save draft</a>
                        <a href="javascript:;" class="dropdown-item">Show From</a>
                        <a href="javascript:;" class="dropdown-item">Check names</a>
                        <a href="javascript:;" class="dropdown-item">Switch to plain text</a>
                        <a href="javascript:;" class="dropdown-item">Check for accessibility issues</a>
                    </div>
                </div>
                <div class="ms-auto">
                    <a href="email_inbox.html" class="btn btn-white btn-sm"><i class="fa fa-fw fa-times"></i> <span class="hidden-xs">Discard</span></a>
                </div>
            </div>

        </div>
        <div class="mailbox-content-body">

            <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">

                <form action="/" method="POST" name="email_to_form" class="mailbox-form">

                    <div class="mailbox-to">
                        <label class="control-label">To:</label>
                        <ul id="email-to" class="primary line-mode">
                            <li><a href="" class="">abc@gmail.com</a></li>
                            <li><a href="" class="">xyz@gmail.com</a></li>
                        </ul>
                        <div class="mailbox-float-link">
                            <a href="#" data-click="add-cc" data-name="Cc" class="me-5px">Cc</a>
                            <a href="#" data-click="add-cc" data-name="Bcc">Bcc</a>
                        </div>
                    </div>

                    <div data-id="extra-cc"></div>

                    <div class="mailbox-subject">
                        <input type="text" class="form-control" placeholder="Subject">
                    </div>


                    <div class="mailbox-input">
                        <textarea class="summernote" name="content"></textarea>
                    </div>

                </form>

            </div>

        </div>
        <div class="mailbox-content-footer d-flex align-items-center justify-content-end">
            <button type="submit" class="btn btn-white ps-40px pe-40px me-5px">Discard</button>
            <button type="submit" class="btn btn-primary ps-40px pe-40px">Send</button>
        </div>
    </div>

</div> -->
<script src="<?= base_url('assets/plugins/summernote/dist/summernote-lite.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-migrate/dist/jquery-migrate.min.js" ') ?>"></script>
<script src="<?= base_url('assets/plugins/tag-it/js/tag-it.min.js" ') ?>"></script>
<script src="<?= base_url('assets/plugins/summernote/dist/summernote-lite.min.js" ') ?>"></script>
<script src="<?= base_url('assets/js/demo/email-compose.demo.js" ') ?>"></script>
<script>
    $(".summernote").summernote({
        placeholder: 'Discription',
        height: "300"
    });
</script>
<script>
    function openAttachmentInput() {
        document.getElementById('attachmentInput').click();
    }

    function handleFileChange() {
        var fileInput = document.getElementById('attachmentInput');
        var selectedFile = fileInput.files[0];
        console.log("Selected File: ", selectedFile);
    }
</script>
<?= $this->endSection() ?>