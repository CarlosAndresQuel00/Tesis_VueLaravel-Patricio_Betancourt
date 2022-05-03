<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->insert([
            'name'  => 'Carlos Quel',
            'email'     => 'carlosquel@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
        // \App\Models\User::factory(10)->create();
        \App\Models\Client::factory(10)->create();
        \App\Models\SharedSpace::factory(10)->create();
        \App\Models\Membership::factory(10)->create();
        $this->call(CommentSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(AssignmentsTableSeeder::class);
        $this->call(ReservesTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
