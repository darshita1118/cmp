<?= $this->extend('login_index') ?>

<?= $this->section('content') ?>


<div class="login login-with-news-feed">

    <div class="news-feed">
        <div class="news-image" style="background-image: url(<?= base_url('assets/img/login-bg/login-bg-11.jpg') ?>)"></div>
        <div class="news-caption">
            <h4 class="caption-title"><b>CMP</b> Admin </h4>
            <p>
                The CMP Admin app for iPhone®, iPad®, and Android™. 
            </p>
        </div>
    </div>


    <div class="login-container">

        <div class="login-header mb-30px">
            <div class="brand">
                <div class="d-flex align-items-center">
                    <span class="logo"></span>
                    <b>CMP</b> Admin
                </div>
                <small>Welcome to CMP Admin</small>
            </div>
            <div class="icon">
                <i class="fa fa-sign-in-alt"></i>
            </div>
        </div>


        <div class="login-content">
            <form action="index.html" method="GET" class="fs-13px">
                <div class="form-floating mb-15px">
                    <input type="text" class="form-control h-45px fs-13px" placeholder="Email Address" id="emailAddress">
                    <label for="emailAddress" class="d-flex align-items-center fs-13px text-gray-600">Email
                        Address</label>
                </div>
                <div class="form-floating mb-15px">
                    <input type="password" class="form-control h-45px fs-13px" placeholder="Password" id="password">
                    <label for="password" class="d-flex align-items-center fs-13px text-gray-600">Password</label>
                </div>
                <div class="form-check mb-30px">
                    <input class="form-check-input" type="checkbox" value="1" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Remember Me
                    </label>
                </div>
                <div class="mb-15px">
                    <button type="submit" class="btn btn-theme d-block h-45px w-100 btn-lg fs-14px">Sign me
                        in</button>
                </div>
                <hr class="bg-gray-600 opacity-2">
                <div class="text-gray-600 text-center  mb-0">
                    &copy; CMP Admin All Right Reserved 2024
                </div>
            </form>
        </div>

    </div>

</div>


<?= $this->endSection() ?>