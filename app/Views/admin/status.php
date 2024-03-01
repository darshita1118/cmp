<!-- DataTables CSS -->
<link href="<?= base_url() ?>assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/plugins/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') ?>" rel="stylesheet" />


<!-- content -->


<div class="panel panel-inverse">

	<div class="panel-heading">
		<ol class="breadcrumb panel-title">
			<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:;">Lead Status</a></li>
			<li class="breadcrumb-item active">All Status</li>
			<div class="p-2">
				<span class="badge bg-warning text-white rounded-pill fs-6"><?= $total_status ?? 0 ?></span>
			</div>
		</ol>
		<div class="panel-heading-btn">
			<a href="<?= base_url('admin/create_status') ?>" class="btn btn-sm btn-icon btn-default"> <i class="fa fa-user-plus" data-bs-toggle="tooltip" data-bs-placement="left" title="New Status"></i></a>
			<a href="javascript:;" class="btn btn-sm btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
		</div>
	</div>


	<div class="panel-body">
		<table id="data-table-fixed-header" class="table table-striped table-bordered align-middle w-100 text-wrap ">
			<thead>
				<tr>
					<th>Sno. </th>
					<th>Status Name </th>
					<th>Status Type </th>
					<th>Status Info </th>
					<th>Status Score </th>
					<th width="1%">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = 1;
				foreach ($statuses as $row) : ?>

					<tr class="odd gradeX">
						<td>
							<?= $count ?>
						</td>
						<td><?= $row['status_name'] ?></td>
						<td><?= $row['status_type'] ?></td>
						<td><?= $row['status_get_more_info'] ?></td>
						<td><?= $row['score'] ?></td>
						<td>
							<a href="<?= base_url('admin/edit-status/' . $row['status_id']) ?>" class="btn btn-icon btn-sm btn-warning"><i class="fa fa-pen"></i></a>
							<a href="<?= base_url('admin/delete/status/' . $row['status_id']) ?>" class="btn btn-danger btn-icon btn-sm delete-lead" data-bs-toggle="tooltip" title="Delete"><i class="fa fa-trash-can"></i></a>
						</td>
					</tr>
				<?php $count++;
				endforeach; ?>
			</tbody>
		</table>

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