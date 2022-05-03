<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\SharedSpace;
use App\Models\Reserve;

class ReservesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reserve::truncate();
        $faker = \Faker\Factory::create();

        $sharedSpaces = SharedSpace::all();
        $assignments = Assignment::all()->pluck('id')->toArray();
        foreach ($sharedSpaces as $sharedSpace) {
            Reserve::create([
                'assig_id' => $faker->randomElement($assignments),
                'ec_id' => $sharedSpace->id,
                'detalle_rsv' =>$faker->state,
                'fechahi_rsv' =>$faker->dateTime(),
                'fechahf_rsv' =>$faker->dateTime()
            ]);
        };
    }
}
