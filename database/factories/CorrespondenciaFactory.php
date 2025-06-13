<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Correspondencia>
 */
class CorrespondenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rut'=>fake()->bothify(),
            'fecha'=>fake()->date(),
            'hora'=>fake()->time(),
            'fojas'=>fake()->randomNumber(3,false),
            'folder'=>fake()->randomDigit(),
            'destinatario'=>fake()->name(),
            'unidad'=>fake()->word(),
            'referencia'=>fake()->paragraph(),
            'remitente'=>fake()->name(),
            'fono'=>fake()->randomNumber(8,true),
            'tipo'=>fake()->word(),
            // 'codigo'=>fake()->uuid(),
            //
        ];
    }
}
