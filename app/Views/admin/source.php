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


<div class="panel panel-default">
	<div class="panel-heading">
		<ol class="breadcrumb panel-title">
			<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:;">Lead Source</a></li>
			<li class="breadcrumb-item active">All Source</li>
		</ol>

		<div class="mb-1 me-2">
			<span class="badge">Total Source: <?= $total_source ?? 0 ?></span>
		</div>

		<div class="panel-heading-btn">
			<a href="javascript:;" class="btn btn-sm btn-icon bg-black" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>

		</div>

	</div>


	<div class="panel-body">
		<table id="data-table-combine" class="table table-striped table-bordered align-middle w-100 text-nowrap cmp-table">
			<thead>
				<tr>
					<th>#S. No. </th>
					<th>Source Name </th>
					<th>Source Score </th>
					<th width="1%">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $count = 1;
				foreach ($sources as $row) : ?>
					<tr>
						<td>
							<?= $count ?>
						</td>
						<td><?= $row['source_name'] ?></td>
						<td><?= $row['source_score'] ?></td>
						<td nowrap="">
							<a href="<?= base_url('admin/edit-source/' . $row['source_id']) ?>" class="btn btn-warning"><i class="fa fa-pen"></i></a>
							<a href="<?= base_url('admin/delete/source/' . $row['source_id']) ?>" class="btn btn-danger"><i class="fa fa-trash-can"></i></a>
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
</div>