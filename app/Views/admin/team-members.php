<!-- required files -->
<link href="<?= base_url('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet" />

<!-- required files -->
<link href="<?= base_url('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') ?>"></script>


<div class="row">

	<div class="col-xl-12">

		<div class="panel panel-inverse">

			<div class="panel-heading">
				<ol class="breadcrumb panel-title">
					<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:;">Leads</a></li>
					<li class="breadcrumb-item active">All Leads</li>
				</ol>

				<div class="mb-1 me-2">
					<span class="badge bg-green text-white">Total Leads: 30</span>
				</div>

				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
				</div>

			</div>

			<div class="panel-body">

				<div class="d-flex justify-content-between border-bottom mb-3">
					<h3>Team Members</h3>
					<div>
						<p><b>Team Leader:</b> <?= $userDetail['user_name'] ?><br>
							<b>Email: </b><?= $userDetail['user_email'] ?><br>
							<b>Mobile:</b> <?= $userDetail['user_mobile'] ?>
						</p>

					</div>
				</div>
				<table id="data-table-default" class="table table-striped table-bordered align-middle w-100 text-wrap">
					<thead>
						<tr>
							<th width="1%">ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Role</th>
							<th>Status</th>
							<th>Create At</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $count = 1;
						foreach ($teamMembers as $handler) : ?>
							<tr class="odd gradeX">
								<td width="1%" class="fw-bold"><?= $count; ?></td>
								<td><?= $handler['user_name'] ?></td>
								<td><a href="mailto:<?= $handler['user_email'] ?>"><?= $handler['user_email'] ?></a></td>
								<td><a href="tel:<?= $handler['user_mobile'] ?>"><?= $handler['user_mobile'] ?></a></td>
								<td><?= $handler['user_role'] == 1 ? 'Team Leader' : 'Handler' ?></td>
								<td><?= $handler['user_status'] == 1 ? 'Active' : 'Suspend' ?></td>
								<td><?= date('l d M Y', strtotime($handler['user_created_at'])) ?></td>

								<td nowrap="">
									<a href="<?= base_url('admin/delete/team-leader/' . $handler['lu_id']) ?>" class="btn btn-sm btn-danger w-60px">Delete</a>
								</td>
							</tr>
						<?php $count++;
						endforeach; ?>
					</tbody>
				</table>

				<!-- script -->
				<script>
					$('#data-table-default').DataTable({
						responsive: true
					});
				</script>
			</div>

		</div>

	</div>