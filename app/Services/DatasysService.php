<?php
namespace App\Services;

use SimpleXMLElement;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;

class DatasysService
{

    public function getSales($datasysUrl, $datasysToken, $dataFiltro)
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
          CURLOPT_POSTFIELDS =>'<?xml version="1.0" encoding="utf-8"?>
            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
              <soap:Body>
                <BaixarVendas xmlns="http://tempuri.org/">
                  <Token>'.$datasysToken.'</Token>
                  <DataInicial>'.$dateFilter.'</DataInicial>
                  <DataFinal>'.$dateFilter.'</DataFinal>
                </BaixarVendas>
              </soap:Body>
            </soap:Envelope>',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: text/xml'
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

        if($stringVendas === null){
          $tipoVendas = false;  
        }else{
          $tipoVendas = explode(';', $stringVendas);
        }
        

        foreach($responseArray as $row) {
            if($row['Tipo_x0020_Pedido']== 'Venda') {

              if($tipoVendas){                
                foreach($tipoVendas as $tipo) {
                  if($row['Modalidade_x0020_Venda'] == $tipo) {
                      array_push($return, $row);
                  }
                }
              }else{
                array_push($return, $row);
              }
                
                
            }
        }

        return $return;

    }

    public function saveSales(array $salles)
    {
        dd($salles);

    }
}
