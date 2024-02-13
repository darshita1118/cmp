<div class="row">

	<div class="col-xl-12">
		<div class="panel panel-inverse" data-sortable-id="table-basic-7">
			<div class="panel-heading">
				<ol class="breadcrumb panel-title">
					<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
					<li class="breadcrumb-item"><a href="javascript:;">Lead Source</a></li>
					<li class="breadcrumb-item active">All Source</li>
				</ol>

				<div class="mb-1 me-2">
					<span class="badge bg-green text-white">Total Source: <?= $total_source ?? 0 ?></span>
				</div>

				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>

				</div>

			</div>


			<div class="panel-body" style="box-sizing: border-box; display: block;">

				<div class="table-responsive">
					<table class="table table-striped mb-0 align-middle table-bordered">
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
										<a href="<?= base_url('admin/edit-source/' . $row['source_id']) ?>" class="btn btn-sm btn-primary me-1">Edit</a>
										<a href="<?= base_url('admin/delete/source/' . $row['source_id']) ?>" class="btn btn-sm btn-danger">Delete</a>
									</td>
								</tr>
							<?php $count++;
							endforeach; ?>
						</tbody>
					</table>
				</div>

			</div>


		</div>
	</div>
</div>