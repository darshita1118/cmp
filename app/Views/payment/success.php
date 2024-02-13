<?= $this->include('payment/header')  ?>
<style>
@media (min-width: 992px) {
    .aside-enabled .header.header-fixed {
        left: 0px;
    }

    .content {
        padding: 70px 0 0 0;
        background: #fff;
    }

    .container,
    .container-lg,
    .container-md,
    .container-sm,
    .container-xl {
        max-width: 90vw;
        padding: 0;
    }

    .content>.d-flex>.container {
        background: #fff;
    }

}

#kt_header {
    height: 60px;
    border-bottom: 0px solid rgb(126, 126, 126);
}

@media(max-width:568px) {
    #kt_header {
        height: 45px;
        border-bottom: 0px solid rgb(126, 126, 126);
    }
}

.card-custom {
    -webkit-box-shadow: -3px -3px 20px 0px rgb(151 159 171 / 47%), 3px 3px 5px rgb(94 104 121 / 40%);
    box-shadow: -3px -3px 20px 0px rgb(151 159 171 / 47%), 3px 3px 5px rgb(94 104 121 / 40%);
    border: 0;
}
</style>

<?= $this->include('payment/mob_nav') ?>
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <?php //include('web_nav.php') 
        ?>
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">

            <!--begin::Header-->
            <div id="kt_header" class="header header-fixed">
                <!--begin::Container-->
                <div class="container d-flex align-items-stretch justify-content-between">
                    <!--begin::Header Menu Wrapper-->
                    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                        <img style="height:60px" class="brand-logo" src="<?= base_url()?>/assets/media/logos/logo.png"
                            alt="">
                    </div>
                    <!--end::Header Menu Wrapper-->
                    <!--begin::Topbar-->
                    <div class="topbar">

                        <!--begin::User-->

                        <!--end::User-->
                    </div>
                    <!--end::Topbar-->
                </div>
                <!--end::Container-->
            </div>
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Subheader-->
                <!--end::Subheader-->
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body p-0">
                                <!--begin::Wrapper-->
                                <div class="card-px text-center py-20 my-10">
                                    <!--begin::Title-->
                                    <div>
                                        <img style="width: 150px;" src="<?= base_url()?>/assets/media/error/bill.png"
                                            alt="">
                                    </div>
                                    <h2 class="fs-2x font-weight-bolder mb-3">Success!</h2>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <p class="text-gray-400 fs-4 fw-bold mb-10">Your payment is confirmed.<br> You will
                                        recevie an transaction receipt on email after confirmation.
                                        (<?= "<b>transaction ID:</b> {$transaction}"; ?>)
                                        <br><b> Order ID: </b> <?= $order_id ?>
                                        <br><b> Amount: </b> <?= $amount ?>
                                    </p>
                                    <!--end::Description-->
                                    <!--begin::Action-->
                                    <?= "<a href='{$redirectUrl}' class='btn btn-primary'>Complete Application Form</a>" ?>
                                    <!--end::Action-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                <!--begin::Container-->
                <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <!--begin::Copyright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted font-weight-bold mr-2">
                            <?php echo date('Y') ?> ©
                        </span>
                        <a href="<?= base_url() ?>" target="_blank" class="text-dark-75 text-hover-primary">Gyan
                            Vihar</a>
                    </div>
                    <!--end::Copyright-->
                    <!--begin::Nav-->
                    <div class="nav nav-dark">
                        <a href="#" target="_blank" class="nav-link pl-0 pr-5">About</a>
                        <a href="#" target="_blank" class="nav-link pl-0 pr-5">Team</a>
                        <a href="#" target="_blank" class="nav-link pl-0 pr-0">Contact</a>
                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<?= $this->include('payment/footer')  ?>