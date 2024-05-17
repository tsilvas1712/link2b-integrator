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
   * @param Datasys $datasys
   */
  public function __construct(Datasys $datasys)
  {
    $this->entity = $datasys;
  }

  public function saveDatasys(array $data)
  {
    $datasysExists = $this->entity->where('id_venda', $data['id'])->first();

    if ($datasysExists === null) {
      try {
        $dataSave = [
          'tenant_id' => $data['tenant_id'],
          'id_venda' => $data['id'],
          'gsm' => "55" . $data['GSM'],
          'gsm_portable' => is_array($data['GSMPortado']) ? ' ' : $data['GSMPortado'],
          'filial' => $data['Filial'],
          'data_pedido' => Carbon::parse($data['Data_x0020_pedido']),
          'nf_compra' => is_array($data['NF_x0020_Compra']) ? ' ' : $data['NF_x0020_Compra'],
          'tipo_pedido' => $data['Tipo_x0020_Pedido'],
          'modalidade' => $data['Modalidade_x0020_Venda'],
          'nota_fiscal' => $data['Nota_x0020_Fiscal'] ?? null,
          'data_nf' => date('Y-m-d H:i:s', strtotime($data['DT_x0020_Compra'])),
          'descricao' => $data['Descricao'] ?? null,
          'fabricante' => $data['Fabricante'] ?? null,
          'serial' => is_array($data['Serial']) ? ' ' : $data['Serial'],
          'qantidade' => $data['Qtde'],
          'valor_tabela' => $data['Valor_x0020_Tabela'],
          'valor_plano' => $data['Valor_x0020_Plano'],
          'valor_caixa' => $data['Valor_x0020_Caixa'] ?? null,
          'desconto' => $data['Descontos'],
          'total_item' => $data['Total_x0020_Item'],
          'nome_vendedor' => $data['Nome_x0020_Vendedor'],
          'nome_cliente' => $data['Nome_x0020_Cliente'],
        ];

        Log::info('Dados Salvos ID Pedido ' . $data['id']);
        $this->entity->create($dataSave);
      } catch (\Exception $e) {
        throw $e;
        Log::error($e->getMessage());
        Log::info('Dados com Erro ' . $data['id']);
      }
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
