<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Quack;
use App\Models\Quashtag;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(16)->create();
        Quack::factory(20)->create();

        foreach (Quack::all() as $quack) {
            foreach (User::all() as $user) {
                if (rand(1, 100) > 70) {
                    $user->quavs()->attach($quack->id);
                }
                if (rand(1, 100) > 70) {
                    $user->requacks()->attach($quack->id);
                }
            }
        }

        // Usuario de prueba para desarrollo
        User::factory()->create([
            'username' => 'admin',
            'display_name' => 'Quacker',
            'email' => 'admin@quacker.es',
            'email_verified_at' => now(),
            'password' => Hash::make('Admin123'),
        ]);

        // Quack de prueba para desarrollo
        $quack = Quack::factory()->create([
            'user_id' => User::max('id'),
            'content' => 'Bueno, son las 5, no he comido, pero Quacker ya tiene #quashtags',
            'created_at' => now()->addSeconds(1)
        ]);

        $quashtag = Quashtag::create(['name' => 'quashtags']);
        $quack->quashtags()->attach($quashtag);
    }
}
