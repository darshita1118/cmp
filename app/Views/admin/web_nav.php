<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <i class="ki ki-menu-grid icon-x"></i>
        </button>
        <!--end::Toolbar-->
        <!--begin::Logo-->
        <a href="<?= base_url('/')?>" class="brand-logo mx-auto">
            <img alt="Logo" src="<?= base_url() ?>/assets/media/logos/logo.png" style="height: 35px;" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu mt-0 mb-4" data-menu-vertical="1" data-menu-scroll="1"
            data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav pt-0 pb-2">
                <li class="menu-item  <?= url_is('admin/')?'menu-item-active':null ?>" aria-haspopup="true">
                    <a href="<?= base_url('/') ?>" class="menu-link">
                        <span class="svg-icon menu-icon" style="background: #009688;">
                            <!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Design/Layers.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                    <path
                                        d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item menu-item-submenu  <?= (url_is('admin/leads') || url_is('admin/add-lead') || url_is('admin/bulk-upload-lead') || url_is('admin/allocated-lead') || url_is('admin/unallocated-lead') || url_is('admin/self-assign-lead') || url_is('admin/transfer-to') || url_is('admin/transfer-from'))?'menu-item-active':null ?>"
                    aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon" style="background:#780116">
                            <!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Shopping/Barcode-read.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path
                                        d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>

                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">Leads</span>
                        <i class="menu-arrow"></i>

                    </a>
                    <div class="menu-submenu" kt-hidden-height="400" style="display: none; overflow: hidden;">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Leads</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/leads'))?'menu-item-active':null ?>"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/leads') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">All Leads</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/add-lead'))?'menu-item-active':null ?>"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/add-lead') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create Lead</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/bulk-upload-lead'))?'menu-item-active':null ?>"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/bulk-upload-lead') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Bulk Upload Lead</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/allocated-lead'))?'menu-item-active':null ?>"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/allocated-leads') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Allocated Leads</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/unallocated-lead'))?'menu-item-active':null ?>"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/unallocated-leads') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Unallocated Leads</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/self-assign-lead'))?'menu-item-active':null ?>"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/self-assign-lead') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Self Assign Leads</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/transfer-to') || url_is('admin/transfer-from'))?'menu-item-active':null ?>"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Transfer Lead</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu" kt-hidden-height="240" style="">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item" aria-haspopup="true">
                                        <!--<?= base_url('admin/transfer-to') ?>-->
                                            <a href="<?= base_url('admin/under-construction') ?>" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">To</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                        <!--<?= base_url('admin/transfer-from') ?>-->
                                            <a href="<?= base_url('admin/under-construction') ?>" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">From</span>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </li>


                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu  " aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon" style="background:#5a189a">
                            <!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Shopping/Barcode-read.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path
                                        d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path
                                        d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                        fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>

                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">Handlers</span>
                        <i class="menu-arrow"></i>

                    </a>
                    <div class="menu-submenu" kt-hidden-height="400" style="display: none; overflow: hidden;">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Handler</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/handlers') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">All Handler</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/create-handler') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create Handler</span>

                                </a>

                            </li>


                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <!--<?= base_url('admin/handlers-report') ?>-->
                                <a href="<?= base_url('admin/under-construction') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Handler Report</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <!--<?= base_url('admin/work-load-management') ?>-->
                                <a href="<?= base_url('admin/under-construction') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Work Load Management</span>

                                </a>

                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon" style="background:#D90368">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Shopping/Barcode-read.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
									<path d="M12.4208204,17.1583592 L15.4572949,11.0854102 C15.6425368,10.7149263 15.4923686,10.2644215 15.1218847,10.0791796 C15.0177431,10.0271088 14.9029083,10 14.7864745,10 L12,10 L12,7.17705098 C12,6.76283742 11.6642136,6.42705098 11.25,6.42705098 C10.965921,6.42705098 10.7062236,6.58755277 10.5791796,6.84164079 L7.5427051,12.9145898 C7.35746316,13.2850737 7.50763142,13.7355785 7.87811529,13.9208204 C7.98225687,13.9728912 8.09709167,14 8.21352549,14 L11,14 L11,16.822949 C11,17.2371626 11.3357864,17.572949 11.75,17.572949 C12.034079,17.572949 12.2937764,17.4124472 12.4208204,17.1583592 Z" fill="#000000" />
								</g>
							</svg>

							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">Lead Status</span>
                        <i class="menu-arrow"></i>

                    </a>
                    <div class="menu-submenu" kt-hidden-height="400" style="display: none; overflow: hidden;">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Lead Status</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/status-list') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">All Status</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/create-status') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create Status</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                             <!--<?= base_url('admin/adjust-score-status') ?>-->
                                <a href="<?= base_url('admin/under-construction') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Adjects Status Score</span>

                                </a>

                            </li>



                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon" style="background:#447604">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Shopping/Barcode-read.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M22,17 L22,21 C22,22.1045695 21.1045695,23 20,23 L4,23 C2.8954305,23 2,22.1045695 2,21 L2,17 L6.27924078,17 L6.82339262,18.6324555 C7.09562072,19.4491398 7.8598984,20 8.72075922,20 L15.381966,20 C16.1395101,20 16.8320364,19.5719952 17.1708204,18.8944272 L18.118034,17 L22,17 Z" fill="#000000" />
									<path d="M2.5625,15 L5.92654389,9.01947752 C6.2807805,8.38972356 6.94714834,8 7.66969497,8 L16.330305,8 C17.0528517,8 17.7192195,8.38972356 18.0734561,9.01947752 L21.4375,15 L18.118034,15 C17.3604899,15 16.6679636,15.4280048 16.3291796,16.1055728 L15.381966,18 L8.72075922,18 L8.17660738,16.3675445 C7.90437928,15.5508602 7.1401016,15 6.27924078,15 L2.5625,15 Z" fill="#000000" opacity="0.3" />
									<path d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z" fill="#000000" fill-rule="nonzero" transform="translate(11.959697, 3.661508) rotate(-270.000000) translate(-11.959697, -3.661508) " />
								</g>
							</svg>

							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">Lead Source</span>
                        <i class="menu-arrow"></i>

                    </a>
                    <div class="menu-submenu" kt-hidden-height="400" style="display: none; overflow: hidden;">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Lead Source</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/source-list') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">All Source</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/create-source') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create Source</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <!--<?= base_url('admin/adjust-score-status') ?>-->
                                <a href="<?= base_url('admin/under-construction') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Adjects Source Score</span>

                                </a>

                            </li>



                        </ul>
                    </div>
                </li>
                <?php /*
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon" style="background:#CA5310">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Shopping/Barcode-read.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M14.8571499,13 C14.9499122,12.7223297 15,12.4263059 15,12.1190476 L15,6.88095238 C15,5.28984632 13.6568542,4 12,4 L11.7272727,4 C10.2210416,4 9,5.17258756 9,6.61904762 L10.0909091,6.61904762 C10.0909091,5.75117158 10.823534,5.04761905 11.7272727,5.04761905 L12,5.04761905 C13.0543618,5.04761905 13.9090909,5.86843034 13.9090909,6.88095238 L13.9090909,12.1190476 C13.9090909,12.4383379 13.8240964,12.7385644 13.6746497,13 L10.3253503,13 C10.1759036,12.7385644 10.0909091,12.4383379 10.0909091,12.1190476 L10.0909091,9.5 C10.0909091,9.06606198 10.4572216,8.71428571 10.9090909,8.71428571 C11.3609602,8.71428571 11.7272727,9.06606198 11.7272727,9.5 L11.7272727,11.3333333 L12.8181818,11.3333333 L12.8181818,9.5 C12.8181818,8.48747796 11.9634527,7.66666667 10.9090909,7.66666667 C9.85472911,7.66666667 9,8.48747796 9,9.5 L9,12.1190476 C9,12.4263059 9.0500878,12.7223297 9.14285008,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L14.8571499,13 Z" fill="#000000" opacity="0.3" />
									<path d="M9,10.3333333 L9,12.1190476 C9,13.7101537 10.3431458,15 12,15 C13.6568542,15 15,13.7101537 15,12.1190476 L15,10.3333333 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9,10.3333333 Z M10.0909091,11.1212121 L12,12.5 L13.9090909,11.1212121 L13.9090909,12.1190476 C13.9090909,13.1315697 13.0543618,13.952381 12,13.952381 C10.9456382,13.952381 10.0909091,13.1315697 10.0909091,12.1190476 L10.0909091,11.1212121 Z" fill="#000000" />
								</g>
							</svg>

							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">Email Templates</span>
                        <i class="menu-arrow"></i>

                    </a>
                    <div class="menu-submenu" kt-hidden-height="400" style="display: none; overflow: hidden;">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Email Templates</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/email-templates') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">All Email</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/create-email-template') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create Email</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/under-construction') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Email Reports</span>

                                </a>

                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon" style="background:#246A73">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Shopping/Barcode-read.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
								</g>
							</svg>

							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">SMS Templates</span>
                        <i class="menu-arrow"></i>

                    </a>
                    <div class="menu-submenu" kt-hidden-height="400" style="display: none; overflow: hidden;">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">SMS Templates</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/sms-templates') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">All SMS</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/create-sms-template') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create SMS</span>

                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/under-construction') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">SMS Reports</span>

                                </a>

                            </li>
                        </ul>
                    </div>
                </li>
		*/ ?>
                <li class="menu-item menu-item-submenu <?= (url_is('admin/reports') || url_is('admin/report/created-sid') || url_is('admin/report/registration') || url_is('admin/report/admission-done') || url_is('admin/reportall'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon" style="background:#F08700">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Design/Bucket.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M18,15 L18,13.4774152 C18,13.3560358 18.0441534,13.2388009 18.1242243,13.147578 C18.3063883,12.9400428 18.622302,12.9194754 18.8298372,13.1016395 L21.7647988,15.6778026 C21.7814819,15.6924462 21.7971714,15.7081846 21.811763,15.7249133 C21.9932797,15.933015 21.9717282,16.2488631 21.7636265,16.4303797 L18.828665,18.9903994 C18.7375973,19.0698331 18.6208431,19.1135979 18.5,19.1135979 C18.2238576,19.1135979 18,18.8897403 18,18.6135979 L18,17 L16.445419,17 C14.5938764,17 12.8460429,16.1451629 11.7093057,14.6836437 L7.71198984,9.54423755 C6.95416504,8.56989138 5.7889427,8 4.55458097,8 L2,8 L2,6 L4.55458097,6 C6.40612357,6 8.15395708,6.85483706 9.29069428,8.31635632 L13.2880102,13.4557625 C14.045835,14.4301086 15.2110573,15 16.445419,15 L18,15 Z" fill="#3699ff" fill-rule="nonzero" opacity="0.3" />
									<path d="M18,6 L18,4.4774157 C18,4.3560363 18.0441534,4.23880134 18.1242243,4.14757848 C18.3063883,3.94004327 18.622302,3.9194759 18.8298372,4.10163997 L21.7647988,6.67780304 C21.7814819,6.69244668 21.7971714,6.70818509 21.811763,6.72491379 C21.9932797,6.93301548 21.9717282,7.24886356 21.7636265,7.43038021 L18.828665,9.99039986 C18.7375973,10.0698336 18.6208431,10.1135984 18.5,10.1135984 C18.2238576,10.1135984 18,9.88974079 18,9.61359842 L18,8 L16.445419,8 C15.2110573,8 14.045835,8.56989138 13.2880102,9.54423755 L9.29069428,14.6836437 C8.15395708,16.1451629 6.40612357,17 4.55458097,17 L2,17 L2,15 L4.55458097,15 C5.7889427,15 6.95416504,14.4301086 7.71198984,13.4557625 L11.7093057,8.31635632 C12.8460429,6.85483706 14.5938764,6 16.445419,6 L18,6 Z" fill="#3699ff" fill-rule="nonzero" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">Reports</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="400" style="display: <?= (url_is('admin/reports') || url_is('admin/report/created-sid') || url_is('admin/report/registration') || url_is('admin/report/admission-done') || url_is('admin/student-learning-report') || url_is('admin/reportall'))?'block':'none' ?>; overflow: hidden;">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Reports</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/reports'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/reports') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Report Stats</span>


                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/report/created-sid'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/report/created-sid') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Created Sid List</span>
                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/report/registration'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/report/registration') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Registration List</span>
                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/report/admission-done'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/report/admission-done') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Admission Done List</span>
                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/student-learning-report'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/student-learning-report') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Student Learning</span>
                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu <?= (url_is('admin/reportall'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/reportall') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Handler Work Report</span>
                                </a>

                            </li>


                        </ul>
                    </div>

                </li>
                <li class="menu-section">
                    <h4 class="menu-text">Supports

                    </h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="menu-item <?= url_is('admin/tickets*')?'menu-item-active':null ?>" aria-haspopup="true">
                    <a href="<?= base_url('admin/tickets') ?>" class="menu-link">
                        <span class="svg-icon menu-icon" style="background:#0A8008">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M14.4862 18L12.7975 21.0566C12.5304 21.54 11.922 21.7153 11.4386 21.4483C11.2977 21.3704 11.1777 21.2597 11.0887 21.1255L9.01653 18H5C3.34315 18 2 16.6569 2 15V6C2 4.34315 3.34315 3 5 3H19C20.6569 3 22 4.34315 22 6V15C22 16.6569 20.6569 18 19 18H14.4862Z" fill="black" />
									<path fill-rule="evenodd" clip-rule="evenodd" d="M6 7H15C15.5523 7 16 7.44772 16 8C16 8.55228 15.5523 9 15 9H6C5.44772 9 5 8.55228 5 8C5 7.44772 5.44772 7 6 7ZM6 11H11C11.5523 11 12 11.4477 12 12C12 12.5523 11.5523 13 11 13H6C5.44772 13 5 12.5523 5 12C5 11.4477 5.44772 11 6 11Z" fill="black" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">Tickets</span>
                    </a>
                </li>
                <li class="menu-section">
                    <h4 class="menu-text">Notifcation

                    </h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

                <li class="menu-item" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon" style="background:#0B6E4F">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Design/Bucket.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
									<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">Notifcation</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="400" style="display: none; overflow: hidden;">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Notifcation</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/under-construction') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">All Notifcation</span>


                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/under-construction') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create Notifcation</span>
                                </a>

                            </li>

                        </ul>
                    </div>
                </li>
                <li class="menu-section">
                    <h4 class="menu-text">By Self

                    </h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="menu-item" aria-haspopup="true">
                    <a href="<?= base_url('admin/applicant-list') ?>" class="menu-link">
                        <span class="svg-icon menu-icon" style="background:#5a189a">

							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
									<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">Process Application</span>

                    </a>

                </li>
                <li class="menu-item" aria-haspopup="true">
                    <a href="<?= base_url('admin/application-form-reopen') ?>" class="menu-link">
                        <span class="svg-icon menu-icon" style="background:#5a189a">

							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
									<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">Reopened Application Form</span>

                    </a>

                </li>
                <li class="menu-section">
                    <h4 class="menu-text">Extra

                    </h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="menu-item" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon" style="background:#B10000">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Design/Bucket.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M14,7 C13.6666667,10.3333333 12.6666667,12.1167764 11,12.3503292 C11,12.3503292 12.5,6.5 10.5,3.5 C10.5,3.5 10.287918,6.71444735 8.14498739,10.5717225 C7.14049032,12.3798172 6,13.5986793 6,16 C6,19.428689 9.51143904,21.2006583 12.0057195,21.2006583 C14.5,21.2006583 18,20.0006172 18,15.8004732 C18,14.0733981 16.6666667,11.1399071 14,7 Z" fill="#000000" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">Event</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="400" style="display: none; overflow: hidden;">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Event</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/under-construction') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">All Events</span>


                                </a>

                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/under-construction') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create Events</span>
                                </a>

                            </li>

                        </ul>
                    </div>

                </li>
                <li class="menu-item <?= url_is('admin/login-history/*')?'menu-item-active':null ?>" aria-haspopup="true">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon" style="background:#78290f">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Design/Bucket.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<rect fill="#000000" opacity="0.3" transform="translate(13.000000, 6.000000) rotate(-450.000000) translate(-13.000000, -6.000000) " x="12" y="8.8817842e-16" width="2" height="12" rx="1" />
									<path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) " />
									<rect fill="#000000" opacity="0.3" transform="translate(11.000000, 18.000000) scale(1, -1) rotate(90.000000) translate(-11.000000, -18.000000) " x="10" y="12" width="2" height="12" rx="1" />
									<path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) " />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
                        <span class="menu-text">Login History</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="400" style="display: <?= url_is('admin/login-history/*')?'block':'none' ?>; overflow: hidden;">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">Login History</span>
                                </span>
                            </li>
                            <li class="menu-item menu-item-submenu <?= url_is('admin/login-history/handlers')?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/login-history/handlers') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Login History Handlers</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-submenu <?= url_is('admin/login-history/admins')?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="<?= base_url('admin/login-history/admins') ?>" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-line">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Login History Admins</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>

                </li>


            </ul>
    <!--end::Menu Nav-->
        </div>
    <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
<!--end::Aside-->