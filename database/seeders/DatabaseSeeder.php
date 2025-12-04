<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Quack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        Quack::factory(200)->create();
    }
}
