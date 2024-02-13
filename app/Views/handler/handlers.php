<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">

			<!--begin::Card-->
			<div class="card card-custom gutter-b">
				<div class="card-header flex-wrap py-3">
					<div class="card-title">
						<h3 class="card-label">Team Members [Totals: <?= $total_records??0 ?>]

						</h3>
					</div>
					<div class="card-toolbar">
						<!--begin::Dropdown-->

						<!--end::Dropdown-->
						<!--begin::Button-->
						<a href="<?= base_url('handler/create-member') ?>" class="btn btn-primary font-weight-bolder">
							<span class="svg-icon svg-icon-md">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<circle fill="#000000" cx="9" cy="15" r="6" />
										<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>New Member</a>
						<!--end::Button-->
					</div>
				</div>
				<div class="card-body">
					<div class="row mx-0">
						<div class="col-lg-12">

							<form action="" method="get">
								<div class="row">
									<div class="col-lg-3 col-xl-3">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <div class="input-icon">
                                                <input type="tel" name="mobile" class="form-control" placeholder="Search mobile no.." minlength="8" value="<?= isset($_GET['mobile']) ? $_GET['mobile'] : null ?>" maxlength="12">
                                                <span>
                                                    <i class="flaticon2-search-1 text-muted"></i>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
									<div class="col-lg-3 col-xl-3">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <div class="input-icon">
                                                <input type="email" name="email" class="form-control" placeholder="Search email " maxlength="255" value="<?= isset($_GET['email']) ? $_GET['email'] : null ?>">
                                                <span>
                                                    <i class="flaticon2-search-1 text-muted"></i>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
									
									<div class="col-lg-3 col-xl-3 form-group">
										<label for="">&nbsp;</label>
										<button type="submit" class="form-control btn btn-light-primary font-weight-bold">Search</button>

									</div>
								</div>

							</form>
						</div>
						<div class="col-lg-12">
							<form id="handlerForm" class="d-none" action="<?= base_url('handler/bulk-action') ?>" method="post">
								<?= csrf_field() ?>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label for="actionType">Action</label>
											<select name="actionType" id="actionType" onchange="showOption(this.value)" class="form-control" required>
												<option value="">--Select--</option>
												<option value="4">Active</option>
												<option value="2">Suspend</option>
												
												<option value="1">Change Password</option>
											</select>
										</div>
									</div>
									<div id="actionOption" class="col-md-10">


									</div>
								</div>

							</form>
							<!--begin: Datatable-->
							<table class="table table-bordered table-checkable" id="kt_datatable">
								<thead>
									<tr>
										<th>S. No.</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Role</th>
										<th>Status(Current)</th>
										<th>Created At</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $count = 1;
									foreach ($handlers as $handler) : ?>
										<tr>
											<td>
												<label class="checkbox checkbox-single">
													<input type="checkbox" form="handlerForm" name="hid[]" value="<?= $handler['lu_id'] ?>" class="checkable form-control" />
													<span></span>
												</label>

											</td>
											<td><?= $handler['user_name'] ?></td>
											<td><a href="mailto:<?= $handler['user_email'] ?>"><?= $handler['user_email'] ?></a></td>
											<td><a href="tel:<?= $handler['user_mobile'] ?>"><?= $handler['user_mobile'] ?></a></td>
											<td><?= $handler['user_role'] == 1 ? 'Team Leader' : 'Handler' ?></td>
											<td><?= $handler['user_status'] == 1 ? 'Active' : 'Suspend' ?></td>
											<td><?= date('l d M Y', strtotime($handler['user_created_at'])) ?></td>
											<td>
												<a href="<?= base_url('handler/edit-member/' . $handler['lu_id']) ?>" class="btn btn-sm btn-outline-info btn-icon mr-2" title="Edit details">
													<span class="svg-icon svg-icon-md">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24"></rect>
																<path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "></path>
																<rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect>
															</g>
														</svg>
													</span>
												</a>
												
											</td>

										</tr>
									<?php $count++;
									endforeach; ?>
								</tbody>
							</table>
							<!--end: Datatable-->
						</div>
					</div>


					<style>
						.pagination-nav nav ul>.active>a {
							margin-left: .4rem;
							margin-right: .4rem;
							outline: 0 !important;
							cursor: pointer;
							display: -webkit-box;
							display: -ms-flexbox;
							display: flex;
							-webkit-box-pack: center;
							-ms-flex-pack: center;
							justify-content: center;
							-webkit-box-align: center;
							-ms-flex-align: center;
							align-items: center;
							height: 2.25rem;
							min-width: 2.25rem;
							padding: .5rem;
							text-align: center;
							position: relative;
							font-size: 1rem;
							line-height: 1rem;
							font-weight: 500;
							border-radius: .42rem;
							border: 0;
							-webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
							transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
							transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
							transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease;
							background-color: #3699ff;
							color: #fff;
						}

						.pagination-nav nav ul li a {
							margin-left: .4rem !important;
							margin-right: .4rem !important;
							outline: 0 !important;
							cursor: pointer;
							display: -webkit-box;
							display: -ms-flexbox;
							display: flex;
							-webkit-box-pack: center;
							-ms-flex-pack: center;
							justify-content: center;
							-webkit-box-align: center;
							-ms-flex-align: center;
							align-items: center;
							height: 2.25rem !important;
							min-width: 2.25rem !important;
							padding: .5rem;
							text-align: center;
							position: relative;
							font-size: 1rem;
							line-height: 1rem;
							font-weight: 500;
							border-radius: .42rem;
							border: 0;
							-webkit-transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
							transition: color .15s ease, background-color .15s ease, border-color .15s ease, -webkit-box-shadow .15s ease;
							transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
							transition: color .15s ease, background-color .15s ease, border-color .15s ease, box-shadow .15s ease, -webkit-box-shadow .15s ease;
							color: #7e8299;
							background-color: transparent;
						}
					</style>
					<hr>
					<div class="row mt-4 ">
						<div class="col-lg-12 text-center">
							<div id='pagination' class='pagination-nav'>
								<?= $pager->links() ?>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
