<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        $this->call([
            UserSeeder::class,
        ]);*/
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Imagem Telecom',
             'email' => 'imagemtelecom@gmail.com',
             'password' => Hash::make('link2b@2023'),
             'is_admin' => false,
         ]);
    }
}
