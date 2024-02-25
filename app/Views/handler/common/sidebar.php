<?php

use function App\Helpers\handlerReportStatusWise;
use function App\Helpers\handlerStatusReport;

$sideMenuStatusReports = handlerReportStatusWise(session('year'), session('db_priffix') . '_', session('suffix'), session('id'));

$svgs = [
    '<span class="svg-icon svg-icon-warning mr-5">
		<span class="svg-icon svg-icon-lg">
			<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
				height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"></rect>
					<path
						d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
						fill="#000000"></path>
					<rect fill="#000000" opacity="0.3"
						transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)"
						x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</span>',
    '<span class="svg-icon svg-icon-success mr-5">
		<span class="svg-icon svg-icon-lg">
			<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
				height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"></rect>
					<path
						d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
						fill="#000000" fill-rule="nonzero"
						transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
					</path>
					<path
						d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
						fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</span>',
    '<span class="svg-icon svg-icon-danger mr-5">
		<span class="svg-icon svg-icon-lg">
			<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
				height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"></rect>
					<path
						d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
						fill="#000000"></path>
					<path
						d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
						fill="#000000" opacity="0.3"></path>
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</span>',
    '<span class="svg-icon svg-icon-info mr-5">
		<span class="svg-icon svg-icon-lg">
			<!--begin::Svg Icon | path:assets/media/svg/icons/General/Attachment2.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
				height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24"></rect>
					<path
						d="M11.7573593,15.2426407 L8.75735931,15.2426407 C8.20507456,15.2426407 7.75735931,15.6903559 7.75735931,16.2426407 C7.75735931,16.7949254 8.20507456,17.2426407 8.75735931,17.2426407 L11.7573593,17.2426407 L11.7573593,18.2426407 C11.7573593,19.3472102 10.8619288,20.2426407 9.75735931,20.2426407 L5.75735931,20.2426407 C4.65278981,20.2426407 3.75735931,19.3472102 3.75735931,18.2426407 L3.75735931,14.2426407 C3.75735931,13.1380712 4.65278981,12.2426407 5.75735931,12.2426407 L9.75735931,12.2426407 C10.8619288,12.2426407 11.7573593,13.1380712 11.7573593,14.2426407 L11.7573593,15.2426407 Z"
						fill="#000000" opacity="0.3"
						transform="translate(7.757359, 16.242641) rotate(-45.000000) translate(-7.757359, -16.242641)">
					</path>
					<path
						d="M12.2426407,8.75735931 L15.2426407,8.75735931 C15.7949254,8.75735931 16.2426407,8.30964406 16.2426407,7.75735931 C16.2426407,7.20507456 15.7949254,6.75735931 15.2426407,6.75735931 L12.2426407,6.75735931 L12.2426407,5.75735931 C12.2426407,4.65278981 13.1380712,3.75735931 14.2426407,3.75735931 L18.2426407,3.75735931 C19.3472102,3.75735931 20.2426407,4.65278981 20.2426407,5.75735931 L20.2426407,9.75735931 C20.2426407,10.8619288 19.3472102,11.7573593 18.2426407,11.7573593 L14.2426407,11.7573593 C13.1380712,11.7573593 12.2426407,10.8619288 12.2426407,9.75735931 L12.2426407,8.75735931 Z"
						fill="#000000"
						transform="translate(16.242641, 7.757359) rotate(-45.000000) translate(-16.242641, -7.757359)">
					</path>
					<path
						d="M5.89339828,3.42893219 C6.44568303,3.42893219 6.89339828,3.87664744 6.89339828,4.42893219 L6.89339828,6.42893219 C6.89339828,6.98121694 6.44568303,7.42893219 5.89339828,7.42893219 C5.34111353,7.42893219 4.89339828,6.98121694 4.89339828,6.42893219 L4.89339828,4.42893219 C4.89339828,3.87664744 5.34111353,3.42893219 5.89339828,3.42893219 Z M11.4289322,5.13603897 C11.8194565,5.52656326 11.8194565,6.15972824 11.4289322,6.55025253 L10.0147186,7.96446609 C9.62419433,8.35499039 8.99102936,8.35499039 8.60050506,7.96446609 C8.20998077,7.5739418 8.20998077,6.94077682 8.60050506,6.55025253 L10.0147186,5.13603897 C10.4052429,4.74551468 11.0384079,4.74551468 11.4289322,5.13603897 Z M0.600505063,5.13603897 C0.991029355,4.74551468 1.62419433,4.74551468 2.01471863,5.13603897 L3.42893219,6.55025253 C3.81945648,6.94077682 3.81945648,7.5739418 3.42893219,7.96446609 C3.0384079,8.35499039 2.40524292,8.35499039 2.01471863,7.96446609 L0.600505063,6.55025253 C0.209980772,6.15972824 0.209980772,5.52656326 0.600505063,5.13603897 Z"
						fill="#000000" opacity="0.3"
						transform="translate(6.014719, 5.843146) rotate(-45.000000) translate(-6.014719, -5.843146)">
					</path>
					<path
						d="M17.9142136,15.4497475 C18.4664983,15.4497475 18.9142136,15.8974627 18.9142136,16.4497475 L18.9142136,18.4497475 C18.9142136,19.0020322 18.4664983,19.4497475 17.9142136,19.4497475 C17.3619288,19.4497475 16.9142136,19.0020322 16.9142136,18.4497475 L16.9142136,16.4497475 C16.9142136,15.8974627 17.3619288,15.4497475 17.9142136,15.4497475 Z M23.4497475,17.1568542 C23.8402718,17.5473785 23.8402718,18.1805435 23.4497475,18.5710678 L22.0355339,19.9852814 C21.6450096,20.3758057 21.0118446,20.3758057 20.6213203,19.9852814 C20.2307961,19.5947571 20.2307961,18.9615921 20.6213203,18.5710678 L22.0355339,17.1568542 C22.4260582,16.76633 23.0592232,16.76633 23.4497475,17.1568542 Z M12.6213203,17.1568542 C13.0118446,16.76633 13.6450096,16.76633 14.0355339,17.1568542 L15.4497475,18.5710678 C15.8402718,18.9615921 15.8402718,19.5947571 15.4497475,19.9852814 C15.0592232,20.3758057 14.4260582,20.3758057 14.0355339,19.9852814 L12.6213203,18.5710678 C12.2307961,18.1805435 12.2307961,17.5473785 12.6213203,17.1568542 Z"
						fill="#000000" opacity="0.3"
						transform="translate(18.035534, 17.863961) scale(1, -1) rotate(45.000000) translate(-18.035534, -17.863961)">
					</path>
				</g>
			</svg>
			<!--end::Svg Icon-->
		</span>
	</span>'
];

