<div class="text-white text-center d-block d-lg-none py-2 bg-primary">
    <h4 class="mb-0 font-weight-normal">Profile Details</h4>
</div>

<!--4. Personal Details -->
<div id="person" class="form-step active">
    <div class="card border-0 mb-4 pb-3">
        <div class="card-header bg-none p-3 h3 m-0 d-flex align-items-center">
            <i class="fa fa-shopping-bag fa-lg me-2 text-gray text-opacity-50"></i>
            4. All Person Detail
        </div>

        <div class="card-body p-3 text-dark fw-bold border-bottom pb-4">
            <div class=" p-md-3">
                <ul class="nav nav-pills mb-2 justify-content-center">
                    <li class="nav-item">
                        <a href="<?= base_url($route . $lid . '/' . $sid . '/' . $slug . '/personal') ?>" data-bs-toggle="tab" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/personal') ? 'active' : '' ?> <?= ((!strpos($_SERVER['REQUEST_URI'], '/personal')) && (!strpos($_SERVER['REQUEST_URI'], '/parent')) && (!strpos($_SERVER['REQUEST_URI'], '/address')) ? 'active' : '') ?>">
                            <span class="d-sm-none">1.Person Detail</span>
                            <span class="d-sm-block d-none">Person Detail</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url($route . $lid . '/' . $sid . '/' . $slug . '/parent') ?>" data-bs-toggle="tab" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/parent') ? 'active' : '' ?>">
                            <span class="d-sm-none">2.Parent Details</span>
                            <span class="d-sm-block d-none">Parent Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url($route . $lid . '/' . $sid . '/' . $slug . '/address') ?>" data-bs-toggle="tab" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/address') ? 'active' : '' ?>">
                            <span class="d-sm-none">3.Address</span>
                            <span class="d-sm-block d-none">Address</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-3 rounded-top panel rounded-0 m-0">



                    <?= $this->include('admission/' . $subStep); ?>

                </div>
            </div>
        </div>
        <!-- <div class=" d-flex p-2 ">
            <a href="#" class="btn btn-default m-auto me-3 " onclick="prevStep()">Privious</a>
            <a href="#" class="btn btn-primary " onclick="nextStep()">Next</a>
        </div> -->
    </div>
</div>