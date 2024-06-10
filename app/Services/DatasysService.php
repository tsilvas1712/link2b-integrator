<?php

namespace App\Services;

use App\Models\History;
use App\Repository\DatasysRepository;
use App\Repository\SaleRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;
use Flowgistics\XML\XML;

class DatasysService
{
  protected $repository, $datasysRepository;

  public function __construct(SaleRepository $saleRepository, DatasysRepository $datasysRepository)
  {
    $this->repository = $saleRepository;
    $this->datasysRepository = $datasysRepository;
  }

  public function getSales($datasysUrl, $datasysToken, $dataFiltro, $datasysCampaign)
  {
    $dateFilter = Carbon::now()->subDays(1)->format('Y-m-d');

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $datasysUrl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '<?xml version="1.0" encoding="utf-8"?>
            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
              <soap:Body>
                <BaixarVendas xmlns="http://tempuri.org/">
                  <Token>' . $datasysToken . '</Token>
                  <DataInicial>' . $dateFilter . '</DataInicial>
                  <DataFinal>' . $dateFilter . '</DataFinal>
                </BaixarVendas>
              </soap:Body>
            </soap:Envelope>',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: text/xml',
      ),
    ));

    $response = curl_exec($curl);

    $res = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);


    curl_close($curl);
    $xml = new SimpleXMLElement($res);
    $body = $xml->xpath('//soapBody')[0];
    $array = json_decode(json_encode((array)$body), true);

    $responseArray = $array['BaixarVendasResponse']['BaixarVendasResult']['NewDataSet']['Table'];

    $return = [];

    $stringVendas = $dataFiltro;

    if ($stringVendas === null) {
      $tipoVendas = false;
    } else {
      $tipoVendas = explode(';', $stringVendas);
    }

    foreach ($responseArray as $row) {
      if ($row['Tipo_x0020_Pedido'] == 'Venda') {
        $row['campaign_id'] = $datasysCampaign;


        if ($tipoVendas) {
          foreach ($tipoVendas as $tipo) {
            if ($row['Modalidade_x0020_Venda'] == $tipo) {
              $this->repository->save($row);
            }
          }
        } else {
          $this->repository->save($row);
        }
      }
    }

    return $return;
  }

  /**
   * syncDatasys
   *
   * @param string $datasysUrl
   * @param string $datasysToken
   * @param integer $tenant_id
   * @return void
   */
  public function syncDatasys($datasysUrl, $datasysToken, $tenant_id, $dInicial = null, $dFinal = null)
  {
    date_default_timezone_set('America/Sao_Paulo');

    $dateInicial = $dInicial;
    $dateFinal = $dFinal;

    if ($dInicial === null) {
      $dateInicial = Carbon::now()->subDays(1)->format('Y-m-d');
      $dateFinal = Carbon::now()->subDays(1)->format('Y-m-d');
    }



    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $datasysUrl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '<?xml version="1.0" encoding="utf-8"?>
            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
              <soap:Body>
                <BaixarVendas xmlns="http://tempuri.org/">
                  <Token>' . $datasysToken . '</Token>
                  <DataInicial>' . $dateInicial . '</DataInicial>
                  <DataFinal>' . $dateFinal . '</DataFinal>
                </BaixarVendas>
              </soap:Body>
            </soap:Envelope>',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: text/xml',
      ),
    ));
    $response = curl_exec($curl);

    $res = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);

    curl_close($curl);
    if ($res === '') {
      return "Erro ao Conectar com a API";
    }
    try {
      $reader = XML::import($res)->toJson();
    } catch (\Exception $e) {
      Log::error($e->getMessage());
      Log::error('Erro ao Conectar com a API');
      return "Erro ao Conectar com a API";
    }

    $data = json_decode($reader, true)['soapBody']['BaixarVendasResponse']['BaixarVendasResult']['NewDataSet']['Table'];

    $dados = [];
    $count = 0;
    foreach ($data as $row) {

      $dataSave = [];
      if (!isset($row['Modalidade_x0020_Venda'])) {
        $row['Modalidade_x0020_Venda'] = null;
      }
      if (!is_array($row['GSM']) && $row['Tipo_x0020_Pedido'] == 'Venda') {
        $dataSave = [
          'tenant_id' => $tenant_id,
          'id_venda' => $row['id'],
          'gsm' => "55" . $row['GSM'],
          'gsm_portable' => is_array($row['GSMPortado']) ? null : $row['GSMPortado'],
          'filial' => $row['Filial'],
          'data_pedido' => Carbon::parse($row['Data_x0020_pedido']),
          'nf_compra' => is_array($row['NF_x0020_Compra']) ? ' ' : $row['NF_x0020_Compra'],
          'tipo_pedido' => $row['Tipo_x0020_Pedido'],
          'modalidade' =>  $row['Modalidade_x0020_Venda'],
          'nota_fiscal' => $row['Nota_x0020_Fiscal'] ?? null,
          'data_nf' => date('Y-m-d H:i:s', strtotime($row['DT_x0020_Compra'])),
          'descricao' => $row['Descricao'] ?? null,
          'fabricante' => $row['Fabricante'] ?? null,
          'serial' => is_array($row['Serial']) ? ' ' : $row['Serial'],
          'qantidade' => $row['Qtde'],
          'valor_tabela' => $row['Valor_x0020_Tabela'],
          'valor_plano' => $row['Valor_x0020_Plano'],
          'valor_caixa' => $row['Valor_x0020_Caixa'] ?? null,
          'desconto' => $row['Descontos'],
          'total_item' => $row['Total_x0020_Item'],
          'nome_vendedor' => is_array($row['Nome_x0020_Vendedor']) ? null : $row['Nome_x0020_Vendedor'],
          'nome_cliente' => is_array($row['Nome_x0020_Cliente']) ? null : $row['Nome_x0020_Cliente'],
        ];
      }
      //$this->datasysRepository->saveDatasys($row);
      if ($dataSave != []) {

        $dados[] = $dataSave;
        $count++;
      }
    }

    $this->datasysRepository->saveDatasys($dados);



    return $count . " Registros Gravados com Sucesso !!!";
  }

  public function sendDatasys($tenant_id, $campaign_id, $modalidade)
  {
    $datasys = $this->datasysRepository->findDatasys($tenant_id, $modalidade);
    $history = new History();

    Log::info('Enviando Dados Datasys');

    $count = 0;

    foreach ($datasys as $data) {
      $data->campaign_id = $campaign_id;
      if (!($data->gsm_portable === " " || $data->gsm_portable === null)) {
        $data->gsm = "55" . $data->gsm_portable;
        $data->status = 'PORTABILIDADE';
      } else {
        $data->status = 'PENDENTE';
      }

      $this->repository->saveSend($data);
      $count++;
    }

    $history->create(
      [
        'campaign_id' => $campaign_id,
        'counter_register' => $count,

      ]
    );

    return count($datasys) . " Registros Encontrados !!!";
  }

  public function cleanDatasys($tenant_id)
  {
    $this->datasysRepository->delete($tenant_id);
  }
}
