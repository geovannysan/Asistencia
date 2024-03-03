<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["status" => "ok", 'mensaje' => 'Api de as' . 'is' . 'tencia activa']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(["status" => $request->input('cedula'), 'mensaje' => 'Api de as' . 'is' . 'tencia activa']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GuardaAsistencia(Request $request)
    {
        try {
            $hoy = Date::now()->format('Y-m-d'); //fecha actual
            $timepo = Date::now()->format('Y-m-d H:i:s'); //
            if ($request->input('cedula') == "") return response()->json("Verificacion invalidad", 400);
            $empleado = Empleado::where('cedula', '=', $request->input('cedula'))->get();//Obtener el empleado con la cédula a buascar
            //return response()->json(['Em'=>$empleado]);
            if (count($empleado) == 0) return response()->json(['mensaje' => 'no se encuentra registrada esta cedula'], 400);
            /**
             * Verificar si ya regsitro la entrada del dia actual
             * no registrado  -> guardarlo y retornar mensaje
             * registrado       -> retornar mensaje que ya esta  registrado
             */
            $id = $empleado[0]->id;
            $lista = Asistencia::where('fecha', $hoy)->where('empl_id', $id)->get();
            if (count($lista) > 0) return response()->json(['mensaje' => 'Ya registro la entradad  hoy '], 400);
            Asistencia::create([
                "fecha" => DATE($hoy),
                "hora_entrada" => $timepo,
                "empl_id" => $id
            ]);
            return response()->json(['mensaje' => 'asistencia reguistrada'], 200);
        } catch (\Exception $e) {
            // Captura de excepciones
            //   Log::error('Error en la solicitud: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GuardaSalida(Request $request)
    {
        try {
            $hoy = Date::now()->format('Y-m-d'); //fecha actual
            $timepo = Date::now()->format('Y-m-d H:i:s'); // fecha y hor aactual 
            if ($request->input('cedula') == "") return response()->json("Verificacion invalidad", 400);
            $empleado = Empleado::where('cedula', $request->input('cedula'))->get();
            if (count($empleado) == 0) return response()->json(['mensaje' => 'no se encuentra registrada esta cedula'], 400);
            $id = $empleado[0]->id;
            /**
             * Verificar si ya regsitro la entrada del dia actual
             * no registrado  -> mensaje mesaje de que debe registara la entrada
             * verifica si registro salida
             * no registrada   -> guardarla y retornar el mensaje 
             * registrado       -> retornar mensaje que ya esta  registrado
             */
            $lista = Asistencia::where('fecha', $hoy)->where('empl_id', $id)->get();
            if (count($lista) == 0) return response()->json(['mensaje' => 'no ha  registrado la entrada entrada '], 400);

            if ($lista[0]["hora_salida"] != null) return response()->json(["mensaje" => "ya se registro su salida"], 400);
            Asistencia::where('id', $lista[0]->id)->where('fecha', $hoy)->update([
                "hora_salida" => $timepo
            ]);
            return response()->json(['mensaje' => 'salida reguistrada'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Mostrarfecha(Request $request)
    {
        /**
         * Muestra llos registros de asistencia en base al rango de fecha
         * que se pasa atravez del body
         * retorna json de  los registros encontrados
         */
        $divide = $request->input('inicio');
        $fechas = explode(" ", $divide);

        $inicio = Date($fechas[0]);
        $fin = Date($fechas[0]);

        $asistencia = [];

        $asistencia = Asistencia::whereBetween('fecha', [$fechas[0], $fechas[1]])->get();

        $asistencia->load('empleado');
        return  response()->json(["asistencia" => $asistencia, "fecha" => $fechas], 200);
    }
}
