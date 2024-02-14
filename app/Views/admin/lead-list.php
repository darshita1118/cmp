<link href="<?= base_url('assets/plugins/select2/dist/css/select2.min.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>

<!-- Time -->
<!-- required files -->
<link href="<?= base_url('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') ?>"></script>


<!-- date -->
<link href=" <?= base_url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') ?>" rel="stylesheet" />

<script src=" <?= base_url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') ?>"></script>

<style>
	.timeline::before {
		left: 0;
	}

	.timeline .timeline-icon {
		position: absolute;
		width: 0;
		left: -10px;
	}

	.timeline .timeline-content {
		margin-left: 25px;
	}

	.timeline .timeline-content {
		background-color: #e1e1e1;
	}

	.timeline .timeline-content::before {
		border-right-color: #e1e1e1;
	}

	@media (max-width: 575.98px) {
		.timeline .timeline-content:before {
			top: 22px;
			left: 0;
			margin-left: -20px;

		}

		.timeline .timeline-content {
			margin-top: 0;
		}
	}
</style>

<div class="profile container-fluid p-3">
	<div class="row gx-4">
		<div class="col-xl-8 mb-xl-0">
			<div class="panel panel-inverse card border-0 ">
				<div class="card-header bg-none p-3 h5 m-0 d-flex align-items-center">
					<i class="fa fa-pen-to-square fa-lg me-2 text-gray text-opacity-50"></i>
					Profile

				</div>
				<div class="panel-body card-body p-3 text-dark fw-bold" style="overflow-y: scroll; height:400px">

					<div id="bsSpyContent">
						<div id="general" class="">
							<h4 class="d-flex align-items-center mb-2 mt-3">
								<span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:user-bold-duotone"></span> Profile Details
							</h4>
							<p>View and update your Profile Details information.</p>
							<div class="card">
								<div class="list-group list-group-flush fw-bold">
									<div class="list-group-item d-flex align-items-center">
										<div class="flex-fill">
											<span>Name :</span>&nbsp;
											<a href="javascript:;" id="username" data-type="text" data-pk="1" data-title="Enter Username">
												superuser
											</a>
										</div>
										<div class="w-100px">
											<a href="javascript:;" id="pencil" class="btn btn-secondary w-100px"><i class=" fa fa-pencil"></i> Edit</a>
										</div>
									</div>

									<div class="list-group-item d-flex align-items-center">
										<div class="flex-fill">
											<div>Mobile No.</div>
											<div class="text-body text-opacity-60">+1-202-555-0183</div>
										</div>
										<div>
											<a href="#modalEdit" data-bs-toggle="modal" class="btn btn-secondary w-100px">Edit</a>
										</div>
									</div>
									<div class="list-group-item d-flex align-items-center">
										<div class="flex-fill">
											<div>Email address</div>
											<div class="text-body text-opacity-60"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="c5b6b0b5b5aab7b185b6a0a4abb1ada0a8a0eba6aaa8">[email&#160;protected]</a>
											</div>
										</div>
										<div>
											<a href="#modalEdit" data-bs-toggle="modal" class="btn btn-secondary disabled w-100px">Edit</a>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div id="academics" class="mb-4 pb-3">
							<h4 class="d-flex align-items-center mb-2 mt-3">
								<span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:square-academic-cap-bold-duotone"></span>
								Academics
							</h4>
							<p>Review and update your Academic Profile details.</p>
							<div class="card">
								<div class="list-group list-group-flush fw-bold">
									<div class="list-group-item d-flex align-items-center">
										<div class="flex-fill">
											<span>Program:</span>

											<a href="javascript:;" id="country" data-type="select2" data-pk="1" data-value="BS" data-title="Select country" class="editable editable-click" style="background-color: rgba(0, 0, 0, 0);">B.Tech (CSE)</a>

										</div>
										<div>
											<a href="javascript:;" class="btn btn-secondary w-100px" id="country" data-type="select2" data-pk="1" data-value="BS" data-title="Select country"><i class="fa fa-pencil"></i> Edit</a>
										</div>
									</div>
									<div class="list-group-item d-flex align-items-center">
										<div class="flex-fill">
											<div>SID/Password:</div>
											<div class="text-body text-opacity-60 d-flex align-items-center">
												854625/kHoQ4h
											</div>
										</div>
										<div>
											<a href="#modalEdit" data-bs-toggle="modal" class="btn btn-secondary w-100px">Edit</a>
										</div>
									</div>
									<div class="list-group-item d-flex align-items-center">
										<div class="flex-fill">
											<div>Form Step:</div>
											<div class="text-body text-opacity-60 d-flex align-items-center">
												<i class="fa fa-circle fs-6px mt-1px fa-fw text-success me-2"></i> Pyment
											</div>
										</div>
										<div>
											<a href="#modalEdit" data-bs-toggle="modal" class="btn btn-secondary w-100px">Procced </a>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div id="studentstatus" class="mb-4 pb-3">
							<h4 class="d-flex align-items-center mb-2 mt-3 flex-wrap">
								<span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:bell-bold-duotone"></span>
								Student Status
							</h4>
							<p>Check and update your Student Status</p>
							<div class="card">
								<div class="list-group list-group-flush fw-bold">
									<div class="list-group-item d-flex align-items-center">
										<div class="flex-fill">

											<label class="form-label">Lead Status:</label>&nbsp;
											<select class="default-select2 col-md-12 ">
												<option selected>--Not Given-- </option>
												<option value="Marketing Qualifying">Marketing Qualifying </option>
												<option value="SalesQualifying">Sales Qualifying </option>
												<option value="SID Generated ">SID Generated </option>
												<option value="Admission Done ">Admission Done </option>
												<option value="Fall Out ">Fall Out </option>
												<option value="Call Back Not Answer ">Call Back Not Answer </option>
											</select>
											<a href="" data-bs-toggle="modal" class="btn btn-secondary mt-2">Update</a>

											<div></div>
										</div>
									</div>
								</div>
								<div class="list-group list-group-flush fw-bold">
									<div class="list-group-item d-flex align-items-center">
										<div class="flex-fill ">
											<div class="d-flex align-items-center flex-wrap">
												<label class="form-label">Message:</label>
												<input class="form-control mb-2" />
												<a href="" data-bs-toggle="modal" class="btn btn-secondary ">Update</a>
											</div>
										</div>
									</div>
								</div>

								<div class="list-group list-group-flush fw-bold">
									<div class="list-group-item d-flex align-items-center">
										<div class="flex-fill ">

											<label class="form-label">Date & Time:</label>
											<div class="d-flex justify-content-between mb-2">
												<div class="input-group" id="default-daterange">
													<input type="text" class="form-control" id="datepicker-autoClose" />
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
												<div class="input-group bootstrap-timepicker">
													<input id="timepicker" type="text" class="form-control" />
													<span class="input-group-text input-group-addon">
														<i class="fa fa-clock"></i>
													</span>
												</div>
											</div>
											<a href="#modalEdit" data-bs-toggle="modal" class="btn btn-secondary ">Update</a>

										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="actionInformation" class="mb-4 pb-3">
							<h4 class="d-flex align-items-center mb-2 mt-3">
								<span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:bag-4-bold-duotone"></span>

								More Action and Information
							</h4>
							<p>Edit your Contact Information for accurate and up-to-date details.</p>
							<div class="card">
								<div class="list-group list-group-flush fw-bold">
									<div class="list-group-item d-flex align-items-center">

										<div class="flex-fill">
											<div>Alternate Contact:</div>
										</div>
										<a href="#modalEdit" data-bs-toggle="modal" class="btn btn-secondary w-100px">Edit</a>
									</div>
								</div>
								<div class="list-group list-group-flush fw-bold">
									<div class="list-group-item d-flex align-items-center">

										<div class="flex-fill">
											<div>Address</div>
										</div>
										<a href="#modalEdit" data-bs-toggle="modal" class="btn btn-secondary w-100px">Edit</a>
									</div>
								</div>
								<div class="list-group list-group-flush fw-bold">
									<div class="list-group-item d-flex align-items-center">

										<div class="flex-fill">
											<div>Transfer Lead</div>
										</div>
										<a href="#modalEdit" data-bs-toggle="modal" class="btn btn-warning w-100px">Transfer</a>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>
		</div>
		<div class="col-xl-4">
			<div class="card border-0 mb-4">
				<div class="card-header bg-none p-3 h5 m-0 d-flex align-items-center">
					<span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:call-chat-bold-duotone"></span>
					Contact
				</div>
				<div class="card-body">
					<div class="d-flex flex-wrap">
						<a href="https://wa.me/1234567890" target="_blank" class="widget-icon rounded bg-success me-4  text-white text-decoration-none">
							<i class="fa-brands fa-whatsapp fs-30px"></i>
						</a>
						<a href="tel:+1234567890" class="widget-icon rounded bg-success me-4  text-white text-decoration-none">
							<i class="fa-solid fa-phone fs-2"></i>
						</a>
						<div class="widget-icon rounded bg-success me-4  text-white text-decoration-none">
							<div data-bs-target="#modalmail" data-bs-toggle="modal"><i class="fa-solid fa-envelope fs-27px"></i></div>
							<div class="modal fade" id="modalmail">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title text-dark">SEND Email</h5>
											<button type="button" class="btn-close fs-4" data-bs-dismiss="modal"></button>
										</div>
										<div class="modal-body">
											<div class="">
												<label class="text-dark h4">Select Email Template</label>
												<select class="form-select">...
													<option selected>--Select Email Template-- </option>
													<option value="1">Admin</option>
													<option value="2">Handler</option>
												</select>
											</div>
											<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
											<button type="button" class="btn btn-theme">Save changes</button>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div href="" class="widget-icon rounded bg-success me-4  text-white text-decoration-none">
							<div data-bs-target="#modalsms" data-bs-toggle="modal"><i class="fa-solid fa-comment-sms fs-30px"></i></div>

							<div class="modal fade" id="modalsms">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title text-dark">SEND SMS</h5>
											<button type="button" class="btn-close fs-4" data-bs-dismiss="modal"></button>
										</div>
										<div class="modal-body">
											<div class="">
												<label class="text-dark h4">Select SMS Template</label>
												<select class="form-select">...
													<option selected>--Select SMS Template-- </option>
													<option value="1">Admin</option>
													<option value="2">Handler</option>
												</select>

												<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
												<button type="button" class="btn btn-theme">Submit</button>

											</div>
										</div>

									</div>

								</div>
							</div>
						</div>
						<div class="media-icon mt-2"><a href="#" class="btn btn-secondary">Write A message</a></div>
					</div>
				</div>
			</div>
			<div class="card border-0 mb-4">
				<div class="card-header bg-none p-3 h5 m-0 d-flex align-items-center">
					<span class="iconify fs-24px me-2 text-body text-opacity-75 my-n1" data-icon="solar:file-bold-duotone"></span>
					History
				</div>
				<div class="card-body  fw-bold" style="overflow-y: scroll; height:250px">
					<div class="profile-content">
						<div class="tab-content p-0">
							<div class="tab-pane fade show active" id="profile-post">
								<div class="timeline">
									<div class="timeline-item">
										<div class="timeline-icon">
											<a href="javascript:;">&nbsp;</a>
										</div>
										<div class="timeline-content ">
											<div class="timeline-header">
												<div class="username">
													<a href="javascript:;">John Smith <i class="fa fa-check-circle text-blue ms-1"></i></a>
													<div class="text-muted fs-12px"><span class="date">today</span>
														<span class="time">04:20</span> <i class="fa fa-globe-americas opacity-5 "></i>
													</div>
												</div>
											</div>
											<div class="timeline-body">
												<small> Enquery For: DIPLOMA</small><br>
												<small>lead status: Not Given</small><br>
												<small>Source Of Lead: : Apply Now</small><br>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-icon">
											<a href="javascript:;">&nbsp;</a>
										</div>
										<div class="timeline-content ">
											<div class="timeline-header">
												<div class="username">
													<a href="javascript:;">Darren Parrase</a>
													<div class="text-muted fs-12px">24 mins <i class="fa fa-globe-americas opacity-5 ms-1"></i></div>
												</div>
											</div>
											<div class="timeline-body">
												<div class="mb-2">Location: United States</div>
												<p>Lorem ipsum dolor sitconsectetur adipiscing elit. Nunc faucibus
													turpis quis tincidunt luctus.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-icon">
											<a href="javascript:;">&nbsp;</a>

										</div>
										<div class="timeline-content ">
											<div class="timeline-header">
												<div class="username">
													<a href="javascript:;">Darren Parrase</a>
													<div class="text-muted fs-12px">24 mins <i class="fa fa-globe-americas opacity-5 ms-1"></i></div>
												</div>
											</div>
											<div class="timeline-body">
												<div class="mb-2">Location: United States</div>
												<p>Lorem ipsum dolor sitconsectetur adipiscing elit. Nunc faucibus
													turpis quis tincidunt luctus.</p>
											</div>
										</div>
									</div>
									<div class="timeline-item">
										<div class="timeline-icon">
											<a href="javascript:;">&nbsp;</a>

										</div>
										<div class="timeline-content ">
											<div class="timeline-header">
												<div class="username">
													<a href="javascript:;">Darren Parrase</a>
													<div class="text-muted fs-12px">24 mins <i class="fa fa-globe-americas opacity-5 ms-1"></i></div>
												</div>
											</div>
											<div class="timeline-body">
												<div class="mb-2">Location: United States</div>
												<p>Lorem ipsum dolor sitconsectetur adipiscing elit. Nunc faucibus
													turpis quis tincidunt luctus.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>


<script>
	$("#timepicker").timepicker();
	$(".default-select2").select2();
	$("#datepicker-autoClose").datepicker({
		todayHighlight: true,
		autoclose: true
	});
</script>

<script src="<?= base_url('assets/js/iconify.min.js') ?>" type="text/javascript"></script>