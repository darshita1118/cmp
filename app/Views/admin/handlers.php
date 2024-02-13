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
<!-- Include jQuery -->
<script src="<?= base_url('assets/js/jquery-3.6.4.min.js') ?>"></script>

<!-- required files -->
<link href="<?= base_url('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-colreorder-bs5/css/colReorder.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-rowreorder-bs5/css/rowReorder.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-select-bs5/css/select.bootstrap5.min.css') ?>" rel="stylesheet" />

<script src="<?= base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-colreorder/js/dataTables.colReorder.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-colreorder-bs5/js/colReorder.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-rowreorder/js/dataTables.rowReorder.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-rowreorder-bs5/js/rowReorder.bootstrap5.min.js') ?>"></script>
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


<div class="row">

	<div class="col-xl-12">

		<div class="panel panel-inverse">

			<div class="panel-heading">
				<ol class="breadcrumb panel-title">
					<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:;">Counselors</a></li>
					<li class="breadcrumb-item active">All Counselors</li>
				</ol>

				<div class="mb-1 me-2">
					<span class="badge bg-green text-white">Total Counselors: <?= $total_handlers ?? 0 ?></span>
				</div>

				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="fa fa-lg fa-fw fa-sliders"></i></a>


					<div class="offcanvas offcanvas-top ps-5 pe-5" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
						<div class="offcanvas-header border-bottom">
							<h5 id="offcanvasTopLabel">Filters</h5>
							<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<div class="offcanvas-body mt-md-3">
							<form action="" class="row">
								<div class="col-md-3">
									<div class="mb-3">
										<label class="form-label" for="mobile">Mobile No.</label>
										<input name="mobile" class="form-control" type="tel" placeholder="Search mobile no.." minlength="8" value="<?= isset($_GET['mobile']) ? $_GET['mobile'] : null ?>" maxlength="12" />
									</div>
								</div>
								<div class="col-md-3">
									<div class="mb-3"><label class="form-label">Date</label>
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
										<select class="form-select">...
											<option selected>--Chooes Program-- </option>
											<option value="1">Suspended</option>
											<option value="2">Active</option>
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
				<table id="data-table-combine" class="table table-striped table-bordered align-middle w-100 text-nowrap cmp-table">
					<thead>
						<tr>
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
								<td width="1%" class="fw-bold"><?= $count ?></td>
								<td><?= $handler['user_name'] ?></td>
								<td><a href="mailto:<?= $handler['user_email'] ?>"><?= $handler['user_email'] ?></a></td>
								<td><a href="tel:<?= $handler['user_mobile'] ?>"><?= $handler['user_mobile'] ?></a></td>
								<td><?= $handler['user_role'] == 1 ? 'Team Leader' : 'Handler' ?></td>
								<td><?= getTLName($handler['lu_id']); ?></td>
								<td><?= $handler['user_status'] == 1 ? 'Active' : 'Suspend' ?></td>
								<td><?= date('l d M Y', strtotime($handler['user_created_at'])) ?></td>
								<td nowrap="">
									<a href="<?= base_url('admin/edit-handler/' . $handler['lu_id']) ?>" class="btn btn-sm btn-primary me-1">Edit</a>
									<?php if ($handler['user_role'] == 1) : ?>
										<a href="<?= base_url('admin/team-members/' . $handler['lu_id']) ?>" class="btn btn-sm btn-warning">Team</a><?php endif; ?>
									<a href="<?= base_url('admin/delete/handler/' . $handler['lu_id']) ?>" class="btn btn-sm btn-danger">Delete</a>

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
						colReorder: true,
						keys: true,
						rowReorder: true,
						select: true
					};

					if ($(window).width() <= 767) {
						options.rowReorder = false;
						options.colReorder = false;
					}
					$('#data-table-combine').DataTable(options);
				</script>
			</div>


			<div class="hljs-wrapper">
				<pre><code class="html" data-url="../assets/data/table-manage/buttons.json"></code></pre>
			</div>

		</div>

	</div>

</div>

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