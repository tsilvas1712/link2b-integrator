<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Datasys;
use App\Services\DatasysService;
use Illuminate\Http\Request;

class DatasysController extends Controller
{
  //
  protected $datasysService;

  public function __construct(DatasysService $datasysService)
  {
    $this->datasysService = $datasysService;
  }

  public function index()
  {
    $datasys = Datasys::query()->where('tenant_id', auth()->user()->tenant_id)->get();

    return view('Integrador.Datasys.index', compact('datasys'));
  }

  public function uploadCsv(Request $request)
  {
    $request->validate([
      'import_csv' => 'required|mimes:csv,txt',
    ]);

    $dataFile = array_map('str_getcsv', file($request->file('import_csv')), ['delimiter' => ';']);
    $headers = [
      "id_venda",
      "gsm",
      "gsm_portable",
      "filial",
      "data_pedido",
      "nf_compra",
      "tipo_pedido",
      "cupom_fiscal",
      "modalidade",
      "nota_fiscal",
      "data_nf",
      "descricao",
      "fabricante",
      "serial",
      "qantidade",
      "valor_tabela",
      "plano_adicional",
      "valor_plano",
      "valor_caixa",
      "desconto",
      "total_item",
      "nome_vendedor",
      "nome_cliente",
      
    ];
    //dump(explode(';', $dataFile[0][0]));
    //dd(in_array($headers[1],   $dataFile[0]));

    foreach ($headers as $header) {
      if (!in_array($header,   $dataFile[0])) {
        return redirect()->back()->with('error', 'Arquivo inválido, não foi possível encontrar o cabeçalho correto. - ' . $header . ' não encontrado.');
      }
    }


    foreach ($dataFile as $keyData => $row) {
      if ($keyData == 0) {
        continue;
      }
      $values = explode(';', $row[0]);

      foreach ($headers as $key => $header) {
        $arrayData[$keyData][$header] = str_replace('"', '', $values[$key]);
        $arrayData[$keyData]['tenant_id'] = auth()->user()->tenant_id;
      }
    }

    Datasys::insert($arrayData);
    $datasys = Datasys::query()->where('tenant_id', auth()->user()->tenant_id)->get();



    return redirect()->back()->with('success', 'Arquivo importado com sucesso. Total de registros: ' . count($arrayData));
  }
}
