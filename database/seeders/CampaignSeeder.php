<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('campaigns')->insert([
                     'tenant_id' => 1,
                     'name' => 'Vendas',
                     'sales_modalities' => 'ATIVAÇÃO CONTROLE;ATIVAÇÃO CONTROLE AP + CH;ATIVAÇÃO EXPRESS;ATIVAÇÃO PÓS PURO;ATIVAÇÃO PÓS PURO AP + CH;ATIVAÇÃO PRÉ-PAGO;DEPENDENTE FAMILIA + CHIP;MIGRAÇÃO CONTROLE + AP;MIGRAÇÃO CONTROLE + TC;MIGRAÇÃO PRÉ-PÓS;PORTABILIDADE CONTROLE;PORTABILIDADE DEPENDENTE FAMILIA;PORTABILIDADE EXPRESS;PORTABILIDADE FIXO;PORTABILIDADE PÓS PURO;PORTABILIDADE PÓS PURO AP + CH;TROCA DE APARELHO;UPGRADE CONTROLE + AP;UPGRADE PÓS-PÓS;',
                     'endpoint_customer' => 'https://wsintegracaoclientes.datasys.online/clientes/ConsultasDatasys.asmx',
                     'token_customer' => 'RFRTMzlfVElNX0lNQUdFTV9TUA==',
                     'endpoint_link2b' => 'https://link2botapi.link2b.com.br/api/webhooks/Yatv0J865CVNn4WBCkfY7Nl8lmtqHsT4',
                     'token_link2b' => '',
                     'active' => true,
                 ]);

    }
}
