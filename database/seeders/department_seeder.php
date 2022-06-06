<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class department_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'marketing'
        ]);
        DB::table('departments')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'accounting'
        ]);
        DB::table('departments')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'finance'
        ]);
        DB::table('departments')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'production'
        ]);
    }
}
