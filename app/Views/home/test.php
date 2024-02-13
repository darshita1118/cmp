<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<table id="data-table-combine" class="table table-striped table-bordered align-middle w-100 text-nowrap">
    <thead>
        <tr>
            <th width="1%"></th>
            <th width="1%" data-orderable="false"></th>
            ...
        </tr>
    </thead>
    <tbody>
        ...
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


<?= $this->endSection() ?>