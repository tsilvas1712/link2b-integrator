<?php

namespace App\Repository;

use App\Models\Datasys;
use App\Models\Sale;
use Carbon\Carbon;

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
    $formatPhone = array("(", ")", "-", " ");
    $phone = str_replace($formatPhone, '', $data['Fone_x0020_Cliente']);

    $saleExists = $this->entity
      ->where('id_venda', $data['id'])
      ->where('modalidade', $data['modalidade'])
      ->first();

    if ($saleExists === null) {
      $this->entity->firstOrCreate(
        [
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

  public function saveSend(object $data)
  {
    $sendDatasys = [
      'campaign_id' => $data->campaign_id,
      'id_venda' => $data->id_venda,
      'gsm' => $data->gsm,
      'filial' => $data->filial,
      'data_pedido' => $data->data_pedido,
      'nf_compra' => $data->nf_compra,
      'tipo_pedido' => $data->tipo_pedido,
      'modalidade' => $data->modalidade,
      'nota_fiscal' => $data->nota_fiscal,
      'data_nf' => $data->data_nf,
      'descricao' => $data->descricao,
      'fabricante' => $data->fabricante,
      'serial' => $data->serial,
      'qantidade' => $data->qantidade,
      'valor_tabela' => $data->valor_tabela,
      'valor_plano' => $data->valor_plano,
      'valor_caixa' => $data->valor_caixa,
      'desconto' => $data->desconto,
      'total_item' => $data->total_item,
      'nome_vendedor' => $data->nome_vendedor,
      'nome_cliente' => $data->nome_cliente,
      'status' => $data->status
    ];

    $this->entity->firstOrCreate($sendDatasys);
    Datasys::where('id_venda', $data->id_venda)
      ->where('modalidade', $data->modalidade)
      ->delete();
  }
}
