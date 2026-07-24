$(document).ready(function() {
    $('#sidebarToggle').click(function(e) {
        e.preventDefault();
        $('#sidebar').toggleClass('toggled');
        $('#page-content-wrapper').toggleClass('toggled');
    });

    $('[data-bs-toggle="tooltip"]').tooltip();

    if ($.fn.select2) {
        $('.select2').select2({ theme: 'bootstrap-5' });
    }

    if ($.fn.DataTable) {
        $('.datatable').each(function() {
            var colCount = $(this).find('thead tr:first th').length;
            var columns = [];
            for (var i = 0; i < colCount; i++) { columns.push(null); }
            $(this).DataTable({
                pageLength: 25,
                columns: columns,
                language: { search: "", searchPlaceholder: "Search...", emptyTable: "No data available" },
                dom: '<"d-flex justify-content-between align-items-center mb-3"<"d-flex"l><"d-flex"f>>rtip'
            });
        });
    }

    $('.delete-btn').click(function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var title = $(this).data('title') || 'Delete Record';
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    $('.alert-dismissible').delay(5000).slideUp(500);
});
