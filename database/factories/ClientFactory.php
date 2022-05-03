<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'identificacion_cli' =>$this->faker->numerify('17########'),
            'nombres_cli' =>$this->faker->firstname,
            'apellidos_cli' =>$this->faker->lastname,
            'empresa_cli' =>$this->faker->company,
            'direccion_cli' =>$this->faker->address,
            'email_cli' =>$this->faker->unique()->safeEmail,
            'telf_cli' =>$this->faker->phoneNumber
        ];
    }
}
