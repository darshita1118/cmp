	<!-- App Body Start -->
	<div id="app" class="app app-header-fixed app-sidebar-fixed app-without-sidebar app-with-top-menu">
		<!-- header -->
		<div id="header" class="app-header">
			<div class="navbar-header">
				<a href="<?= base_url('/') ?>" class="navbar-brand"><span class="navbar-logo"></span> <b class="me-3px">LDM</b>
				</a>
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
						<a href="<?= base_url('/admin/logout'); ?>" class="dropdown-item">Log Out</a>
					</div>
				</div>
			</div>
		</div>
		<!-- top-menu -->
		<div id="top-menu" class="app-top-menu" data-bs-theme="dark">
			<div class="menu">
				<div class="menu-item ">
					<a href="<?= base_url('/') ?>" class="menu-link">

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
						<div class="menu-item">
							<a href="<?= base_url('admin/leads') ?>" class="menu-link">
								<div class="menu-text">All Leads</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/add-lead') ?>" class="menu-link ">
								<div class="menu-text">Create Lead</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/bulk-upload-lead') ?>" class="menu-link">
								<div class="menu-text">Bulk Upload Lead</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/allocated-leads') ?>" class="menu-link">
								<div class="menu-text">Allocated Leads</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/unallocated-leads') ?>" class="menu-link">
								<div class="menu-text">Unallocated Leads</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/self-assign-lead') ?>" class="menu-link">
								<div class="menu-text">Self Assign Leads</div>
							</a>
						</div>
					</div>
				</div>
				<div class="menu-item has-sub">
					<a href="javascript:;" class="menu-link">
						<div class="menu-icon">
							<i class="fas fa-users-gear"></i>
						</div>
						<div class="menu-text">Counsellors</div>
						<div class="menu-caret"></div>
					</a>
					<div class="menu-submenu">
						<div class="menu-item">
							<a href="<?= base_url('admin/handlers') ?>" class="menu-link">
								<div class="menu-text">All Counsellors</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/create-handler') ?>" class="menu-link">
								<div class="menu-text">Create Counsellors</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/under-construction') ?>" class="menu-link">
								<div class="menu-text">Counsellors Report</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/under-construction') ?>" class="menu-link">
								<div class="menu-text">Work Load Management Leads</div>
							</a>
						</div>
					</div>
				</div>
				<div class="menu-item has-sub">
					<a href="javascript:;" class="menu-link">
						<div class="menu-icon">
							<i class="fa fa-file-lines"></i>
						</div>
						<div class="menu-text">Application Form</div>
						<div class="menu-caret"></div>
					</a>
					<div class="menu-submenu">
						<div class="menu-item">
							<a href="<?= base_url('admin/applicant-list') ?>" class="menu-link">
								<div class="menu-text">Process Application</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/application-form-reopen') ?>" class="menu-link">
								<div class="menu-text">Reopened Application</div>
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
							<a href="<?= base_url('admin/reports') ?>" class="menu-link">
								<div class="menu-text">Report Stats</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/report/created-sid') ?>" class="menu-link">
								<div class="menu-text">Created Sid List</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/report/registration') ?>" class="menu-link">
								<div class="menu-text">Registration List</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/report/admission-done') ?>" class="menu-link">
								<div class="menu-text">Admission Done List</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/student-learning-report') ?>" class="menu-link">
								<div class="menu-text">Student Learning</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/reportall') ?>" class="menu-link">
								<div class="menu-text">Counselor Work Report</div>
							</a>
						</div>
					</div>
				</div>
				<div class="menu-item has-sub">
					<a href="javascript:;" class="menu-link">
						<div class="menu-icon">
							<i class="fa fa-chart-column"></i>
						</div>
						<div class="menu-text">Lead Status</div>
						<div class="menu-caret"></div>
					</a>
					<div class="menu-submenu">
						<div class="menu-item">
							<a href="<?= base_url('admin/status-list') ?>" class="menu-link">
								<div class="menu-text">All Status</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/create-status') ?>" class="menu-link">
								<div class="menu-text">Create Status</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/under-construction') ?>" class="menu-link">
								<div class="menu-text">Adjust Status Score</div>
							</a>
						</div>
					</div>
				</div>
				<div class="menu-item has-sub">
					<a href="javascript:;" class="menu-link">
						<div class="menu-icon">
							<i class="fas fa-cloud-arrow-down"></i>
						</div>
						<div class="menu-text">Lead Source</div>
						<div class="menu-caret"></div>
					</a>
					<div class="menu-submenu">
						<div class="menu-item">
							<a href="<?= base_url('admin/source-list') ?>" class="menu-link">
								<div class="menu-text">All Source</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/create-source') ?>" class="menu-link">
								<div class="menu-text">Create Source</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/under-construction') ?>" class="menu-link">
								<div class="menu-text">Adjusts Source Score</div>
							</a>
						</div>
					</div>
				</div>
				<div class="menu-item ">
					<a href="<?= base_url('admin/tickets') ?>" class="menu-link">

						<div class="menu-icon">
							<i class="fa fa-ticket"></i>
						</div>

						<div class="menu-text">Tickets </div>
					</a>
				</div>
				<div class="menu-item has-sub">
					<a href="javascript:;" class="menu-link">
						<div class="menu-icon">
							<i class="fas fa-plus-square"></i>
						</div>
						<div class="menu-text">Login History</div>
						<div class="menu-caret"></div>
					</a>
					<div class="menu-submenu">
						<div class="menu-item">
							<a href="<?= base_url('admin/login_history/handlers') ?>" class="menu-link">
								<div class="menu-text">Login History Counselors</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('admin/login_history/admins') ?>" class="menu-link">
								<div class="menu-text">Login History Admins</div>
							</a>
						</div>
					</div>
				</div>



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