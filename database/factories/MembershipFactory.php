<?php

namespace Database\Factories;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_mem' =>$this->faker->company,
            'detalle_mem' =>$this->faker->address,
            'hcowork_mem' =>$this->faker->numerify('##'),
            'hespacios_mem' =>$this->faker->numerify('##'),
            'fechacorte_mem' =>$this->faker->date()
        ];
    }
}