<script>
	"use strict";
	var KTDatatablesBasicPaginations = function() {

		var initTable1 = function() {
			var table = $('#kt_datatable');

			// begin first table
			table.DataTable({
				responsive: true,
				pagingType: 'full_numbers',
				lengthMenu: [5, 10, 25, 50, 100, 120, 200, 300, 400, 500, 1000],

				pageLength: 50,
				headerCallback: function(thead, data, start, end, display) {
					thead.getElementsByTagName('th')[0].innerHTML = `
                    <label class="checkbox checkbox-single">
                        <input type="checkbox" value="" class="group-checkable"/>
                        <span></span>
                    </label>`;
				},
				columnDefs: [{
					targets: 0,
					width: '30px',
					className: 'dt-left',
					orderable: false,

				}, ]

			});
			table.on('change', '.group-checkable', function() {
				var set = $(this).closest('table').find('td:first-child .checkable');
				var checked = $(this).is(':checked');

				$(set).each(function() {
					if (checked) {
						$(this).prop('checked', true);
						$(this).closest('tr').addClass('active');
						$('#handlerForm').removeClass('d-none');
					} else {
						$(this).prop('checked', false);
						$(this).closest('tr').removeClass('active');
						$('#handlerForm').addClass('d-none');
					}
				});

			});

			table.on('change', 'tbody tr .checkbox', function() {
				$(this).parents('tr').toggleClass('active');
			});
		};


		return {

			//main function to initiate the module
			init: function() {
				initTable1();

			}
		};
	}();

	jQuery(document).ready(function() {
		KTDatatablesBasicPaginations.init();
	});
</script>


<script>
	$('.checkable').change(function() {
		var set = $(this).closest('table').find('td:first-child .checkable');
		var checked = $(this).is(':checked');

		let show = false
		$(set).each(function() {
			if (show === false) {
				if ($(this).is(':checked')) {
					show = true
				}
			}
		});
		if (show) {
			$('#handlerForm').removeClass('d-none');
		} else {
			$('#handlerForm').addClass('d-none');
		}
	})

	function showOption(p) {
		console.log(p)
		if (p === '') {
			$('#actionOption').html('');
		} else if (p == 1) {
			// change password
			$('#actionOption').html(`
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="password">Password</label>
						<input type="text" name="password" id="password" class="form-control" required placeholder="Enter Your Password">
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group text-center">
						<label for="">&nbsp;</label>
						<button name="btn" value="handlerBulk" class="btn btn-primary" type="submit">Submit</button>
					</div>
				</div>
			</div>
			`);
		} else if (p == 2) {
			// suspend
			$('#actionOption').html(`
				<div class="col-md-1">
					<div class="form-group text-center">
						<label for="">&nbsp;</label>
						<button name="btn" value="handlerBulk" class="btn btn-primary" type="submit">Submit</button>
					</div>
				</div>
			`);
		} else if (p == 4) {
			// active
			$('#actionOption').html(`
				<div class="col-md-1">
					<div class="form-group text-center">
						<label for="">&nbsp;</label>
						<button name="btn" value="handlerBulk" class="btn btn-primary" type="submit">Submit</button>
					</div>
				</div>
			`);
		} else {
			$('#actionOption').html('');
		}
	}
</script>