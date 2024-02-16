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

<!-- required files -->
<link href="<?= base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') ?>" rel="stylesheet">
<!-- required files -->
<link href="<?= base_url('assets/plugins/select2/dist/css/select2.min.css') ?>" rel="stylesheet" />
<!-- required files -->
<script src="<?= base_url('assets/plugins/select2/dist/js/select2.min.js') ?>"></script>
<!-- required files -->
<link href="<?= base_url('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-select-bs5/css/select.bootstrap5.min.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') ?>"></script>
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




<script>
	$("#default-daterange").daterangepicker({
		opens: "right",
		format: "MM/DD/YYYY",
		separator: " to ",
		startDate: moment().subtract("days", 29),
		endDate: moment(),
		minDate: "01/01/2023",
		maxDate: "12/31/2023",
	}, function(start, end) {
		$("#default-daterange input").val(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
	});
</script>

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
			<a class="btn btn-sm btn-icon btn-sm btn-default" onclick="myfilter()"><i class="fa fa-sliders"></i></a>
		</div>
	</div>
	<div id="myfilter" class="filters container-fluid p-4">
		<div class="row">
			<div class="col-md-3">
				<div class="mb-3">
					<label class="form-label">Mobile No.</label>
					<input class="form-control" type="tel" placeholder="Enter Mobile No." />
				</div>

			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="form-label">Default Date Ranges</label>
					<div class="input-group" id="default-daterange">
						<input type="text" name="default-daterange" class="form-control" value="" placeholder="click to select the date range">
						<div class="input-group-text"><i class="fa fa-calendar"></i></div>
					</div>
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
		</div>

	</div>
	<div class="panel-body">



		<!-- html -->
		<table id="data-table-combine" class="table table-striped table-bordered align-middle w-100 text-wrap ">
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


		<!-- script -->
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
				responsive: true,
				keys: true,
				select: true,
				fixedColumns: true,
				paging: true,
				scrollCollapse: true,
				scrollY: '300px'
			};

			if ($(window).width() <= 767) {
				options.rowReorder = false;
				options.colReorder = false;
			}

			$('#data-table-combine').DataTable(options);
		</script>


	</div>
</div>



<!-- script -->
<script>
	function myfilter() {
		var x = document.getElementById("myfilter");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	}
</script>

<style>
	.filters {
		display: none;
	}
</style>

<!-- script -->
<script>
	$(".default-select2").select2();
</script>