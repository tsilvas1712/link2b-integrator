<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Requests\ReceiveDataRequest;
use App\Models\Datasys;
use App\Models\Tenant;
use App\Repository\DatasysRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataSyncController extends Controller
{

  //
  public function receiveData(ReceiveDataRequest $request)
  {
    $data = $request->validated();
    $datasys = new Datasys();
    $datasysRepository = new DatasysRepository($datasys);

    foreach ($data as $row) {
      $row['id'] = $row['id_venda'];
      $row['GSM'] = $row['gsm'];
      $row['GSMPortado'] = $row['gsm_portable'];
      $row['tenant_id'] = Auth::user()->tenant_id;
      $row['Data_x0020_pedido'] = $row['data_pedido'];
      $row['DT_x0020_Compra'] = $row['data_nf'];
      $row['Filial'] = $row['filial'];
      $row['Data_x0020_pedido'] = $row['data_pedido'];
      $row['NF_x0020_Compra'] = $row['nf_compra'];
      $row['Tipo_x0020_Pedido'] = $row['tipo_pedido'];
      $row['Modalidade_x0020_Venda']  = $row['modalidade'];
      $row['Nota_x0020_Fiscal'] = $row['nota_fiscal'];
      $row['Descricao'] = $row['descricao'] ?? null;
      $row['Fabricante'] = $row['fabricante'] ?? null;
      $row['Serial'] = $row['serial'];
      $row['Qtde'] = $row['qantidade'];
      $row['Valor_x0020_Tabela'] = $row['valor_tabela'];
      $row['Valor_x0020_Plano'] = $row['valor_plano'];
      $row['Valor_x0020_Caixa'] = $row['valor_caixa'] ?? null;
      $row['Descontos'] = $row['desconto'];
      $row['Total_x0020_Item'] = $row['total_item'];
      $row['Nome_x0020_Vendedor'] = $row['nome_vendedor'];
      $row['Nome_x0020_Cliente']  = $row['nome_cliente'];

      $datasysRepository->saveDatasys($row);
    }

    //Datasys::insert($data);

    return response()->json(count($data) . ' Registros Criados');
  }
}
