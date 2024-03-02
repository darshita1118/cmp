<?php

use App\Models\ApplicationModel;
use CodeIgniter\Database\BaseBuilder;

function getTLName($handler)
{
	$model = new ApplicationModel('lms_users_' . session('year'), 'lu_id', 'reg_setting_db');
	$detail = $model->select(['user_name', 'user_email'])->where('lu_id', function (BaseBuilder $baseBuilder) use ($handler) {
		return $baseBuilder->select('team_leader')->from(session('db_priffix') . '_' . session('suffix') . '.team_leader_' . session('year'))->where(['handler_id' => $handler]);
	})->first();
	return $detail ? $detail['user_name'] . "<br><small>" . $detail['user_email'] . "</small>" : 'Individual';
}
?>

<!-- DataTables CSS -->
<link href="<?= base_url() ?>assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') ?>" rel="stylesheet" />
<!-- daterange css -->
<link href="<?= base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<!-- Select CSS -->
<link href="<?= base_url() ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet" />
<!-- End CSS -->


<!-- Content -->

<div class="panel panel-inverse">

	<div class="panel-heading">
		<ol class="breadcrumb panel-title">
			<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:;">Counsellors</a></li>
			<li class="breadcrumb-item active">All Counsellors</li>
			<div class="p-2">
				<span class="badge bg-warning text-white rounded-pill fs-6"><?= $total_handlers ?? 0 ?></span>
			</div>
		</ol>

		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" title="Filter" aria-controls="offcanvasTop">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-right" viewBox="0 0 16 16">
					<path d="M14 10.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 .5-.5m0-3a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0 0 1h7a.5.5 0 0 0 .5-.5m0-3a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0 0 1h11a.5.5 0 0 0 .5-.5"></path>
				</svg>
			</a>


			<div class="offcanvas offcanvas-top ps-5 pe-5" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
				<div class="offcanvas-header border-bottom">
					<h5 id="offcanvasTopLabel">Filters</h5>
					<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body mt-md-3">
					<form action="" class="row">
						<div class="col-md-3">
							<div class="mb-3">
								<label class="form-label">Mobile No.</label>
								<input class="form-control" type="tel" name="mobile" placeholder="Search mobile no.." minlength="8" value="<?= isset($_GET['mobile']) ? $_GET['mobile'] : null ?>" maxlength="12" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label class="form-label">Email</label>
								<input class="form-control" name="email" placeholder="Search email " maxlength="255" value="<?= isset($_GET['email']) ? $_GET['email'] : null ?>" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label class="form-label">User Role</label>
								<select class="form-select selectpicker" name="type" id="type">
									<option selected>--Select-- </option>
									<option value="handler" <?= ($_GET['type'] ?? '') == 'handler' ? 'selected' : null ?>>Handler</option>
									<option value="team-leader" <?= ($_GET['type'] ?? '') == 'team-leader' ? 'selected' : null ?>>Team Leader</option>
								</select>
							</div>
						</div>
						<div class="offcanvas-footer border-top mt-3">
							<div class="col-md-12 mt-md-4 text-center">
								<button type="submit" class="btn btn-primary w-100px mt-3">Apply Filter</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>

	</div>
	<div class="panel-body">
		<div class="col-md-6 mb-2">
			<form id="handlerForm" action="<?= base_url('admin/bulk-action') ?>" method="post">
				<?= csrf_field() ?>
				<div class="form-group hide d-flex flex-row align-items-center" data-email-action="">
					<div class="form-group">
						<label for="">Action</label>
						<select class="form-select selectpicker" name="actionType" id="actionType" onchange="showOption(this.value)" required>
							<option value="4">Active</option>
							<option value="2">Suspend</option>
							<?php if (isset($_GET['type']) && $_GET['type'] == 'handler') : ?>
								<option value="3">Assign To Team Leaders</option>
							<?php endif; ?>
							<option value="1">Change Password</option>
						</select>
					</div>
					<div id="actionOption" class="d-flex align-items-center me-3">
						<!-- <label for="" class="h5 me-3">Password</label>
                        <input type="password" class="form-control" name="" placeholder="Password"> -->
					</div>
					<!-- <a href="" class="btn btn-info ms-3">Submit</a> -->
				</div>
			</form>
		</div>


		<table id="data-table-fixed-header" class="table table-striped table-bordered align-middle w-100 text-wrap ">
			<thead>
				<tr>
					<th><input type="checkbox" class="form-check-input" id="emailSelectAll" onclick="toggleAllCheckboxes()"></th>
					<th width="1%">ID</th>
					<th class="text-nowrap">Name</th>
					<th class="text-nowrap">Email</th>
					<th class="text-nowrap">Mobile</th>
					<th class="text-nowrap">Role</th>
					<th>Team Leader</th>
					<th>Status</th>
					<th class="text-nowrap">Created At</th>
					<th class="text-nowrap">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = 1;
				foreach ($handlers as $handler) : ?>
					<tr class="odd gradeX">
						<td><input type="checkbox" class="form-check-input email-checkbox" onclick="toggleRow(this)"></td>
						<td width="1%" class="fw-bold"><?= $count ?></td>
						<td><?= $handler['user_name'] ?></td>
						<td><?= $handler['user_email'] ?></td>
						<td><?= $handler['user_mobile'] ?></td>
						<td><?= $handler['user_role'] == 1 ? 'Team Leader' : 'Handler' ?></td>
						<td><?= getTLName($handler['lu_id']); ?></td>
						<td><?= $handler['user_status'] == 1 ? 'Active' : 'Suspend' ?></td>
						<td><?= date('l d M Y', strtotime($handler['user_created_at'])) ?></td>
						<td nowrap="">
							<a href="<?= base_url('admin/edit-handler/' . $handler['lu_id']) ?>" class="btn btn-icon btn-sm btn-primary me-1" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-file-pen"></i></a>
							<?php if ($handler['user_role'] == 1) : ?>
								<a href="<?= base_url('admin/team-members/' . $handler['lu_id']) ?>" class="btn btn-icon btn-sm btn-warning" data-bs-toggle="tooltip" title="Team"><i class="fa fa-users"></i></a><?php endif; ?>
							<a href="<?= base_url('admin/delete/handler/' . $handler['lu_id']) ?>" class="btn btn-danger btn-icon btn-sm delete-lead" data-bs-toggle="tooltip" title="Delete"><i class="fa fa-trash-can"></i></a>

						</td>
					</tr>
				<?php $count++;
				endforeach; ?>
			</tbody>
		</table>
		<hr>
		<div class="pagin">
			<div class="col-lg-12 text-center">
				<div id='pagination' class='pagination-nav'>
					<?= $pager->links() ?>
				</div>
			</div>
		</div>
	</div>

