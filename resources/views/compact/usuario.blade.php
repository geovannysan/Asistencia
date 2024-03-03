<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reportes</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <!-- Bootstrap -->
    <!-- Template styles-->
    <link rel="stylesheet" href="css/boostrap.css">
    <!-- Template styles-->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive styles-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Animation -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Prettyphoto -->
    <link rel="stylesheet" href="css/prettyPhoto.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <!-- Flexslider -->
    <link rel="stylesheet" href="css/flexslider.css">
    <!-- Flexslider -->
    <link rel="stylesheet" href="css/cd-hero.css">
    <!-- Style Swicther -->
    <link id="style-switch" href="css/presets/preset1.css" media="screen" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

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
                        <th>Cargo</th>
                        <th>teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleado as $empleados)
                    <tr>
                        <td>{{ $empleados->id }}</td>
                        <td>{{ $empleados->nombre }}</td>
                        <td>{{ $empleados->cedula }}</td>
                        <td> {{$empleados->cargo}} </td>
                        <td> {{$empleados->telefono}} </td>
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

</html>