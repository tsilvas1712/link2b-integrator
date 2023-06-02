<?php

namespace App\Repository;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SaleRepository
{
    protected $entity;

    public function __construct(Sale $sale)
    {
        $this->entity = $sale;
    }
    public function save(array $data)
    {
        //dd($data);
        Log::debug($data);

        $saleExists = $this->entity->where('id_venda', $data['id'])->first();

        if ($saleExists === null) {
            $this->entity->firstOrCreate([
                'campaign_id' => $data['campaign_id'],
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
            ]
            );
        }

    }
}
