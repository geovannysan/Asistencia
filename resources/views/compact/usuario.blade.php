@include('compact.slide')

<div class="content d-flex justify-content-center">

    <div class="col-lg-9 my-2   rounded-4" id="reporte">
        <div class="container card p-3 my-5" id="reporte">
            @if(isset($empleado) && $empleado->count() > 0)
            <table id="usuarios" class="table table-responsive ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cédula</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleado as $empleados)
                    <tr>
                        <td>{{ $empleados->id }}</td>
                        <td>{{ $empleados->nombre }}</td>
                        <td>{{ $empleados->cedula }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No hay usuaios disponibles</p>
            @endif
        </div>
    </div>
</div>
<script>
    // DataTable('#usuarios');


    $(document).ready(function() {

        // Inicializar DataTables
        var table = $('#usuarios').DataTable({
            responsive: true,
            language: {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            dom: 'Bfrtip',
            "buttons": [{
                "extend": 'pdf',
                "text": 'Exportar pdf',
                "className": 'btn btn-danger '
            }]

        });
    });
</script>