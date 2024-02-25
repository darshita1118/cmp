<?= $this->extend('login_index') ?>
<?= $this->section('content') ?>
<?php $uri = service('uri'); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<div class="login login-with-news-feed">
	<div class="news-feed">
		<div class="news-image" style="background-image: url(<?= base_url('assets/img/login-bg/login-bg-11.jpg') ?>)"></div>
		<div class="news-caption">
			<h4 class="caption-title"><b>Welcome to Lead Dynamics Manager</b> </h4>
			<p>
				An Application to manage your entire admissions leads and enrollment process.
			</p>
		</div>
	</div>
	<div class="login-container">
		<div class="login-header mb-30px">
			<div class="brand">
				<div class="d-flex align-items-center">
					<span class="logo"></span>
					<b>LDM</b>
				</div>
				<small>Click For<?php if ($uri->getSegment(1) == 'super-login') : ?>
					<a href="<?= base_url() ?>" class="text-gray-800 text-decoration-none font-weight-bolder">Sign In as User!</a>
				<?php else : ?>
					<a href="<?= base_url('super-login') ?>" class="text-gray-800 text-decoration-none font-weight-bolder">Sign In as Admin!</a>
				<?php endif; ?></small>
			</div>
			<div class="icon">
				<i class="fa fa-sign-in-alt"></i>
			</div>
		</div>
		<div class="login-content">
			<form action="" method="POST" class="fs-13px">
				<?= csrf_field() ?>
				<div class="form-floating mb-15px">
					<select class="form-select" name="year" id="year" required>
						<option value="">-- Select --</option>
						<?php
						foreach ($sessionData as $i) : ?>
							<option value="<?= $i ?>" <?= (set_value('year') ?? old('year') == $i) ? 'Selected' : NULL ?>><?= $i ?></option>
						<?php endforeach; ?>
					</select>
					<label for="emailAddress" class="d-flex align-items-center fs-13px text-gray-600">Select Session
					</label>
				</div>
				<div class="form-floating mb-15px">
					<input type="text" class="form-control h-45px fs-13px" placeholder="Email Address" id="emailAddress" name="email" required value="<?= set_value('email') ?? old('email') ?>" autocomplete="on">
					<label for="emailAddress" class="d-flex align-items-center fs-13px text-gray-600">Email
						Address</label>
				</div>
				<div class="form-floating mb-20px position-relative">
					<input type="password" class="form-control h-45px fs-13px" placeholder="Password" id="password" name="password" required value="<?= set_value('password') ?>" autocomplete="on">
					<label for="password" class="d-flex align-items-center hide-pass-icon fs-13px text-gray-600">Password</label>
					<div class="toggle-password" id="togglePassword" style="position: absolute; top: 20px;color: #C7C8CA;;right: 20px;font-size:16px;">
						<i class="fas fa-eye" id="showPasswordIcon"></i>
						<i class="fas fa-eye-slash" id="hidePasswordIcon" style="display:none;"></i>
					</div>
				</div>
				<script>
					$(document).ready(function() {
						$("#togglePassword").click(function() {
							var passwordInput = $("#password");
							var icons = $("#showPasswordIcon, #hidePasswordIcon");
							// Toggle the password visibility
							passwordInput.attr("type", passwordInput.attr("type") === "password" ? "text" : "password");
							icons.toggle();
						});
					});
				</script>
				<?php if (isset($validation)) : ?>
					<fieldset>
						<div class="alert alert-danger">
							<?= $validation->listErrors() ?>
						</div>
					</fieldset>
				<?php endif; ?>
				<div class="form-check mb-30px">
					<input class="form-check-input" type="checkbox" value="1" id="rememberMe">
					<label class="form-check-label" for="rememberMe">
						Remember Me
					</label>
				</div>
				<div class="mb-15px">
					<button type="submit" class="btn btn-theme d-block h-45px w-100 btn-lg fs-14px">Sign me
						as <?= (($uri->getSegment(1) == 'super-login') ? 'Admin' : 'User') ?></button>
				</div>
				<hr class="bg-gray-600 opacity-2">
				<div class="text-gray-600 text-center  mb-0">
					&copy; LDM Admin All Right Reserved 2024
				</div>
			</form>
		</div>
	</div>
</div>
<?= $this->endSection() ?>