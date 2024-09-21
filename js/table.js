$(document).ready(function() {
    // Cargar datos en el modal de edición
    $('.btn-edit').click(function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');
        var edad = $(this).data('edad');
        var sexo = $(this).data('sexo');
        var carrera = $(this).data('carrera');

        $('#edit-id').val(id);
        $('#edit-nombre').val(nombre);
        $('#edit-edad').val(edad);
        $('#edit-sexo').val(sexo);
        $('#edit-carrera').val(carrera);
    });
    

    // Cargar el id en el modal de eliminación
    $('.btn-delete').click(function() {
        var id = $(this).data('id');
        $('#delete-id').val(id);
    });

    // Inicialización de DataTable 
    $('#myTable').DataTable({
        responsive: true,
        language: {
            "sEmptyTable": "No hay datos disponibles en la tabla",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
            "sInfoFiltered": "(filtrado de _MAX_ entradas totales)",
            "sLengthMenu": "Mostrar _MENU_ entradas",
            "sLoadingRecords": "Cargando...",
            "sProcessing": "Procesando...",
            "sSearch": "Buscar:",
            "sZeroRecords": "No se encontraron resultados",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });


});

