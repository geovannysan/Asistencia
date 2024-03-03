<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    /*
    
            $table->string("nombre", 100);
            $table->string("cedula", 100)->nullable();
            $table->string("telefono", 20)->nullable();
            $table->dateTime("fecha")->default(now());
            $table->string("cargo")-> nullable();
    */
    public function definition()
    {
        return [
            "nombre"=> $this->faker->lastName(),
            'cedula'=>$this->faker->unique()->randomNumber($nbDigits =  9),
            'telefono'=>$this->faker->phoneNumber(),
            "fecha"=> now(),
            "cargo" => $this->faker->jobTitle(),

        ];
    }
}