$svgClass = [
    'info',
    'primary',
    'indigo',
    'secondary',
    'dark',
    'info',
    'primary',
    'indigo',
    'secondary',
    'dark',
    'info',
    'primary',
    'indigo',
    'secondary',
    'dark',
    'info',
    'primary',
    'indigo',
    'secondary',
    'dark',
];

$svgiconClass = [
    'globe',
    'blender-phone',
    'futbol',
    'compact-disc',
    'globe',
    'globe',
    'blender-phone',
    'futbol',
    'compact-disc',
    'globe',
    'globe',
    'blender-phone',
    'futbol',
    'compact-disc',
    'globe',
    'globe',
    'blender-phone',
    'futbol',
    'compact-disc',
    'globe',
];

?>
<!-- App Body Start -->
<div id="app" class="app app-header-fixed app-sidebar-fixed app-without-sidebar app-with-top-menu">
    <!-- header -->
    <div id="header" class="app-header">
        <div class="navbar-header">
            <a href="<?= base_url('handler/welcome') ?>" class="navbar-brand"><span class="navbar-logo"></span> <b class="me-3px">LDM</b>
                Admin</a>
            <button type="button" class="navbar-mobile-toggler" data-toggle="app-top-menu-mobile">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <div class="navbar-nav">

            <div class="navbar-item navbar-user dropdown">
                <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                    <span>&nbsp;&nbsp; Session: <?= session('year') . '-' . (session('year') + 1) ?> &nbsp;&nbsp;</span>
                    <span>
                        <span class="d-none d-md-inline"><?= substr(session('name'), 0, 1) ?></span>
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end me-1">
                    <a href="javascript:void();" class="dropdown-item"><?= session('name') ?></a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('/handler/logout'); ?>" class="dropdown-item">Log Out</a>
                </div>
            </div>
            <a href="javascript:;" class="btn btn-sm me-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTopst" title="Our Stacks" aria-controls="offcanvasTop"><i class="fa fa-xl fa-th-large"></i></a>
            <div class="offcanvas offcanvas-top ps-md-5 pe-md-5" tabindex="-1" id="offcanvasTopst" aria-labelledby="offcanvasTopLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 id="offcanvasTopLabel">Our Stacks</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mt-md-3">
                    <div class="row">
                        <?php $i = 0;
                        $totalLeads = 0;
                        foreach ($sideMenuStatusReports as $reportStatus) : $totalLeads += $reportStatus['total_leads']; ?>
                            <!--begin::Item-->

                            <div class="col-md-2">
                                <a href="<?= base_url('handler/lead-status-report/' . $reportStatus['id']) ?>" class="text-decoration-none">
                                    <!-- begin widget-stats -->
                                    <div class="widget widget-stats bg-<?= $svgClass[$i++] ?> mb-10px">
                                        <div class="stats-icon stats-icon-lg"><i class="fa fa-<?= $svgiconClass[$i++] ?> fa-fw"></i></div>
                                        <div class="stats-content">
                                            <div class="stats-title"><?= $reportStatus['name'] ?? 'New Opportunity' ?></div>
                                            <div class="stats-number"><?= $reportStatus['total_leads'] ?? '0' ?></div>
                                        </div>
                                    </div>
                                    <!-- end widget-stats -->
                                </a>
                            </div>

                            <!--end::Item-->
                            <?php if ($reportStatus['type'] == 2) : $i = $i == 3 ? 0 : $i;
                                $extra = handlerStatusReport(session('year'), session('db_priffix') . '_', session('suffix'), session('id'), $reportStatus['id']);  ?>

                                <div class="col-md-2">
                                    <a href="<?= base_url('handler/lead-status-report/' . $reportStatus['id'] . '/today') ?>" class="text-decoration-none">
                                        <!-- begin widget-stats -->
                                        <div class="widget widget-stats bg-<?= $svgClass[$i++] ?> mb-10px">
                                            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                                            <div class="stats-content">
                                                <div class="stats-title">Today <?= $reportStatus['name'] ?? 'New Opportunity' ?></div>
                                                <div class="stats-number"><?= $extra['today'] ?? '0' ?></div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- end widget-stats -->
                                </div>


                                <?php $i = $i == 3 ? 0 : $i; ?>

                                <div class="col-md-2">
                                    <a href="<?= base_url('handler/lead-status-report/' . $reportStatus['id'] . '/overdue') ?>" class="text-decoration-none">
                                        <!-- begin widget-stats -->
                                        <div class="widget widget-stats bg-<?= $svgClass[$i++] ?> mb-10px">
                                            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                                            <div class="stats-content">
                                                <div class="stats-title">Overdue <?= $reportStatus['name'] ?? 'New Opportunity' ?></div>
                                                <div class="stats-number"><?= $extra['overdue'] ?? '0' ?></div>
                                            </div>
                                        </div>
                                        <!-- end widget-stats -->
                                    </a>
                                </div>

                            <?php endif ?>
                        <?php $i = $i == 3 ? 0 : $i;
                        endforeach; ?>

                        <div class="col-md-2">
                            <a href="<?= base_url('handler') ?>" class="text-decoration-none">
                                <!-- begin widget-stats -->
                                <div class="widget widget-stats bg-teal mb-10px">
                                    <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                                    <div class="stats-content">
                                        <div class="stats-title"><?= 'Total Leads' ?></div>
                                        <div class="stats-number"><?= $totalLeads ?? '0' ?></div>
                                    </div>
                                </div>
                                <!-- end widget-stats -->
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- top-menu -->
    <div id="top-menu" class="app-top-menu" data-bs-theme="dark">
        <div class="menu">
            <div class="menu-item ">
                <a href="<?= base_url('handler/welcome') ?>" class="menu-link">

                    <div class="menu-icon">
                        <i class="fa fa-gauge-high"></i>
                    </div>

                    <div class="menu-text">Dashboard </div>
                </a>
            </div>

            <div class="menu-item has-sub">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <div class="menu-text">Leads</div>
                    <div class="menu-caret"></div>
                </a>

                <div class="menu-submenu">
                    <?php if (session('role') == 1) : ?>
                        <div class="menu-item">
                            <a href="<?= base_url('handler/leads') ?>" class="menu-link">
                                <div class="menu-text">All Leads</div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="menu-item">
                        <a href="<?= base_url('handler/add-lead') ?>" class="menu-link ">
                            <div class="menu-text">Create Lead</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?= base_url('handler') ?>" class="menu-link">
                            <div class="menu-text"> Assign Leads</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item has-sub">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-chart-pie"></i>
                    </div>
                    <div class="menu-text">Reports</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="<?= base_url('handler/reports') ?>" class="menu-link">
                            <div class="menu-text">Report Stats</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?= base_url('handler/report/created-sid') ?>" class="menu-link">
                            <div class="menu-text">Created Sid List</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?= base_url('handler/report/registration') ?>" class="menu-link">
                            <div class="menu-text">Registration List</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?= base_url('handler/report/admission-done') ?>" class="menu-link">
                            <div class="menu-text">Admission Done List</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="menu-item ">
                <a href="<?= base_url('handler/tickets') ?>" class="menu-link">

                    <div class="menu-icon">
                        <i class="fa fa-ticket"></i>
                    </div>

                    <div class="menu-text">Tickets </div>
                </a>
            </div>
            <div class="menu-item has-sub">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <div class="menu-text">Application Form</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="<?= base_url('handler/applicant-list') ?>" class="menu-link">
                            <div class="menu-text">Process Application</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?= base_url('handler/application-form-reopen') ?>" class="menu-link">
                            <div class="menu-text">Reopened Application</div>
                        </a>
                    </div>
                </div>
            </div>


            <?php if (session('role') == 1) : ?>
                <div class="menu-item has-sub">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-database"></i>
                        </div>
                        <div class="menu-text">Counselor</div>
                        <div class="menu-caret"></div>
                    </a>
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <a href="<?= base_url('handler/members') ?>" class="menu-link">
                                <div class="menu-text">All Counselor</div>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="<?= base_url('handler/create-member') ?>" class="menu-link">
                                <div class="menu-text">Create Counselor</div>
                            </a>
                        </div>
                    </div>
                </div>

            <?php endif; ?>


            <div class="menu-item menu-control menu-control-start d-none">
                <a href="javascript:;" class="menu-link" data-toggle="app-top-menu-prev"><i class="fa fa-angle-left"></i></a>
            </div>
            <div class="menu-item menu-control menu-control-end d-none">
                <a href="javascript:;" class="menu-link" data-toggle="app-top-menu-next"><i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- Content Starts -->
    <div id="content" class="app-content">