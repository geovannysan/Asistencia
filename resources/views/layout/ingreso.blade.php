<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>

<div class="  p-5 ">
    <div class="row text-center">
        <h4>Registro de entradas y salidas</h4>
    </div>
    <div class="row ">
        <input id="cedula" class=" input-group form-control input-group-lg text-center" type="search" name="cedula" placeholder="ingrese #cédula" id="">
    </div>
    <div class="row mt-3 ">
        <div class="col-6 ">
            <button class=" btn  btn-primary" onclick="Obtener()"> Ingreso</button>
        </div>
        <div class="col-6 text-end">
            <button class="btn btn-danger    white " onclick="Salida()">Salida</button>

        </div>
        <div class="col-12 mt-1">
            <a class=" btn btn-secondary col-12" href="/reporte"> Ver reporte </a>
        </div>
    </div>

</div>
<script>
    async function Obtener() {
        let cedula = document.getElementById("cedula").value;
        if (cedula == "") {
            return $.alert('Ingrese la cédula del trabajador');
        }
        console.log(cedula);
        try {
            let {
                data,
                status
            } = await axios.post('{{ route("api.entrada") }}', {

                "cedula": cedula

            });
            console.log(data)
            if (status == 200) {
                //$.alert(data.mensaje)
                $.confirm({
                    title: '' + data.mensaje,
                    content: '',
                    theme: 'material'
                });
            }

        } catch (error) {
            console.log(error.response.data.mensaje)
            // $.alert(error.response.data.mensaje)
            $.confirm({
                title: '' + error.response.data.mensaje,
                content: 'cerrar',
                theme: 'material'
            });
        }

    }
    async function Salida() {
        let cedula = document.getElementById("cedula").value;
        if (cedula == "") {
            return $.alert('Ingrese la cédula del trabajador');
        }
        console.log(cedula);
        try {
            let {
                data,
                status
            } = await axios.post('{{ route("api.salida") }}', {

                "cedula": cedula

            });
            console.log(data)
            if (status == 200) {
                //$.alert(data.mensaje)
                $.confirm({
                    title: '' + data.mensaje,
                    content: 'cerrar',
                    theme: 'material'
                });
            }

        } catch (error) {
            console.log(error.response.data.mensaje)
            //  $.alert(error.response.data.mensaje)
            $.confirm({
                title: '' + error.response.data.mensaje,

                content: 'cerrar',
                theme: 'material'
            });
        }

    }
</script>