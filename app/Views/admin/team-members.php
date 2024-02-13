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
						<h3 class="card-label">Team Members
						</h3>
                        
					</div>
                    <p class="text">
                            
                            <b>Team Leader: </b><?= $userDetail['user_name'] ?><br>
                            <b>Email: </b><?= $userDetail['user_email'] ?><br>
                            <b>Mobile: </b><?= $userDetail['user_mobile'] ?>
                        </p>
					
				</div>
				<div class="card-body">
					<div class="row mx-0">
						
						<div class="col-lg-12">
							
							<!--begin: Datatable-->
							<table class="table table-bordered " id="kt_datatable">
								<thead>
									<tr>
										<th>S. No.</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Role</th>
										<th>Status(Current)</th>
										<th>Created At</th>
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody>
									<?php $count = 1;
									foreach ($teamMembers as $handler) : ?>
										<tr>
											<td>
												<?= $count; ?>

											</td>
											<td><?= $handler['user_name'] ?></td>
											<td><a href="mailto:<?= $handler['user_email'] ?>"><?= $handler['user_email'] ?></a></td>
											<td><a href="tel:<?= $handler['user_mobile'] ?>"><?= $handler['user_mobile'] ?></a></td>
											<td><?= $handler['user_role'] == 1 ? 'Team Leader' : 'Handler' ?></td>
											<td><?= $handler['user_status'] == 1 ? 'Active' : 'Suspend' ?></td>
											<td><?= date('l d M Y', strtotime($handler['user_created_at'])) ?></td>
											<td>
											<a href="<?= base_url('admin/delete/team-leader/' . $handler['lu_id']) ?>" class="btn btn-sm btn-outline-danger btn-icon" title="Remove">
													<span class="svg-icon svg-icon-md ">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24"></rect>
																<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
																<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
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
					
				},
				columnDefs: [{
					targets: 0,
					width: '30px',
					className: 'dt-left',
					orderable: true,

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

	
</script>