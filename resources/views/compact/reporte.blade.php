@include('compact.slide')

<div class="content">

    <div class=" d-flex  flex-wrap  align-items-center justify-content-center  items-top justify-center  ">
        <div class=" col-10 col-lg-4 pt-2 text-center">
            <label class="text-center fs-1 fw-bold pb-5">Reporte por fecha</label>
            <input id="inicio" class="input-group form-control input-group-lg text-center" type="search" name="datefilter" value="" />
            <button class=" mt-2 btn btn-success" onclick="Cargarfechas()">Consultar</button>

        </div>
        <div class="col-lg-9 my-2 card  rounded-4">
            <div class="container my-5" id="reporte">
                <h3 class="text-center fs-1 fw-bold pt-1 pb-5">Reporte de hoy</h3>
                @if(isset($asistencia) && $asistencia->count() > 0)
                <table id="usuarios" class="table table-responsive ">
                    <thead>
                        <tr>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>nombre</th>
                            <th>Cédula</th>
                            <th>telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asistencia as $empleados)
                        <tr>

                            <td>{{ $empleados->hora_entrada }}</td>
                            <td>{{ $empleados->hora_salida }}</td>
                            <td>{{ $empleados->empleado->nombre }}</td>

                            <td>{{ $empleados->empleado->cedula }}</td>
                            <td> {{$empleados->empleado->telefono}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class=" container-fluid  text-center">
                    <p>No hay datos disponibles </p>
                </div>
                @endif

            </div>
            <div id="reportes" class=" container my-3 pb-2 d-none">

                <h3 class="text-center fs-1 fw-bold pb-5">Reporte seleccionado</h3>
                <table id="tabla2" class="table table-responsive  ">
                    <thead>
                        <tr>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>nombre</th>
                            <th>Cédula</th>
                            <th>telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear',
                "applyLabel": "Aceptar",
                "cancelLabel": "Hoy",
                "daysOfWeek": [
                    "Dom",
                    "Lun",
                    "Mar",
                    "Mie",
                    "Jue",
                    "Vie",
                    "Sáb"
                ],
                "monthNames": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
            }
        });
        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            console.log(picker)
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' ' + picker.endDate.format('YYYY-MM-DD'));

        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            
            window.location.reload()
        });
        $('#usuarios').DataTable({
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
                    "extend": 'excelHtml5',
                    "text": 'Descargar',
                    "title": 'Reporte de asistencia',
                    "className": 'btn btn-success '
                },
                {
                    extend: 'pdf',
                    pageSize: 'LEGAL',

                    "className": 'btn btn-danger ',
                    customize: function(doc) {
                        doc.content.splice(0, 1);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        doc.pageMargins = [20, 60, 20, 30];
                        doc.alignment = "center"
                        doc.defaultStyle.fontSize = 8;
                        doc.styles.tableHeader.fontSize = 8;

                        doc.styles.tableBodyEven.alignment = 'center';
                        doc.styles.tableBodyOdd.alignment = 'center';

                        doc['header'] = (function() {
                            return {
                                columns: [{
                                    alignment: 'left',
                                    italics: true,
                                    text: 'Tabla ' + now,
                                    fontSize: 18,
                                    margin: [10, 0]
                                }, ],
                                margin: 20
                            }
                        });

                        doc['footer'] = (function(page, pages) {
                            return {
                                columns: [{
                                        alignment: 'left',
                                        text: ['Creado: ', {
                                            text: jsDate.toString()
                                        }]
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['page ', {
                                            text: page.toString()
                                        }, ' of ', {
                                            text: pages.toString()
                                        }]
                                    }
                                ],
                                margin: 20
                            }
                        });

                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function(i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function(i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    }
                }
            ]
        });
    })
    async function Cargarfechas() {
        let inicio = document.getElementById("inicio").value
        console.log(inicio)
        
        if(inicio=="") return $.alert("Ingrese en rengo de fecha")
        let tabla1 = document.getElementById("reporte")
        let tabla2 = document.getElementById("reportes")
        tabla1.classList.add("d-none")
        tabla2.classList.remove("d-none")
        try {
            let {
                data,
                status
            } = await axios.post('{{ route("api.reportes") }}', {

                "inicio": inicio

            });
            console.log(inicio, data)
            if (status == 200) {

                $('#tabla2').DataTable().destroy();
                $('#usuarios').DataTable().destroy()
                console.log(data.asistencia)
                $('#tabla2').DataTable({
                    data: data.asistencia,
                    columns: [{
                            data: 'hora_entrada'
                        },
                        {
                            data: 'hora_salida'
                        },
                        {
                            data: 'empleado.nombre'
                        },

                        {
                            data: 'empleado.cedula'
                        },
                        {
                            data: 'empleado.telefono'
                        }
                    ],
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
                            "extend": 'excelHtml5',
                            "text": 'Excel',
                            "title": 'Reporte de asistencia',
                            "className": 'btn btn-success '
                        },
                        {
                            extend: 'pdf',
                            pageSize: 'LEGAL',

                            "className": 'btn btn-danger ',
                            customize: function(doc) {
                                doc.content.splice(0, 1);

                                var now = new Date();
                                var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                                doc.pageMargins = [20, 60, 20, 30];
                                doc.alignment = "center"
                                doc.defaultStyle.fontSize = 8;
                                doc.styles.tableHeader.fontSize = 8;

                                doc.styles.tableBodyEven.alignment = 'center';
                                doc.styles.tableBodyOdd.alignment = 'center';

                                doc['header'] = (function() {
                                    return {
                                        columns: [{
                                            alignment: 'left',
                                            italics: true,
                                            text: 'Tabla ' + now,
                                            fontSize: 18,
                                            margin: [10, 0]
                                        }, ],
                                        margin: 20
                                    }
                                });

                                doc['footer'] = (function(page, pages) {
                                    return {
                                        columns: [{
                                                alignment: 'left',
                                                text: ['Creado: ', {
                                                    text: jsDate.toString()
                                                }]
                                            },
                                            {
                                                alignment: 'right',
                                                text: ['page ', {
                                                    text: page.toString()
                                                }, ' of ', {
                                                    text: pages.toString()
                                                }]
                                            }
                                        ],
                                        margin: 20
                                    }
                                });

                                var objLayout = {};
                                objLayout['hLineWidth'] = function(i) {
                                    return .5;
                                };
                                objLayout['vLineWidth'] = function(i) {
                                    return .5;
                                };
                                objLayout['hLineColor'] = function(i) {
                                    return '#aaa';
                                };
                                objLayout['vLineColor'] = function(i) {
                                    return '#aaa';
                                };
                                objLayout['paddingLeft'] = function(i) {
                                    return 4;
                                };
                                objLayout['paddingRight'] = function(i) {
                                    return 4;
                                };
                                doc.content[0].layout = objLayout;
                            }
                        }
                    ]
                });
            }
        } catch (error) {
            console.log(error)
        }
    }
</script>