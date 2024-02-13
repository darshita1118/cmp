<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
	<!--begin::Brand-->
	<div class="brand flex-column-auto" id="kt_brand">
		<!--begin::Logo-->
		<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
			<i class="ki ki-menu-grid icon-x"></i>
		</button>
		<!--end::Toolbar-->
		<!--begin::Logo-->
		<a href="<?= base_url()?>" class="brand-logo mr-auto ml-3">
			<img alt="Logo" src="<?= base_url() ?>/assets/media/logos/logo.png" style="height: 35px;" />
		</a>
		<!--end::Toolbar-->
	</div>
	<!--end::Brand-->
	<!--begin::Aside Menu-->
	<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
		<!--begin::Menu Container-->
		<div id="kt_aside_menu" class="aside-menu mt-0 mb-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
			<!--begin::Menu Nav-->
			<ul class="menu-nav pt-0 pb-2">
				<li class="menu-item menu-item-active" aria-haspopup="true">
					<a href="<?= base_url('/') ?>" class="menu-link">
						<span class="svg-icon menu-icon" style="background:#009688">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Design/Layers.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
									<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
						<span class="menu-text">Dashboard</span>
					</a>
				</li>



				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon" style="background:#780116">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Shopping/Barcode-read.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
									<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
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
							<?php if(session('role') == 1): ?>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="<?= base_url('handler/leads') ?>" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-line">
										<span></span>
									</i>
									<span class="menu-text">All Leads</span>
								</a>
							</li>
							<?php endif; ?>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="<?= base_url('handler') ?>" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-line">
										<span></span>
									</i>
									<span class="menu-text">Self Allocated Leads</span>
								</a>
							</li>
							<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
								<a href="<?= base_url('handler/add-lead') ?>" class="menu-link menu-toggle">
									<i class="menu-bullet menu-bullet-line">
										<span></span>
									</i>
									<span class="menu-text">Add Lead</span>

								</a>

							</li>


						</ul>
					</div>
				</li>
				<?php if(session('role') == 1): ?>
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
			                        <span class="menu-text">Members</span>
			                        <i class="menu-arrow"></i>
			
			                    </a>
								
			                    <div class="menu-submenu" kt-hidden-height="400" style="display: none; overflow: hidden;">
			                        <i class="menu-arrow"></i>
			                        <ul class="menu-subnav">
			                            <li class="menu-item menu-item-parent" aria-haspopup="true">
			                                <span class="menu-link">
			                                    <span class="menu-text">>All Members</span>
			                                </span>
			                            </li>
			                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
			                                <a href="<?= base_url('handler/members') ?>" class="menu-link menu-toggle">
			                                    <i class="menu-bullet menu-bullet-line">
			                                        <span></span>
			                                    </i>
			                                    <span class="menu-text">All Members</span>
			                                </a>
			                            </li>
			                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
			                                <a href="<?= base_url('handler/create-member') ?>" class="menu-link menu-toggle">
			                                    <i class="menu-bullet menu-bullet-line">
			                                        <span></span>
			                                    </i>
			                                    <span class="menu-text">Create Member</span>
			                                </a>
			                            </li>
			                        </ul>
			                    </div>
			                </li>
				<?php endif; ?>

				<li class="menu-item menu-item-submenu <?= (url_is('handler/reports') || url_is('handler/report/created-sid') || url_is('handler/report/registration') || url_is('handler/report/admission-done'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
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
		                    <div class="menu-submenu" kt-hidden-height="400" style="display: <?= (url_is('handler/reports') || url_is('handler/report/created-sid') || url_is('handler/report/registration') || url_is('handler/report/admission-done'))?'block':'none' ?>; overflow: hidden;">
		                        <i class="menu-arrow"></i>
		                        <ul class="menu-subnav">
		                            <li class="menu-item menu-item-parent" aria-haspopup="true">
		                                <span class="menu-link">
		                                    <span class="menu-text">Reports</span>
		                                </span>
		                            </li>
		                            <li class="menu-item menu-item-submenu <?= (url_is('handler/reports'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
		                                <a href="<?= base_url('handler/reports') ?>" class="menu-link menu-toggle">
		                                    <i class="menu-bullet menu-bullet-line">
		                                        <span></span>
		                                    </i>
		                                    <span class="menu-text">Report Stats</span>
		
		
		                                </a>
		
		                            </li>
		                            <li class="menu-item menu-item-submenu <?= (url_is('handler/report/created-sid'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
		                                <a href="<?= base_url('handler/report/created-sid') ?>" class="menu-link menu-toggle">
		                                    <i class="menu-bullet menu-bullet-line">
		                                        <span></span>
		                                    </i>
		                                    <span class="menu-text">Created Sid List</span>
		                                </a>
		
		                            </li>
		                            <li class="menu-item menu-item-submenu <?= (url_is('handler/report/registration'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
		                                <a href="<?= base_url('handler/report/registration') ?>" class="menu-link menu-toggle">
		                                    <i class="menu-bullet menu-bullet-line">
		                                        <span></span>
		                                    </i>
		                                    <span class="menu-text">Registration List</span>
		                                </a>
		
		                            </li>
		                            <li class="menu-item menu-item-submenu <?= (url_is('handler/report/admission-done'))?'menu-item-active':null ?>" aria-haspopup="true" data-menu-toggle="hover">
		                                <a href="<?= base_url('handler/report/admission-done') ?>" class="menu-link menu-toggle">
		                                    <i class="menu-bullet menu-bullet-line">
		                                        <span></span>
		                                    </i>
		                                    <span class="menu-text">Admission Done List</span>
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
				<li class="menu-item <?= url_is('handler/tickets*')?'menu-item-active':null ?>" aria-haspopup="true">
                    <a href="<?= base_url('handler/tickets') ?>" class="menu-link">
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
					<h4 class="menu-text">Fees Status

					</h4>
					<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>

				<li class="menu-item" aria-haspopup="true">
					<a href="<?= base_url('handler/under-construction') ?>" class="menu-link">
						<span class="svg-icon menu-icon" style="background:#B10000">
							<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Home/Library.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000" />
									<path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
						<span class="menu-text">Fees History</span>
					</a>
				</li>
				<li class="menu-section">
					<h4 class="menu-text">By Self

					</h4>
					<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>
				<li class="menu-item" aria-haspopup="true">
					<a href="<?= base_url('handler/applicant-list') ?>" class="menu-link">
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
						<span class="menu-text">Proceed Application</span>

					</a>

				</li>
				<li class="menu-item" aria-haspopup="true">
		                    <a href="<?= base_url('handler/application-form-reopen') ?>" class="menu-link">
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


			</ul>
			<!--end::Menu Nav-->
		</div>
		<!--end::Menu Container-->
	</div>
	<!--end::Aside Menu-->
</div>
<!--end::Aside-->