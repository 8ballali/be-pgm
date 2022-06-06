<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class users_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1
        ]);
        DB::table('users')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'email' => 'employee@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2
        ]);
        DB::table('users')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'email' => 'customer@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 3
        ]);
    }
}
