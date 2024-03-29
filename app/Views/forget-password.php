<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <title>Forget Password | Leadforms</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="<?= base_url() ?>/assets/css/pages/login/login-2.css" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= base_url() ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="<?= base_url() ?>/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/media/logos/favicon.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
                <!--begin: Aside Container-->
                <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
                    <!--begin::Logo-->
                    <a href="#" class="text-center pt-2">
                        <link href="https://fonts.googleapis.com/css2?family=Satisfy&amp;display=swap" rel="stylesheet">
                        <a href="<?= base_url() ?>" class="brand-logo text-center" style="font-family: Satisfy; font-size: 3.5rem!important; color: #000; font-weight: 700;">
                            leadforms
                        </a>
                    </a>
                    <!--end::Logo-->
                    <!--begin::Aside body-->
                    <div class="d-flex flex-column-fluid flex-column">
                        <!--begin::Signin-->
                        <div class="login-form login-signin py-11">
                            <!--begin::Form-->
                            <form class="form" action="" method="post" id="kt_login_signin_form">
                                <!--begin::Title-->
                                <div class="text-center pb-8">
                                    <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Forget Password</h2>

                                </div>
                                <!-- <div class="alert alert-success" role="alert">
                                    A simple primary alert—check it out!
                                </div> -->
                                <!--end::Title-->
                                <?= csrf_field() ?>
                                <label class="font-size-h6 font-weight-bolder text-dark">Session </label>
									<div class="form-group mb-5">
										<select class="form-control h-auto form-control-solid py-3 px-4" name="year" id="year" required >
											<option value="">-- Select --</option>
											<?php for ($i = 2023; $i >= 2022; $i--) : ?>
												<option value="<?= $i ?>" <?= ((set_value('year')??old('year')) == $i) ? 'Selected' : NULL ?>><?= $i ?></option>
											<?php endfor; ?>
										</select>
									</div>
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                    <input class="form-control form-control-solid h-auto py-3 px-4 " type="email" name="email" placeholder="Email" required value="<?= set_value('email')??old('email') ?>" autocomplete="on" />
                                </div>
                                <?php if (isset($validation)) : ?>
                                    <fieldset>
                                    <div class="alert alert-danger">
                                        <?= $validation->listErrors() ?>
                                    </div>
                                    </fieldset>
                                <?php endif; ?>
                                <!--end::Form group-->
                                <div class="text-center pt-2">
                                    <button id="submit" type="submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Submit</button>
                                </div>

                                <!--begin::Action-->

                                <!--end::Action-->
                            </form>
                            
                            <!--end::Form-->
                        </div>
                        <!--end::Signin-->

                    </div>
                    <!--end::Aside body-->

                </div>
                <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0 px-2" style="background-color: #B1DCED;background-image: url(<?= base_url() ?>/assets/media/svg/illustrations/login-visual-2.svg);">
                <!--begin::Title-->
                <div class="d-flex flex-column justify-content-center text-center pt-lg-10">
                    <div class="d-none d-lg-block">
                        <h3 class="display4 font-weight-bolder my-7 text-dark" style="color: #986923;">Amazing Lead Manager</h3>
                        <p class="font-weight-bolder font-size-h2-md font-size-lg text-dark opacity-70">An Application to manage your entire admissions leads and enrollment process</p>
                    </div>
                </div>
                <!--end::Title-->
                <!--begin::Image-->

                <!--end::Image-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
    <script>
        var HOST_URL = "<?= base_url() ?>";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="<?= base_url() ?>/assets/plugins/global/plugins.bundle.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="<?= base_url() ?>/assets/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    <script>
        function showFire(type,text) {
            Swal.fire({
                text: text,
                icon: type,
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light"
                }
            }).then(function() {
                KTUtil.scrollTop();
            });
        };
    </script>
    <?php if(url_is('forget-password/success')): ?>
        <script>
            showFire('success', "Password link has been sent on your email.");
        </script>
    <?php endif; ?>
    <?php if (isset($validation) || session('error')) : ?>
        <script>
            showFire('error', "Password link has been not sent on your email.");
        </script>
    <?php endif; ?>

    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>