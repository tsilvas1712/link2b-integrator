<?php

namespace App\Jobs;

use App\Models\Campaign;
use App\Models\Sale;
use App\Services\Link2BService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class WhatsSend implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $sale;
  protected $campaings;

  /**
   * Create a new job instance.
   */
  public function __construct(object $sale, object $campaings)
  {
    $this->sale = $sale;
    $this->campaings = $campaings;
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    $client = new Client();
    $url = trim($this->campaings->endpoint_link2b);
    $headers = [
      'Content-Type' => 'application/json'
    ];
    $body = json_encode([
      "phone" => "5511985630003",
      "name" => $this->sale->nome_cliente,
      "produto" => $this->sale->descr_prod,
      "loja" => $this->sale->filial
    ], JSON_THROW_ON_ERROR);

    Log::info("Start Send Link2Bot for Phone: " . json_encode($this->sale));
    /*try {
      $request = new Request('POST', $url, $headers, $body);
      $res = $client->sendAsync($request)->wait();
      if ($res->getStatusCode()) {
        $this->sale->update(['status' => 'ENVIADO']);
      }
    } catch (ClientException  $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
      $this->sale->update(['status' => 'ERROR']);
      Log::error("Erro ao enviar: " . json_encode($this->sale));
      Log::info("Erro ao enviar: " . json_encode($responseBodyAsString));
      dd($responseBodyAsString);
    }*/
    Log::info("End Send Link2Bot");
    $this->sale->update(['status' => 'ENVIADO']);
  }
}
