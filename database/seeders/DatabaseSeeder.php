<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    /*\App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
           'email' => 'test@example.com',
         ]);*/
    // Generar fechas aleatorias para la semana anterior
    $fechaInicio = Carbon::now()->subWeek()->startOfWeek();
    $fechaFin = Carbon::now()->subWeek()->endOfWeek();

    // Crear registros de asistencia para cada día de la semana anterior
    \App\Models\Asistencia::factory(1)->create([
      'empl_id' => 1,
      'fecha' => $fechaInicio,
      'hora_entrada' => $fechaInicio->copy()->hour(rand(6, 9))->minute(rand(0, 59))->second(rand(0, 59))->format('Y-m-d H:i:s'),
      'hora_salida' => $fechaFin->copy()->hour(rand(16, 20))->minute(rand(0, 59))->second(rand(0, 59))->format('Y-m-d H:i:s'),
    ]);

    // \App\Models\Empleado::factory(10)->create();
    // \App\Models\Empleado::factory(10)->create();
  }
}
