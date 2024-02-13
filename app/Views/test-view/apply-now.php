
<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head><base href="<?= base_url() ?>">
		<meta charset="utf-8" />
		<title>Apply Now Session 2021-22 |Distance Education of Suresh Gyan Vihar University</title>
		<meta name="description" content="Apply Now Session 2021-22" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="assets/css/pages/login/classic/login-1.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<!--begin::Aside-->
				<div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10" style="background-image: url(assets/media/bg/bg-9.jpg);">
					<!--begin: Aside Container-->
					<div class="d-flex flex-row-fluid flex-column justify-content-between">
						<!--begin: Aside header-->
						<a href="#" class="flex-column-auto mt-5 pb-lg-0 pb-10">
							<img src="assets/media/logos/sgvu-distance.png" class="max-h-70px" alt="" />
						</a>
						<!--end: Aside header-->
						<!--begin: Aside content-->
						<div class="flex-column-fluid d-flex flex-column justify-content-center">
							<h3 class="font-size-h1 mb-5 text-dark">Welcome to Distance Education</h3>
							<p class="font-weight-lighter text-dark opacity-80">Suresh Gyan Vihar University</p>
						</div>
						<!--end: Aside content-->
						<!--begin: Aside footer for desktop-->
						<div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
							<div class="opacity-70 font-weight-bold text-dark">© 2021 Distance Education</div>
							
						</div>
						<!--end: Aside footer for desktop-->
					</div>
					<!--end: Aside Container-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">
					
					<!--begin::Content body-->
					<div class="d-flex flex-column-fluid flex-center mt-10 mt-lg-0">
						<!--begin::Signin-->
						<div class="login-form login-signin">
							<div class="text-center mb-10 mb-lg-20">
								<h3 class="font-size-h1">Apply Now</h3>
								<p class="text-muted font-weight-bold">Session 2021-22</p>
							</div>
							<!--begin::Form-->
							<form class="form" method="POST" id="form">
								<?= csrf_field() ?>
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-3 px-6" type="text" placeholder="Name" name="name" autocomplete="on" required/>
								</div>
								<div class="form-group">
									<input class="form-control form-control-solid h-auto py-3 px-6" type="email" placeholder="Email" name="email" autocomplete="on" required/>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<select class="form-control form-control-solid h-auto py-3 px-6" name="country_code" id="country_code" style="border-top-right-radius: 0px;border-bottom-right-radius:0px; border-right:0">
											<?php foreach($countries as $country): ?>
                                                                
												<option  value="<?= $country['code'] ?>" <?= old('country_code') == $country['code'] ? 'selected' : ($country['code'] == '+91'?'selected':null) ?>> (<?= $country['isoCode'] ?>) <?= $country['code'] ?> </option>
											<?php endforeach; ?>
											</select>
										</div>
										<input type="tel" style="border-left:0" class="form-control form-control-solid h-auto py-3 px-6" name="mobile" placeholder="Mobile No." required>
									</div>
								</div>
								<div class="form-group">
									<select class="form-control form-control-solid h-auto py-3 px-6" name="course" id="course" onchange="$('#department').val($(this).find(':selected').attr('data-level'))
                                                ; $('#level').val($(this).find(':selected').attr('data-department'))
                                                ;">
										<option>--select course--</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
								<?php if (isset($validation)) : ?>
									<div class="form-group">
										<div class="alert alert-danger pt-1 text-danger" style="background-color: transparent;border-color: transparent;">
											<?= $validation->listErrors() ?>
										</div>
									</div>
								<?php endif; ?>
								<input type="hidden" id="department" name="department" value="">
								<input type="hidden" id='level' name="level" value="">
								<!--begin::Action-->
								<div class="form-group d-flex flex-wrap justify-content-between align-items-center">
									
									<button type="submit" name="btntype" value="sid_create" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Submit</button>
								</div>
								<!--end::Action-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Signin-->
						
					</div>
					<!--end::Content body-->
					<!--begin::Content footer for mobile-->
					<div class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
						<div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">© <?= date('Y') ?> Distance Education</div>
						
					</div>
					<!--end::Content footer for mobile-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script>
			<?php if(set_value('department')): ?>
				$('#department').val(<?= set_value('department') ?>)                         
			<?php endif; ?>
			<?php if(set_value('level')): ?>
				$('#level').val(<?= set_value('level') ?>)                         
			<?php endif; ?>

		</script>
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="assets/js/pages/custom/login/login-general.js"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>