<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\Payment;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::truncate();
        $faker = \Faker\Factory::create();

        $assignments = Assignment::all();
        foreach ($assignments as $assignment) {
            Payment::create([
                'assig_id' =>$assignment->id,
                'contrapartida_pay' =>$faker->text,
                'entidadfin_pay' =>$faker->text,
                'evidencia_pay' =>$faker->text,
                'fechapago_pay' =>$faker->dateTime(),
                'fecharegpago_pay' =>$faker->dateTime()
            ]);
        };
    }
}
