<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name'  => 'Carlos Quel',
            'email'     => 'carlosquel@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
        // \App\Models\User::factory(10)->create();
        $this->call(CommentSeeder::class);
    }
}