</div>


<!-- End Content -->


<!-- DataTables JS -->
<script src="<?= base_url() ?>assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-fixedheader-bs5/js/fixedHeader.bootstrap5.min.js"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/build/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/build/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jszip/dist/jszip.min.js') ?>"></script>

<!-- Form Plugins Scripts -->
<script src="<?= base_url() ?>assets/plugins/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Select2 JS -->
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<script src="<?= base_url() ?>assets/plugins/select-picker/dist/picker.min.js"></script>


<script>
	// Select-Picker
	$('#type').picker({
		search: true
	});
	$('#offcanvasTop .selectpicker').picker();

	$(".default-select2").select2({
		dropdownParent: $('#offcanvasTop')
	});

	// Datepicker JS

	var handleRenderDateRangePicker = function() {
		$("#default-daterange").daterangepicker({
			opens: "right",
			format: "MM/DD/YYYY",
			separator: " to ",
			startDate: moment(),
			endDate: moment(),
			showDropdowns: true,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			},
			locale: {
				applyLabel: 'Apply',
				cancelLabel: 'Cancel',
				fromLabel: 'From',
				toLabel: 'To',
				customRangeLabel: 'Custom Range',
				weekLabel: 'W',
				daysOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
				monthNames: [
					"January", "February", "March", "April", "May", "June",
					"July", "August", "September", "October", "November", "December"
				],
				firstDay: 1
			}
		}, function(start, end) {
			$("#default-daterange input").val(
				start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
			);
		});
	};

	var FormPlugins = (function() {
		"use strict";
		return {
			init: function() {
				handleRenderDateRangePicker();
			},
		};
	})();

	$(document).ready(function() {
		FormPlugins.init();
		$(document).on("theme-reload", function() {
			handleRenderColorpicker();
		});
	});
</script>

<script>
	function toggleAllCheckboxes() {
		var emailCheckboxes = $(".email-checkbox");
		emailCheckboxes.prop("checked", $("#emailSelectAll").prop("checked"));
		toggleRow(emailCheckboxes);
		toggleDropdown();
	}

	function toggleRow(row) {
		var checkbox = $(row).find('.email-checkbox');
		checkbox.prop('checked', !checkbox.prop('checked'));
		toggleDropdown();
	}

	function toggleDropdown() {
		var dropdown = $('[data-email-action=""]');
		dropdown.toggleClass('hide', $(".email-checkbox:checked").length === 0);
	}
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
			<div class="col-md-6">
					<div class="form-group  ms-3">
						<label for="password">Password
						</label>
						<input type="text" name="password" id="password" class="form-control" required placeholder="Enter Your Password">
					</div>
					</div>
					<div class="col-md-1 ms-2">
					<div class="form-group align-items-center">
						<label for="">&nbsp;
						</label><button name="btn" value="handlerBulk" class="btn btn-primary" type="submit" style="padding-top: 5px;">Submit</button>
					</div>
					</div>
			`);
		} else if (p == 2) {
			// suspend
			$('#actionOption').html(`
			<div class="col-md-1 ms-2">
					<div class="form-group align-items-center">
						<label for="">&nbsp;
						</label><button name="btn" value="handlerBulk" class="btn btn-primary" type="submit" style="padding-top: 5px;">Submit</button>
					</div>
					</div>
			`);
		} else if (p == 4) {
			// active
			$('#actionOption').html(`
			<div class="col-md-1 ms-2">
					<div class="form-group align-items-center">
						<label for="">&nbsp;
						</label><button name="btn" value="handlerBulk" class="btn btn-primary" type="submit" style="padding-top: 5px;">Submit</button>
					</div>
					</div>
			`);
		} else if (p == 3) {
			// team Leads
			// ajax and get team Leaders
			$.ajax({
				url: '<?= base_url('/helper/getTeamLeaderList/') ?>',
				type: 'get',
				async: false,
				success: function(result) {
					//console.log(result)
					$('#actionOption').html('');
					$('#actionOption').html(result);
				},
				error: function() {
					//console.log(result)
					showFire(`error`, `Something Went Wrong on Server Side`);
				}

			});

		} else {
			$('#actionOption').html('');
		}
	}
</script>