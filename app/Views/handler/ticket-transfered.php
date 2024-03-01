<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<link href="<?= base_url('assets/plugins/summernote/dist/summernote-lite.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/summernote/dist/summernote-lite.min.js') ?>"></script>
<style>
    @media (min-width: 992px) {
        .mailbox .mailbox-content {
            max-width: 100%;
            border-left: 1px solid var(--bs-component-border-color);
        }
    }

    /* Style for the hidden div */
    #reply {
        display: none;
        border: 1px solid #e1e3e1;
        -moz-border-radius: 16px;
        border-radius: 16px;
        box-sizing: border-box;
        transition: border .15s cubic-bezier(0.4, 0, 0.2, 1), box-shadow .15s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 20px;
        background-color: #f0f0f0;
        position: relative;
        margin: 20px;
    }

    .closeButton {
        cursor: pointer;
        color: #888;
        float: right;
        right: 20px;
        font-size: 30px;
        font-weight: bold;
        position: absolute;
        top: 0;
        border-bottom: 1px solid #ececec;
    }
</style>
<div class="row">
    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-title">
                    <ol class="breadcrumb ">
                        <li><i class="fa-solid fa-square-caret-left btn btn-lg"></i></li>
                        <li class="breadcrumb-item active"><i class="fa-solid fa-ticket "></i> 112246 - Fees paid twice by mistake </li>
                    </ol>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="">
                            <!--Ticket Information-->
                            <div class="card ">
                                <h5 class="font-weight-bolder card-header">Ticket Information</h5>

                                <div class="card-body px-2 py-2">
                                    <div class="border-bottom py-2">
                                        <p class="mb-1">Requestor</p>
                                        <b class="fw-bolder">FATEMA GHADIYALI<br>SID - 2346249</b>
                                    </div>
                                    <div class="border-bottom py-2">
                                        <p class="mb-1">Title Type</p>
                                        <b class="fw-bolder">Fee Payment</b>
                                    </div>
                                    <div class="border-bottom py-2">
                                        <p class="mb-1">Receiving Type</p>
                                        <b class="fw-bolder">CC</b>
                                    </div>
                                    <div class="border-bottom py-2">
                                        <p class="mb-1"> Status/Priority</p>
                                        <span class=" text-warning"><b> Open</b></span><b class="fw-bolder">&nbsp;/&nbsp;Low</b>
                                    </div>
                                    <div class="py-2">
                                        <p class="mb-1">Submitted</p>
                                        <b class="fw-bolder">28 Feb 2024 02:58 PM</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 ">
                        <!--mailbox-->
                        <div class="card mailbox">
                            <div class="mailbox-content">
                                <div class="mailbox-content-header">
                                    <div class="btn-toolbar">
                                        <div class="btn-group ">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                                </svg><span class="ms-3 fw-bolder">User[ Name of Clint]</span><span class="ms-3"><i class="fa fa-clock fa-fw"></i> Today, 8:30 AM</span></div>
                                        </div>

                                        <div class="btn-group ms-auto me-2">
                                            <div class="btn-group me-2">
                                                <a href="javascript:;" class="btn btn-white btn-sm" id="showDivButton"><i class="fa fa-fw fa-reply "> </i><span class="d-none d-lg-inline">Reply</span></a>
                                            </div>
                                            <div class="btn-group me-2">
                                                <a href="#transfer" class="btn btn-white btn-sm" data-bs-toggle="modal"> <span class="d-none d-lg-inline">Transfer</span><i class="fa fa-fw fa-right-from-bracket"></i></a>
                                            </div>
                                            <div class="btn-group me-2">
                                                <a href="javascript:;" class="btn btn-white btn-sm"><i class="fa fa-fw fa-trash"></i> <span class="d-none d-lg-inline">Delete</span></a>
                                                <a href="javascript:;" class="btn btn-white btn-sm"><i class="fa fa-fw fa-archive"></i> <span class="d-none d-lg-inline">Archive</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mailbox-content-body">
                                    <div id="reply">
                                        <span class="closeButton" id="closeDiv"><i class="fa fa-trash-can fs-4"></i></span>
                                        <!-- Content inside the div -->

                                        <div class="col-md-12  mb-3">
                                            <label class="form-label" require>Priority</label>
                                            <select class="form-select">
                                                <option selected>--Select-- </option>
                                                <option value="1">Low</option>
                                                <option value="2">Medium</option>
                                                <option value="3">High</option>
                                            </select>
                                        </div>
                                        <label for="" require><b>Description</b></label>
                                        <div class="summernote" name="content"></div>
                                        <div class="col-md-12 ">
                                            <p class="text-primary pt-3">Attachment (Max. size 500 kb for image file and 2 mb for pdf file.)</p>
                                            <div class="d-flex"> <input type="file" class="form-control " /> <button class="btn btn-white ms-3 ">Submit</button><button class="btn btn-primary ms-3 " id="closeDiv">Cancle</button>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="mailbox-content-header p-3">
                                        <p class="text-dark">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel auctor nisi, vel auctor orci. <br>
                                            Aenean in pretium odio, ut lacinia tellus. Nam sed sem ac enim porttitor vestibulum vitae at erat.
                                        </p>
                                        <p class="text-dark">
                                            Curabitur auctor non orci a molestie. Nunc non justo quis orci viverra pretium id ut est. <br>
                                            Nullam vitae dolor id enim consequat fermentum. Ut vel nibh tellus. <br>
                                            Duis finibus ante et augue fringilla, vitae scelerisque tortor pretium. <br>
                                            Phasellus quis eros erat. Nam sed justo libero.
                                        </p>
                                        <p class="text-dark">
                                            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br>
                                            Sed tempus dapibus libero ac commodo.
                                        </p>
                                        <br>
                                        <br>
                                        <p class="text-dark">
                                            Best Regards,<br>
                                            kriti.<br><br>
                                            Information Technology Department,<br>
                                            Senior Front End Designer<br>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <!--end mailbox-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="transfer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Transfer Ticket</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12  mb-3">
                            <label class="form-label">To desk</label>
                            <select name="to" class="form-select" required="">
                                <option value="">---Select---</option>
                                <option value="1-2">Scrutinizer</option>
                                <option value="2-2">Senior</option>
                                <option value="4-2">Verification</option>
                                <option value="5-2">Enrollment</option>
                                <option value="7-2">Lms</option>
                                <option value="8-2">Dean-academic</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="" type="Submit" class="btn btn-success">Submit</a>

                    </div>
                </div>
            </div>
        </div>
        <script>
            // jQuery code to open the div on button click
            $(document).ready(function() {
                $("#showDivButton").click(function() {
                    $("#reply").show();
                });

                $("#closeDiv").click(function() {
                    $("#reply").hide();
                });
            });
            $(".summernote").summernote({
                placeholder: 'Discription',
                height: "100"
            });
        </script>