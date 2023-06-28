<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
               'name' => 'Link2 Data',
               'email' => 'link2data@link2b.com.br',
               'password' => Hash::make('Link2b@2023'),
               'is_admin' => true,
           ]);

        DB::table('users')->insert([
               'name' => 'Imagem Telecom',
               'email' => 'imagem.telecom@link2b.com.br',
               'password' => Hash::make('Link2b@2023'),
               'is_admin' => false,
           ]);
    }
}
