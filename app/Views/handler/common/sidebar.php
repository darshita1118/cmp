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
				<div class="offcanvas offcanvas-top ps-5 pe-5" tabindex="-1" id="offcanvasTopst" aria-labelledby="offcanvasTopLabel">
					<div class="offcanvas-header border-bottom">
						<h5 id="offcanvasTopLabel">Our Stacks</h5>
						<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body mt-md-3">
						<div class="row">
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
							</div>
							<div class="col-md-2">
								<!-- begin widget-stats -->
								<div class="widget widget-stats bg-teal mb-10px">
									<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
									<div class="stats-content">
										<div class="stats-title">Marketing Qalifay</div>
										<div class="stats-number">7,842,900</div>
									</div>
								</div>
								<!-- end widget-stats -->
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
								<div class="menu-text">Self Allocated Leads</div>
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
							<i class="fa fa-podcast"></i>
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


				<div class="menu-item menu-control menu-control-start">
					<a href="javascript:;" class="menu-link" data-toggle="app-top-menu-prev"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="menu-item menu-control menu-control-end">
					<a href="javascript:;" class="menu-link" data-toggle="app-top-menu-next"><i class="fa fa-angle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- Content Starts -->
		<div id="content" class="app-content">