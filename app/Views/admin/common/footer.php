<!--Datatable Code Script -->
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
		//lengthMenu: [20, 40, 60],
		fixedHeader: {
			header: true,
			headerOffset: $('#header').height()
		},
		responsive: true,
		pageLength: 10,
	};

	$('#data-table-fixed-header').DataTable(options);
</script>


<style>
	.daterangepicker {
		z-index: 9999 !important;
	}

	.offcanvas-body {
		overflow: visible !important;


	}
</style>


</div>
<div id="footer" class="app-footer">
	<hr>
	&copy; 2024 LDM - All Rights Reserved
</div>
</div>
<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>


<!-- Content end-->



</body>

</html>