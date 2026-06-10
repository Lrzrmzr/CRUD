$(document).ready(function () {

    // Use Bootstrap's show.bs.modal event so we always know which element
    // triggered the modal before it becomes visible.
    $('#editModal').on('show.bs.modal', function (event) {
        var trigger = $(event.relatedTarget);

        if (trigger.hasClass('btn-edit')) {
            // Edit mode: populate form from data-* attributes on the button.
            $('#editModalLabel').text('Edit Student');
            $('#edit-action').val('edit');
            $('#edit-id').val(trigger.data('id'));
            $('#edit-nombre').val(trigger.data('nombre'));
            $('#edit-edad').val(trigger.data('edad'));
            $('#edit-sexo').val(trigger.data('sexo'));
            $('#edit-carrera').val(trigger.data('carrera'));
        } else {
            // Create mode: reset the form so no stale values remain.
            $('#editModalLabel').text('New Student');
            $('#edit-action').val('create');
            $('#edit-id').val('');
            $('#editForm')[0].reset();
        }
    });

    // Delete modal: copy student id into the hidden field.
    $('#deleteModal').on('show.bs.modal', function (event) {
        $('#delete-id').val($(event.relatedTarget).data('id'));
    });

    // DataTable initialisation
    $('#myTable').DataTable({
        responsive: true,
        language: {
            sEmptyTable:     'No data available',
            sInfo:           'Showing _START_ to _END_ of _TOTAL_ entries',
            sInfoEmpty:      'Showing 0 to 0 of 0 entries',
            sInfoFiltered:   '(filtered from _MAX_ total entries)',
            sLengthMenu:     'Show _MENU_ entries',
            sLoadingRecords: 'Loading...',
            sProcessing:     'Processing...',
            sSearch:         'Search:',
            sZeroRecords:    'No matching records found',
            oPaginate: {
                sFirst:    'First',
                sLast:     'Last',
                sNext:     'Next',
                sPrevious: 'Previous'
            }
        }
    });

});
