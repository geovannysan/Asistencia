<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AsistenciaControlle extends Controller
{
    /**
     * Muestrar fecha 
     * Muestra la asustencia del dia actual 
     * en una vista
     * @return 'vista' 'welcome' y con array 'asistencia'
     *  
     */
    public function index()
    {
        //Obtener la fecha de hoy
        $hoy =  Date::now()->format('Y-m-d');
        // select de asistencia  donde el campo Fecha sea igual a la variable $hoy
        $asistencia = Asistencia::where('fecha', $hoy)->get();
        $asistencia->load('empleado');
        $divide = "AQUI";
        return view('welcome', compact('asistencia', 'divide'));
    }
    /**
     * Muestrar fecha 
     * Muestra la asustencia del dia actual en un rango de fecha
     * en una vista
     * @return 'vista' 'welcome' y con array 'asistencia'
     *  
     */
    public function Mostrarfecha(Request $request)
    {
        $divide = $request->input('inicio');
        if ($divide == "") {

            //Obtener la fecha de hoy
            $inicio = Date::now()->format('Y-m-d');
            $asistencia = Asistencia::where('fecha', $inicio)->get();
            $asistencia->load('empleado');
            return view('welcome', compact('asistencia', 'divide'));
        }
        $fechas = explode(" ", $divide);

        $inicio = $fechas[0];
        $fin = $fechas[1];

        $asistencia = [];

        $asistencia = Asistencia::whereBetween('fecha', [$inicio, $fin])->get();
        $asistencia->load('empleado');
        return view('welcome', compact('asistencia', 'divide'));
    }
}
