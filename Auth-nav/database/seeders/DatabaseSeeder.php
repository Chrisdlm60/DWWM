<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\User;

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
        User::create(
            [
                'name' => 'Dupont',
                'email' => 'dupont@la.fr',
                'password' => bcrypt('pass'),
            ]
        );
        Film::factory(10)->create();
    }
}
