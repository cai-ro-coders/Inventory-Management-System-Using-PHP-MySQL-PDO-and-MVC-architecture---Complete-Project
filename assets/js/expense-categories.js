$(document).ready(function() {
    $(document).on('click', '.edit-btn', function() {
        $('#categoryId').val($(this).data('id'));
        $('#categoryName').val($(this).data('name'));
        $('#categoryDescription').val($(this).data('description'));
        $('#modalTitle').text('Edit Category');
        $('#categoryModal').modal('show');
    });

    $('#categoryModal').on('hidden.bs.modal', function() {
        if (!$('#categoryId').val()) {
            $('#categoryForm')[0].reset();
        }
    });

    $('#categoryModal').on('shown.bs.modal', function() {
        if (!$('#categoryId').val()) {
            $('#modalTitle').text('Add Category');
        }
    });
});
