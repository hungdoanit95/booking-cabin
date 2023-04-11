<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Cabins;
use Database\Seeders\TimeBooks;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Cabins::class);
        $this->call(TimeBooks::class);
        $this->call(UserSeeder::class);
    }
}
