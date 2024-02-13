	<div id="app" class="app app-header-fixed app-sidebar-fixed app-without-sidebar app-with-top-menu">


		<div id="header" class="app-header">

			<div class="navbar-header">
				<a href="<?= base_url('dashboard') ?>" class="navbar-brand"><span class="navbar-logo"></span> <b class="me-3px">CMP</b>
					Admin</a>
				<button type="button" class="navbar-mobile-toggler" data-bs-toggle="collapse" data-bs-target="#top-navbar">
					<span class="fa-stack fa-lg">
						<i class="far fa-square fa-stack-2x"></i>
						<i class="fas fa-cog fa-stack-1x p-2"></i>
					</span>
				</button>
				<button type="button" class="navbar-mobile-toggler" data-toggle="app-top-menu-mobile">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse d-md-block me-auto" id="top-navbar">
				<div class="navbar-nav">
					<div class="navbar-item">
						<a href="javascript:;" class="navbar-link d-flex align-items-center">
							<i class="fas fa-ticket fa-fw me-1"></i>
							<span class="d-lg-inline d-md-none">Tickets</span>
						</a>
					</div>
					<div class="navbar-item dropdown">
						<a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
							<i class="fas fa-database fa-fw me-1"></i>
							<span class="d-lg-inline d-md-none">By Self</span>
							<b class="caret ms-1"></b>
						</a>
						<div class="dropdown-menu">
							<a href="<?= base_url('processapp') ?>" class="dropdown-item">Process Application</a>
							<a href="<?= base_url('error_404') ?>" class="dropdown-item">Reopened Application Form</a>
						</div>
					</div>
					<div class="navbar-item dropdown">
						<a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
							<i class="fas fa-chart-pie fa-fw me-1"></i>
							<span class="d-lg-inline d-md-none">Reports</span>
							<b class="caret ms-1"></b>
						</a>
						<div class="dropdown-menu">
							<a href="<?= base_url('reportstats') ?>" class="dropdown-item">Report Stats</a>
							<a href="javascript:;" class="dropdown-item"> Created Sid List</a>
							<a href="javascript:;" class="dropdown-item"> Registration List</a>
							<a href="javascript:;" class="dropdown-item"> Admission Done List</a>
							<a href="javascript:;" class="dropdown-item"> Student Learning</a>
							<a href="javascript:;" class="dropdown-item"> counselor Work Report</a>
						</div>
					</div>
				</div>
			</div>

			<div class="navbar-nav">
				<div class="navbar-item navbar-form">
					<form action="" method="POST" name="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Enter keyword">
							<button type="submit" class="btn btn-search"><i class="fas fa-search"></i></button>
						</div>
					</form>
				</div>
				<div class="navbar-item dropdown">
					<a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle icon">
						<i class="fas fa-bell"></i>
						<span class="badge">5</span>
					</a>
					<div class="dropdown-menu media-list dropdown-menu-end">
						<div class="dropdown-header">NOTIFICATIONS (5)</div>
						<a href="javascript:;" class="dropdown-item media">
							<div class="media-left">
								<i class="fas fa-bug media-object bg-gray-500"></i>
							</div>
							<div class="media-body">
								<h6 class="media-heading">Server Error Reports <i class="fas fa-exclamation-circle text-danger"></i></h6>
								<div class="text-muted fs-10px">3 minutes ago</div>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item media">
							<div class="media-left">
								<img src="../assets/img/user/user-1.jpg" class="media-object" alt="">
								<i class="fab fa-facebook-messenger text-blue media-object-icon"></i>
							</div>
							<div class="media-body">
								<h6 class="media-heading">John Smith</h6>
								<p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
								<div class="text-muted fs-10px">25 minutes ago</div>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item media">
							<div class="media-left">
								<img src="../assets/img/user/user-2.jpg" class="media-object" alt="">
								<i class="fab fa-facebook-messenger text-blue media-object-icon"></i>
							</div>
							<div class="media-body">
								<h6 class="media-heading">Olivia</h6>
								<p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
								<div class="text-muted fs-10px">35 minutes ago</div>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item media">
							<div class="media-left">
								<i class="fas fa-plus media-object bg-gray-500"></i>
							</div>
							<div class="media-body">
								<h6 class="media-heading"> New User Registered</h6>
								<div class="text-muted fs-10px">1 hour ago</div>
							</div>
						</a>
						<a href="javascript:;" class="dropdown-item media">
							<div class="media-left">
								<i class="fas fa-envelope media-object bg-gray-500"></i>
								<i class="fab fa-google text-warning media-object-icon fs-14px"></i>
							</div>
							<div class="media-body">
								<h6 class="media-heading"> New Email From John</h6>
								<div class="text-muted fs-10px">2 hour ago</div>
							</div>
						</a>
						<div class="dropdown-footer text-center">
							<a href="javascript:;" class="text-decoration-none">View more</a>
						</div>
					</div>
				</div>
				<div class="navbar-item navbar-user dropdown">
					<a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
						<img src="<?= base_url('assets/img/user/user-13.jpg') ?>" alt="">
						<span>
							<span class="d-none d-md-inline">Rahul Sharma</span>
							<b class="caret"></b>
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-end me-1">
						<a href="extra_profile.html" class="dropdown-item">Edit Profile</a>
						<a href="email_inbox.html" class="dropdown-item d-flex align-items-center">
							Inbox
							<span class="badge bg-danger rounded-pill ms-auto pb-4px">2</span>
						</a>
						<a href="calendar.html" class="dropdown-item">Calendar</a>
						<a href="extra_settings_page.html" class="dropdown-item">Settings</a>
						<div class="dropdown-divider"></div>
						<a href="login.html" class="dropdown-item">Log Out</a>
					</div>
				</div>
			</div>

		</div>

		<div id="top-menu" class="app-top-menu" data-bs-theme="dark">
			<div class="menu">
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
							<a href="<?= base_url('allleads') ?>" class="menu-link">
								<div class="menu-text">All Leads</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('createleads') ?>" class="menu-link">
								<div class="menu-text">Create Lead</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('bulkuplead') ?>" class="menu-link">
								<div class="menu-text">Bulk Upload Lead</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('allocatedleads') ?>" class="menu-link">
								<div class="menu-text">Allocated Leads</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('unallocatedleads') ?>" class="menu-link">
								<div class="menu-text">Unallocated Leads</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('selfassignleads') ?>" class="menu-link">
								<div class="menu-text">Self Assign Leads</div>
							</a>
						</div>
						<div class="menu-item has-sub">
							<a href="javascript:;" class="menu-link">
								<div class="menu-text">Transfer Lead</div>
								<div class="menu-caret"></div>
							</a>
							<div class="menu-submenu">
								<div class="menu-item"><a href="javascript:;" class="menu-link">
										<div class="menu-text">To</div>
									</a></div>
								<div class="menu-item"><a href="javascript:;" class="menu-link">
										<div class="menu-text">Form</div>
									</a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="menu-item has-sub">
					<a href="javascript:;" class="menu-link">
						<div class="menu-icon">
							<i class="fas fa-users-gear"></i>
						</div>
						<div class="menu-text">counselors</div>
						<div class="menu-caret"></div>
					</a>
					<div class="menu-submenu">
						<div class="menu-item">
							<a href="<?= base_url('allcounselor') ?>" class="menu-link">
								<div class="menu-text">All counselor</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('createcounselor') ?>" class="menu-link">
								<div class="menu-text">Create counselor</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('error_404') ?>" class="menu-link">
								<div class="menu-text">counselor Report</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('error_404') ?>" class="menu-link">
								<div class="menu-text">Work Load Management Leads</div>
							</a>
						</div>
					</div>
				</div>
				<div class="menu-item has-sub">
					<a href="javascript:;" class="menu-link">
						<div class="menu-icon">
							<i class="fas fa-check-to-slot"></i>
						</div>
						<div class="menu-text">Lead Status</div>
						<div class="menu-caret"></div>
					</a>
					<div class="menu-submenu">
						<div class="menu-item">
							<a href="<?= base_url('allstatus') ?>" class="menu-link">
								<div class="menu-text">All Status</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('createstatus') ?>" class="menu-link">
								<div class="menu-text">Create Status</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('error_404') ?>" class="menu-link">
								<div class="menu-text">Adjects Status Score</div>
							</a>
						</div>
					</div>
				</div>
				<div class="menu-item has-sub">
					<a href="javascript:;" class="menu-link">
						<div class="menu-icon">
							<i class="fas fa-cloud-arrow-up"></i>
						</div>
						<div class="menu-text">Lead Source</div>
						<div class="menu-caret"></div>
					</a>
					<div class="menu-submenu">
						<div class="menu-item">
							<a href="<?= base_url('allsource') ?>" class="menu-link">
								<div class="menu-text">All Source</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('createsource') ?>" class="menu-link">
								<div class="menu-text">Create Source</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('error_404') ?>" class="menu-link">
								<div class="menu-text">Adjects Source Score</div>
							</a>
						</div>
					</div>
				</div>

				<div class="menu-item has-sub">
					<a href="javascript:;" class="menu-link">
						<div class="menu-icon">
							<i class="fas fa-comments"></i>
						</div>
						<div class="menu-text">Notification</div>
						<div class="menu-caret"></div>
					</a>
					<div class="menu-submenu">
						<div class="menu-item">
							<a href="<?= base_url('allleads') ?>" class="menu-link">
								<div class="menu-text">All Notification</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('allleads') ?>" class="menu-link">
								<div class="menu-text">Create Notification</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('allleads') ?>" class="menu-link">
								<div class="menu-text">Adjects Source Score</div>
							</a>
						</div>
					</div>
				</div>

				<div class="menu-item has-sub">
					<a href="javascript:;" class="menu-link">
						<div class="menu-icon">
							<i class="fas fa-random"></i>
						</div>
						<div class="menu-text">Event</div>
						<div class="menu-caret"></div>
					</a>
					<div class="menu-submenu">
						<div class="menu-item">
							<a href="<?= base_url('allleads') ?>" class="menu-link">
								<div class="menu-text">All Events</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('allleads') ?>" class="menu-link">
								<div class="menu-text">Create Events</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('allleads') ?>" class="menu-link">
								<div class="menu-text">Adjects Source Score</div>
							</a>
						</div>
					</div>
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
							<a href="<?= base_url('loghiscou') ?>" class="menu-link">
								<div class="menu-text">Login History Counselors</div>
							</a>
						</div>
						<div class="menu-item">
							<a href="<?= base_url('loghisadm') ?>" class="menu-link">
								<div class="menu-text">Login History Admins</div>
							</a>
						</div>
					</div>
				</div>


				<div class="menu-item menu-control menu-control-start">
					<a href="javascript:;" class="menu-link" data-toggle="app-top-menu-prev"><i class="fas fa-angle-left"></i></a>
				</div>
				<div class="menu-item menu-control menu-control-end">
					<a href="javascript:;" class="menu-link" data-toggle="app-top-menu-next"><i class="fas fa-angle-right"></i></a>
				</div>

			</div>
		</div>


		<div id="content" class="app-content">