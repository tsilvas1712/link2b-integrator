<?php

namespace App\Repository;

use App\Mail\TestMail;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SaleRepository
{
    protected $entity;

    /**
     * @param Sale $sale
     */
    public function __construct(Sale $sale)
    {
        $this->entity = $sale;
    }

    /**
     * @param array $data
     * @return void
     */
    public function save(array $data)
    {


        $formatPhone = array("(", ")", "-"," ");
        $phone = str_replace($formatPhone, '',$data['Fone_x0020_Cliente']);

        $saleExists = $this->entity->where('id_venda', $data['id'])->first();

        if ($saleExists === null) {
            $this->entity->firstOrCreate([
                    'campaign_id' => $data['campaign_id'],
                    'gsm' => $data['GSM'],
                    'id_venda' => $data['id'],
                    'filial' => $data['Filial'],
                    'data_pedido' => Carbon::parse($data['Data_x0020_pedido']),
                    'tipo_pedido' => $data['Tipo_x0020_Pedido'],
                    'cod_produto_datasys' => $data['Cod_x0020_produto'],
                    'descr_prod' => $data['Descr_x0020_Comercial'],
                    'modalidade_venda' => $data['Modalidade_x0020_Venda'],
                    'valor_total' => $data['Valor_x0020_Caixa'],
                    'nome_vendedor' => $data['Nome_x0020_Vendedor'],
                    'nome_cliente' => $data['Nome_x0020_Cliente'],
                    'status' => false,
                ]
            );
        }

    }
}
