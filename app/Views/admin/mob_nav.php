<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn p-0" id="kt_aside_mobile_toggle">
            <i class="ki ki-menu-grid icon-x"></i>
        </button>
    </div>
    <!--begin::Logo-->
    <a href="<?= base_url()?>">
        <img class="" style="height: 50px;" alt="Logo" src="<?= base_url() ?>/assets/media/logos/logo.png" />
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">


        <!--begin::Topbar Mobile Toggle-->
        <div class="dropdown">
            <!--begin::Toggle-->
            <!--begin::User-->
            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
                <div
                    class="btn btn-icon btn-icon-mobile btn-dropdown w-auto btn-clean d-flex align-items-center btn-sm px-2">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi</span>
                    
                    <span class="symbol symbol-lg-25 symbol-25 symbol-light-success">
                        <span class="symbol-label font-size-h5 font-weight-bold"><?= substr(session('name'),0,1)?></span>
                    </span>
                </div>
            </div>
            <!--end::User-->
            <!--end::Toggle-->
            <!--begin::Dropdown-->
            <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right" style="">
                <!--begin::Nav-->
                <ul class="navi navi-hover py-4">
                    <!--begin::Item-->
                    <li class="navi-item">
                        <a href="#" class="navi-link">

                            <span class="navi-text">
                                <?=session('name')?>
                            </span>
                        </a>
                    </li>
                    <!--end::Item-->
                    
                    <!--begin::Item-->
                    <li class="navi-item active">
                        <a href="<?=base_url('/admin/logout');?>" class="navi-link">

                            <span class="navi-text">Logout</span>
                        </a>
                    </li>
                    <!--end::Item-->

                </ul>
                <!--end::Nav-->
            </div>
            <!--end::Dropdown-->
        </div>
        <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->