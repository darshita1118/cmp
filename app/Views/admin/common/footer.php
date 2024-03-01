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
<script src="<?= base_url() ?>assets/js/demo/ui-modal-notification.demo.js"></script>
<script src="<?= base_url() ?>assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() { // Ensure the DOM is fully loaded
		// Select the delete link by its class
		var deleteLink = document.querySelector('.delete-lead');

		// Add click event listener
		deleteLink.addEventListener('click', function(e) {
			e.preventDefault(); // Prevent the default link action
			var url = this.href; // Store the URL to navigate to

			// Show SweetAlert confirmation
			swal({
					title: 'Are you sure?',
					text: 'You will not be able to recover this imaginary file!',
					icon: 'warning',
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						// If confirmed, proceed with the link's action
						window.location.href = url;
					} else {
						// If cancelled, do nothing
					}
				});
		});
	});
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

	&copy; 2024 LDM - All Rights Reserved
</div>
</div>
<a href="javascript:;" class="btn btn-icon btn-circle btn-theme btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>


<!-- Content end-->



</body>

</html>