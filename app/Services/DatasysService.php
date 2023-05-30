<?php
namespace App\Services;

use SimpleXMLElement;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class DatasysService
{

    public function getSales($datasysUrl, $datasysToken)
    {
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
                  <DataInicial>2023-04-01</DataInicial>
                  <DataFinal>2023-04-01</DataFinal>
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

        $stringVendas = 'APARELHO;';

        $tipoVendas = explode(';', $stringVendas);

        foreach($responseArray as $row) {
            if($row['Tipo_x0020_Pedido']== 'Venda') {

                foreach($tipoVendas as $tipo) {

                    if($row['Grupo_x0020_Estoque'] == $tipo) {
                        array_push($return, $row);
                    }
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
