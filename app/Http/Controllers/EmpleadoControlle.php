<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Empleado;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Stmt\TryCatch;

class EmpleadoControlle extends Controller
{
    /**
     * Obtener todos los Empleados  en la BD.
     * returns  devuelve lista de empelados en la variable  $empleados
     */
    
    public function  index()
    {
        $empleado = Empleado::all(); //select * from empleado
        return view('compact.usuario', compact('empleado'));
    }
    
}
