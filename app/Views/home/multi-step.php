<?= $this->extend('index') ?>
<?= $this->section('content') ?>
<!-- Include jQuery -->
<script src="<?= base_url('assets/js/jquery-3.6.4.min.js') ?>"></script>
<!-- date -->
<link href=" <?= base_url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') ?>" rel="stylesheet" />
<script src=" <?= base_url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') ?>"></script>
<!-- drop down -->
<link href="<?= base_url('assets/plugins/select2/dist/css/select2.min.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<style>
    .form-step {
        /* pointer-events: none;
        opacity: 0.5; */
        display: none;
    }

    .form-step.active {
        display: block;
    }

    button {
        margin-top: 10px;
    }
</style>

<div class="row ">
    <div class="col-md-2">
        <nav class="navbar navbar-sticky d-none d-xl-block  py-4 h-100 text-end">
            <nav class="nav">
                <a class="nav-link active" href="#payment">Payment</a>
                <a class="nav-link" href="#counseling">Counseling</a>
                <a class="nav-link" href="#exam">Entrance Exam
                </a>
                <a class="nav-link" href="#person">Personal Details
                </a>
                <a class=" nav-link" href="#academic">Academic Details</a>
                <a class="nav-link" href="#upload">Document Upload</a>
            </nav>
        </nav>
    </div>
    <div class="col-xl-9 py-4">
        <!--1. Application Payment: -->
        <div id="payment" class="form-step active  ">
            <div class="card border-0 mb-4">
                <div class="card-header bg-none p-3 h3 m-0 ">
                    <i class="fa fa-shopping-bag fa-lg me-2 text-gray text-opacity-50"></i>
                    1. Application Payment
                </div>
                <div class="card-body p-3 text-dark fw-bold border-bottom">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">Discipline:</label>
                            <select class="form-select">
                                <option selected>--Select-- </option>
                                <option value="1">B.Com</option>
                                <option value="2">BBA</option>
                                <option value="3">MBA</option>

                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Program</label>
                            <select class="default-select2 form-control">
                                <option selected>--Select Program-- </option>
                                <optgroup label="Enginnering">
                                    <option value="AK">B.Tech</option>
                                    <option value="HI">M.Tech</option>
                                </optgroup>
                                <optgroup label="Management">
                                    <option value="CA">BBA</option>
                                    <option value="NV">MBA</option>

                                </optgroup>
                                <optgroup label="Health Care">
                                    <option value="CA">B.Physiotherphy</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Select Course Specialization/Honour's:</label>
                            <select class="default-select2 form-control">

                                <option selected>--Select Role-- </option>
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>

                            </select>
                        </div>
                    </div>

                </div>
                <div class="p-2  ms-auto ">
                    <a href="#" class="btn btn-primary " onclick="nextStep()">Next</a>
                </div>
            </div>
        </div>
        <!-- 2. Career Counseling-->
        <div id="counseling" class="form-step ">
            <div class="card border-0  mb-4">
                <div class="card-header bg-none p-3 h3 m-0 d-flex align-items-center">
                    <i class="fa fa-credit-card fa-lg me-2 text-gray text-opacity-50"></i>
                    2. Career Counseling
                </div>

                <div class="card-body  border-bottom pb-4">
                    <div class="alert alert-primary rounded-0 d-flex align-items-center mb-0">
                        <div class="fs-24px w-80px text-center">
                            <i class="fa fa-note-sticky fa-2x"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h3>Demo Notes</h3>
                            <ul class="ps-3 mb-1">
                                <li>The maximum file size for uploads in this demo is <strong>5 MB</strong> (default
                                    file size is unlimited).</li>
                                <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by
                                    default there is no file type restriction).</li>
                                <li>Uploaded files will be deleted automatically after <strong>5 minutes</strong> (demo
                                    setting).</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 m-auto pt-4">
                        <div class="input-group">
                            <label for="" class="h4 me-5">Set Schedual</label>
                            <input type="text" class="form-control" id="datepicker-timeSedual" />
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class=" d-flex p-2 ">
                    <a href="#" class="btn btn-default m-auto me-3 " onclick="prevStep()">Privious</a>
                    <a href="#" class="btn btn-primary " onclick="nextStep()">Next</a>
                </div>
            </div>
        </div>
        <!-- 3.Entrance Exam -->
        <div id="exam" class="form-step ">
            <div class="card border-0 mb-4 pb-3">
                <div class="card-header bg-none p-3 h3 m-0 d-flex align-items-center">
                    <i class="fa fa-shopping-bag fa-lg me-2 text-gray text-opacity-50"></i>
                    3.Entrance Exam
                </div>
                <div class="card-body p-3 text-dark fw-bold border-bottom pb-4">

                    <div class="alert alert-primary rounded-0 d-flex align-items-center mb-0">
                        <div class="fs-24px w-80px text-center">
                            <i class="fa fa-lightbulb fa-2x"></i>
                        </div>
                        <div class="flex-1 ms-3">
                            <h3>Demo Notes</h3>
                            <ul class="ps-3 mb-1">
                                <li>The maximum file size for uploads in this demo is <strong>5 MB</strong> (default
                                    file size is unlimited).</li>
                                <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by
                                    default there is no file type restriction).</li>
                                <li>Uploaded files will be deleted automatically after <strong>5 minutes</strong> (demo
                                    setting).</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class=" d-flex p-2 ">
                    <a href="#" class="btn btn-default m-auto me-3 " onclick="prevStep()">Privious</a>
                    <a href="#" class="btn btn-primary " onclick="nextStep()">Next</a>
                </div>
            </div>
        </div>
        <!--4. Personal Details -->
        <div id="person" class="form-step ">
            <div class="card border-0 mb-4 pb-3">
                <div class="card-header bg-none p-3 h3 m-0 d-flex align-items-center">
                    <i class="fa fa-shopping-bag fa-lg me-2 text-gray text-opacity-50"></i>
                    4. Person Detail
                </div>

                <div class="card-body p-3 text-dark fw-bold border-bottom pb-4">
                    <div class=" p-md-3">
                        <ul class="nav nav-pills mb-2 justify-content-center">
                            <li class="nav-item">
                                <a href="#person-detail" data-bs-toggle="tab" class="nav-link active">
                                    <span class="d-sm-none">Person Detail</span>
                                    <span class="d-sm-block d-none">Person Detail</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#parent-details" data-bs-toggle="tab" class="nav-link">
                                    <span class="d-sm-none">Parent Details</span>
                                    <span class="d-sm-block d-none">Parent Details</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#address" data-bs-toggle="tab" class="nav-link">
                                    <span class="d-sm-none">Address</span>
                                    <span class="d-sm-block d-none">Address</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content p-3 rounded-top panel rounded-0 m-0">

                            <div class="tab-pane fade active show" id="person-detail">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Medium:</label>
                                            <select class="form-select">
                                                <option selected>--Select-- </option>
                                                <option value="1">English</option>
                                                <option value="2">Hindi</option>
                                            </select>

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Discipline:</label>
                                            <select class="form-select">
                                                <option selected>--Select-- </option>
                                                <option value="1">School of Education</option>
                                                <option value="2">School of Pharmacy</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Program</label>
                                            <select class="default-select2 form-control">
                                                <option selected>--Select Program-- </option>
                                                <optgroup label="Enginnering">
                                                    <option value="AK">B.Tech</option>
                                                    <option value="HI">M.Tech</option>
                                                </optgroup>
                                                <optgroup label="Management">
                                                    <option value="CA">BBA</option>
                                                    <option value="NV">MBA</option>

                                                </optgroup>
                                                <optgroup label="Health Care">
                                                    <option value="CA">B.Physiotherphy</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Select Course Specialization/Honour's:</label>
                                            <select class="form-select">...
                                                <option selected>--Select Role-- </option>
                                                <option value="1">Admin</option>
                                                <option value="2">Handler</option>

                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">

                                            <label class="form-label">First Name</label>
                                            <input class="form-control" type="text" placeholder="Enter Name" />

                                        </div>
                                        <div class="col-md-3 mb-3">

                                            <label class="form-label">Middle Name</label>
                                            <input class="form-control" type="text" placeholder="Middle Name" />

                                        </div>
                                        <div class="col-md-3 mb-3">

                                            <label class="form-label">Last Name</label>
                                            <input class="form-control" type="text" placeholder="Last Name" />

                                        </div>
                                        <div class="col-md-3 mb-3">

                                            <label class="form-label">Student Email:</label>
                                            <input class="form-control" type="text" placeholder="Enter email" />

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label col-form-label">Gender</label>
                                            <div class="d-flex pt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="male" name="inlineRadio">
                                                    <label class="form-check-label" for="male">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="femail" name="inlineRadio">
                                                    <label class="form-check-label" for="femail">Female</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="ohter" name="inlineRadio">
                                                    <label class="form-check-label" for="ohter">Other</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-3 mb-3">

                                            <label class="form-label">Student ID No:</label>
                                            <input class="form-control" type="text" placeholder="Enter email" />

                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Religion:</label>
                                            <select class="form-select">
                                                <option selected>--Select-- </option>
                                                <option value="1">Hinduism</option>
                                                <option value="2">Islam</option>
                                                <option value="2">Buddhism</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Category:</label>
                                            <select class="form-select">
                                                <option selected>--Select-- </option>
                                                <option value="1">General</option>
                                                <option value="2">OBC</option>
                                                <option value="2">EBC</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Student Type ID:</label>
                                            <select class="form-select">
                                                <option selected>--Select-- </option>
                                                <option value="1">General</option>
                                                <option value="2">OBC</option>
                                                <option value="2">EBC</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="" class="form-label">DOB</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="datepicker-dob" />
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="" class="form-label">Landline No.</label>
                                            <input type="text" class="form-control" placeholder="Landline No." />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="parent-details">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">Father's Name</label>
                                            <input class="form-control" type="text" placeholder="Enter Name" />

                                        </div>
                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">Father's occupation</label>
                                            <input class="form-control" type="text" placeholder="Middle Name" />

                                        </div>
                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">Annual Income</label>
                                            <input class="form-control" type="text" placeholder="Last Name" />

                                        </div>
                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">Mother's Name</label>
                                            <input class="form-control" type="text" placeholder="Enter Name" />

                                        </div>
                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">Mother's occupation</label>
                                            <input class="form-control" type="text" placeholder="Middle Name" />

                                        </div>
                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">Annual Income</label>
                                            <input class="form-control" type="text" placeholder="Last Name" />

                                        </div>
                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">Parent's Email:</label>
                                            <input class="form-control" type="text" placeholder="Parent's email" />

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="" class="form-label">Parent Mobile No.</label>
                                            <input type="text" class="form-control" placeholder="Mobile No." />
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="address">

                                <form action="" class="row">
                                    <h3 class="mt-10px">Permanent Address</h3>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Country</label>
                                        <input class="form-control" type="text" placeholder="Enter Name" />
                                    </div>
                                    <div class="col-md-4  mb-3">
                                        <label class="form-label">State:</label>
                                        <select class="form-select">
                                            <option selected>--Select-- </option>
                                            <option value="1">English</option>
                                            <option value="2">Hindi</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">District:</label>
                                        <select class="form-select">
                                            <option selected>--Select-- </option>
                                            <option value="1">English</option>
                                            <option value="2">Hindi</option>
                                        </select>

                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Address </label>
                                        <input class="form-control" type="text" placeholder="Address" />
                                    </div>
                                    <div class="col-md-4 ">
                                        <label class="form-label">Pincode</label>
                                        <input class="form-control" type="text" placeholder="pincode" />
                                    </div>
                                </form>

                                <h3 class="mt-4">Current Address</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkbox1" />
                                    <label class="form-check-label" for="checkbox1">Same as Permanent Address</label>
                                </div>
                                <div id="sameAdrs">
                                    <form action="" class="row mt-3">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Country</label>
                                            <input class="form-control" type="text" placeholder="Enter Name" />
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">State:</label>
                                            <select class="form-select">
                                                <option selected>--Select-- </option>
                                                <option value="1">English</option>
                                                <option value="2">Hindi</option>
                                            </select>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">District:</label>
                                            <select class="form-select">
                                                <option selected>--Select-- </option>
                                                <option value="1">English</option>
                                                <option value="2">Hindi</option>
                                            </select>

                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label">Address </label>
                                            <input class="form-control" type="text" placeholder="Address" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Pincode</label>
                                            <input class="form-control" type="text" placeholder="pincode" />
                                        </div>
                                    </form>
                                </div>
                                <script>
                                    var checkbox = document.getElementById('checkbox1');
                                    var sameadrs = document.getElementById('sameAdrs');

                                    // Add an event listener to the checkbox
                                    checkbox.addEventListener('change', function() {
                                        // Check if the checkbox is checked
                                        if (checkbox.checked) {
                                            // If checked, hide the div
                                            sameadrs.style.display = 'none';
                                        } else {
                                            // If unchecked, show the div
                                            sameadrs.style.display = 'block';
                                        }
                                    });
                                </script>
                            </div>

                        </div>
                    </div>
                </div>
                <div class=" d-flex p-2 ">
                    <a href="#" class="btn btn-default m-auto me-3 " onclick="prevStep()">Privious</a>
                    <a href="#" class="btn btn-primary " onclick="nextStep()">Next</a>
                </div>
            </div>
        </div>
        <!--5. Acadmic Details-->
        <div id="academic" class="form-step ">
            <div class="card border-0 mb-4 pb-3">
                <div class="card-header bg-none p-3 h3 m-0 d-flex align-items-center">
                    <i class="fa fa-shopping-bag fa-lg me-2 text-gray text-opacity-50"></i>
                    5. Acadmic Details
                </div>
                <div class="card-body p-3 text-dark fw-bold border-bottom pb-4">
                    <div class=" p-md-3">
                        <form action="">
                            <div class="row mb-3">
                                <h4>10th or Equivalent Details</h4>
                                <div class="col-md-4">

                                    <label class="form-label">Board/University</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Institute/School Name</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Passing Year </label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Max Marks</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Obtained Marks</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Percentage/Grade</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Result Type</label>
                                    <select class="form-select">
                                        <option selected>--Select-- </option>
                                        <option value="1">English</option>
                                        <option value="2">Hindi</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <h4>12th or Equivalent Details</h4>
                                <div class="col-md-4">

                                    <label class="form-label">Board/University</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Institute/School Name</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Passing Year </label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Max Marks</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Obtained Marks</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Percentage/Grade</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Result Type</label>
                                    <select class="form-select">
                                        <option selected>--Select-- </option>
                                        <option value="1">English</option>
                                        <option value="2">Hindi</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <h4>Graduation Details</h4>
                                <div class="col-md-4">

                                    <label class="form-label">Board/University</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Institute/School Name</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Passing Year </label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Max Marks</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Obtained Marks</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Percentage/Grade</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Result Type</label>
                                    <select class="form-select">
                                        <option selected>--Select-- </option>
                                        <option value="1">English</option>
                                        <option value="2">Hindi</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <h3>Post Graduation Details</h3>
                                <div class="col-md-4">

                                    <label class="form-label">Board/University</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Institute/School Name</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Passing Year </label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Max Marks</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Obtained Marks</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">

                                    <label class="form-label">Percentage/Grade</label>
                                    <input class="form-control" type="text" placeholder="" />

                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Result Type</label>
                                    <select class="form-select">
                                        <option selected>--Select-- </option>
                                        <option value="1">English</option>
                                        <option value="2">Hindi</option>
                                    </select>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class=" d-flex p-2 ">
                    <a href="#" class="btn btn-default m-auto me-3 " onclick="prevStep()">Privious</a>
                    <a href="#" class="btn btn-primary " onclick="nextStep()">Next</a>
                </div>
            </div>
        </div>
        <!-- 6. Document Upload -->
        <div id="upload" class="mb-4 pb-3 pb-3 form-step ">
            <div class="card border-0">
                <div class="card-header bg-none p-3 h3 m-0 d-flex align-items-center">
                    <i class="fa fa-credit-card fa-lg me-2 text-gray text-opacity-50"></i>
                    6. Document Upload
                </div>
                <div class="card-body border-bottom pb-4">
                    <div class="row">
                        <div class="col-md-6 ">
                            <label class="form-label">Chooes Upload</label>
                            <select class="form-select">
                                <option selected>--Select Document Type-- </option>
                                <option value="1">Photo</option>
                                <option value="2">Aadhar Card</option>
                                <option value="2">10th or Equivalent Marksheet</option>
                                <option value="2">12th or Equivalent Marksheet</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Document</label>
                            <input type="file" class="form-control" placeholder="choose file" />
                        </div>
                    </div>
                </div>
                <div class=" d-flex p-2">
                    <a href="#" class="btn btn-default m-auto me-3" onclick="prevStep()">Privious</a>
                    <a href="#" class="btn btn-primary " onclick="nextStep()">Next</a>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="<?= base_url('assets/js/iconify.min.js') ?>" type="text/javascript"></script>
<script>
    $("#datepicker-timeSedual").datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $("#datepicker-dob").datepicker({
        todayHighlight: true,
        autoclose: true
    });
    $(".default-select2").select2();
</script>


<script>
    let currentStep = 0;
    const formSteps = document.querySelectorAll('.form-step');

    function nextStep() {
        formSteps[currentStep].classList.remove('active');
        currentStep = (currentStep + 1) % formSteps.length;
        formSteps[currentStep].classList.add('active');
    }

    function prevStep() {
        formSteps[currentStep].classList.remove('active');
        currentStep = (currentStep - 1 + formSteps.length) % formSteps.length;
        formSteps[currentStep].classList.add('active');
    }

    document.getElementById('multiStepForm').addEventListener('submit', function(event) {
        event.preventDefault();
        alert('Form submitted successfully!');
    });

    $(document).ready(function() {
        $("#payment").addClass("active");
    });
</script>
<?= $this->endSection() ?>