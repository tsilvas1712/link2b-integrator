<?php

namespace App\Repository;

use App\Models\Datasys;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * class DatasysRepository
 * @author Thiago Silva <thiago.silva@ntsistemasweb.dev.br>
 */
class DatasysRepository
{

  protected $entity;

  /**
   *
   * @param  Datasys $datasys
   */
  public function __construct(Datasys $datasys)
  {
    $this->entity = $datasys;
  }

  public function saveDatasys(array $data)
  {
    $datasysExists = $this->entity->where('id_venda', $data['id'])->first();


    if ($datasysExists === null) {

      $this->entity->create([
        'tenant_id' => $data['tenant_id'],
        'id_venda' => $data['id'],
        'gsm' => $data['GSM'],
        'gsm_portable' => is_array($data['GSMPortado']) ? ' ' : $data['GSMPortado'],
        'filial' => $data['Filial'],
        'data_pedido' => Carbon::parse($data['Data_x0020_pedido']),
        'nf_compra' => $data['NF_x0020_Compra'] ?? null,
        'tipo_pedido' => $data['Tipo_x0020_Pedido'],
        'modalidade' => $data['Modalidade_x0020_Venda'],
        'nota_fiscal' => $data['Nota_x0020_Fiscal'] ?? null,
        'data_nf' => Carbon::parse($data['DT_x0020_Compra']),
        'descricao' => $data['Descricao'] ?? null,
        'fabricante' => $data['Fabricante'] ?? null,
        'serial' => $data['Serial'] ?? null,
        'qantidade' => $data['Qtde'],
        'valor_tabela' => $data['Valor_x0020_Tabela'],
        'valor_plano' => $data['Valor_x0020_Plano'],
        'valor_caixa' => $data['Valor_x0020_Caixa'] ?? null,
        'desconto' => $data['Descontos'],
        'total_item' => $data['Total_x0020_Item'],
        'nome_vendedor' => $data['Nome_x0020_Vendedor'],
        'nome_cliente' => $data['Nome_x0020_Cliente'],
      ]);
    }
  }

  public function findDatasys($tenant_id, $modalidade)
  {
    $pesquisa = $modalidade;
    $array = explode(";", $pesquisa);

    $datasys = $this->entity->where('tenant_id', $tenant_id)
      ->whereIn('modalidade', $array)
      ->get();

    return $datasys;
  }
}
