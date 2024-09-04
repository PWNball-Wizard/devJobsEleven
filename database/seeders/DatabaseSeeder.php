<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //! lo que hace esta linea de codigo es llama al seeder SalarioSeeder
        // $this->call(SalarioSeeder::class);
        // $this->call(CategoriaSeeder::class);
        // $this->call(PermissionSeeder::class);

        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
