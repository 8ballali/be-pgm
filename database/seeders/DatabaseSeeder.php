<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(roles_seeder::class);
        $this->call(users_seeder::class);
        $this->call(status_seeder::class);
        $this->call(department_seeder::class);
    }
}
