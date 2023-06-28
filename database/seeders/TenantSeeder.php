<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tenants')->insert([
                   'tenant_name' => 'Imagem Telecom',
                   'cpf_cnpj' => '99999999000999',
                   'phone' => '11981324128',
                   'contact' => 'Leandro',
                    'active' => true,
               ]);
    }
}
