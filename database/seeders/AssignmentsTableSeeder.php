<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Membership;
use App\Models\Client;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assignment::truncate();
        $faker = \Faker\Factory::create();

        $memberships = Membership::all();
        $clients = Client::all()->pluck('id')->toArray();
        foreach ($memberships as $membership) {
            Assignment::create([
                'mem_id' =>$membership->id,
                'cli_id' => $faker->randomElement($clients),
                'detalle_assig' =>$faker->state,
                'fecha_assig' =>$faker->dateTime()
            ]);
        };
    }
}
