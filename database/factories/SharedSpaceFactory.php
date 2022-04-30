<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SharedSpaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_ec' =>$this->faker->name,
            'detalle_ec' =>$this->faker->text,
            'estado_ec' =>$this->faker->state,
        ];
    }
}
