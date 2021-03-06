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
            'nombre_ec' =>$this->faker->company,
            'detalle_ec' =>$this->faker->address
        ];
    }
}
