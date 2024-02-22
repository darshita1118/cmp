<?php

use App\Models\ApplicationModel;

$year = session('year');
$suffix = session('suffix');

function getStatusMessage($leadId)
{
}
function getStatusTime($leadId)
{
}

?>


<!-- DataTables CSS -->
<link href="<?= base_url() ?>assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" />


<link href="<?= base_url('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-select-bs5/css/select.bootstrap5.min.css') ?>" rel="stylesheet" />

<link href="<?= base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />

<link href="<?= base_url() ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />


<div class="panel panel-inverse">
	<div class="panel-heading">
		<h4 class="panel-title">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">Home</a></li>
				<li class="breadcrumb-item">Leads</a></li>
				<li class="breadcrumb-item">All Leads</li>
			</ol>
		</h4>
		<div class="mb-1 me-2">
			<span>Total Leads: <?= $total_leads ?? 0 ?></span>
		</div>
		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
			<a href="javascript:;" class="btn btn-sm btn-icon btn-warning" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="fa fa-lg fa-fw fa-sliders"></i></a>
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
								<input class="form-control" type="number" placeholder="Enter Mobile No." />
							</div>

						</div>
						<div class="col-md-3">
							<!-- html -->
							<label class="form-label">Date</label>
							<div class="input-group" id="default-daterange">
								<input type="dt" name="default-daterange" class="form-control" value="" placeholder="click to select the date range" />
								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label class="form-label">Status</label>
								<select class="form-select">...
									<option selected>--Select -- </option>
									<option value="1">Admin</option>
									<option value="2">Handler</option>

								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label class="form-label">Source</label>
								<select class="form-select">...
									<option selected>--Select-- </option>
									<option value="1">Suspended</option>
									<option value="2">Active</option>

								</select>

							</div>
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label class="form-label">Department</label>
								<select class="form-select">...
									<option selected>--Department-- </option>
									<option value="1">Admin</option>
									<option value="2">Handler</option>

								</select>

							</div>
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label class="form-label">Program</label>
								<select class="default-select2 form-select">
									<option value="AK">Test</option>
									<option value="AK">Test</option>
									<option value="AK">Test</option>
									<option value="AK">Test</option>
									<option value="AK">Test</option>
									<option value="HI">Hawaii</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="mb-3">
								<label class="form-label">Lead Nationality</label>
								<select class="form-select">...
									<option selected>--Select-- </option>
									<option value="1">Suspended</option>
									<option value="2">Active</option>
								</select>

							</div>
						</div>
						<div class="col-md-3 mt-md-4">
							<button type="submit" class="btn btn-primary w-100px me-5px">Apply Filter</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="panel-body">
		<!-- html -->
		<table id="data-table-fixed-header" class="table table-striped table-bordered align-middle w-100 text-wrap ">
			<thead>
				<tr>
					<th width="1%">ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Department</th>
					<th>Program</th>
					<th>Status</th>
					<th>Source</th>
					<th>Create At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$count = 1;
				foreach ($leads as $lead) : ?>
					<tr class="odd gradeX">
						<td width="1%" class="fw-bold"><?= $count ?></td>
						<td><?= trim(ucwords($lead['lead_first_name'] . ' ' . $lead['lead_middle_name'] . ' ' . $lead['lead_last_name'])) ?></td>
						<td><?= $lead['lead_email'] ?></td>
						<td><?= "(" . $lead['lead_country_code'] . ")" ?>-<?= $lead['lead_mobile'] ?></td>
						<td><?= $lead['dept_name'] ?></td>
						<td><?= $lead['course_name'] ?></td>
						<td><?= $lead['status_name'] ?></td>
						<td><?= $lead['source_name'] ?></td>
						<td><?= date('d/m/Y H:i:s', strtotime($lead['lead_created_at'])) ?></td>
						<td>
							<a href="<?= base_url('admin/edit-lead/' . $lead['lid']) ?>" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-pen"></i></a>
							<a href="<?= base_url('admin/delete/lead/' . $lead['lid']) ?>" class="btn btn-danger btn-icon btn-sm"><i class="fa fa-trash-can"></i></a>
						</td>
					</tr>
				<?php $count++;
				endforeach; ?>
			</tbody>
		</table>
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
		<div class="row mt-4">
			<div class="col-lg-12 text-center">
				<div id='pagination' class='pagination-nav'>
					<?= $pager->links() ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- DataTables JS -->
<script src="<?= base_url() ?>assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables.net-fixedheader-bs5/js/fixedHeader.bootstrap5.min.js"></script>
<script src="<?= base_url('assets/plugins/datatables.net-select/js/dataTables.select.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-select-bs5/js/select.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/build/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pdfmake/build/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jszip/dist/jszip.min.js') ?>"></script>

<!-- Select2 JS -->
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>

<!-- Form Plugins Scripts -->
<script src="<?= base_url() ?>assets/plugins/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!--Code Script -->
<script>
	var options = {
		dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-lg-8 d-lg-block"<"d-flex d-lg-inline-flex justify-content-center mb-md-2 mb-lg-0 me-0 me-md-3"l><"d-flex d-lg-inline-flex justify-content-center mb-md-2 mb-lg-0 "B>><"col-lg-4 d-flex d-lg-block justify-content-center"fr>>t<"row"<"col-md-5"i><"col-md-7"p>>>',
		buttons: [{
				extend: 'copy',
				className: 'btn-sm'
			},
			{
				extend: 'csv',
				className: 'btn-sm'
			},
			{
				extend: 'excel',
				className: 'btn-sm'
			},
			{
				extend: 'pdf',
				className: 'btn-sm'
			},
			{
				extend: 'print',
				className: 'btn-sm'
			}
		],
		keys: true,
		select: true,
		paging: true,
		// lengthMenu: [20, 40, 60, 100, 120, 200, 300, 400, 500, 1000],
		fixedHeader: {
			header: true,
			headerOffset: $('#header').height()
		},
		responsive: true,
		pageLength: 50,
	};

	$('#data-table-fixed-header').DataTable(options);
</script>
<script>
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

<style>
	.daterangepicker {
		z-index: 9999 !important;
	}
</style>