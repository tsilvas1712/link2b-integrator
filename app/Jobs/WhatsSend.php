<?php

  namespace App\Jobs;

  use GuzzleHttp\Client;
  use GuzzleHttp\Exception\ClientException;
  use GuzzleHttp\Psr7\Request;
  use Illuminate\Bus\Queueable;
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
      $data_pedido = date('d-m-Y', strtotime($this->sale->data_pedido));
      $data_nf = date('d-m-Y', strtotime($this->sale->data_nf));

      $headers = [
        'Content-Type' => 'application/json'
      ];
      $body = json_encode([
                            "phone" => $this->sale->gsm,
                            "nome_cliente" => $this->sale->nome_cliente,
                            "gsm_portable" => $this->sale->gsm_portable,
                            "data_pedido" => $data_pedido,
                            "nf_compra" => $this->sale->nf_compra,
                            "tipo_pedido" => $this->sale->tipo_pedido,
                            "modalidade" => $this->sale->modalidade,
                            "nota_fiscal" => $this->sale->nota_fiscal,
                            "data_nf" => $data_pedido,
                            "descricao" => $this->sale->descricao,
                            "fabricante" => $this->sale->fabricante,
                            "serial" => $this->sale->serial,
                            "quantidade" => $this->sale->quantidade,
                            "valor_tabela" => 'R$ ' . number_format($this->sale->valor_tabela, 2, ',', '.'),
                            "valor_plano" => 'R$ ' . number_format($this->sale->valor_plano, 2, ',', '.'),
                            "valor_caixa" => 'R$ ' . number_format($this->sale->valor_caixa, 2, ',', '.'),
                            "desconto" => $this->sale->desconto,
                            "total_item" => $this->sale->total_item,
                            "nome_vendedor" => $this->sale->nome_vendedor,
                            "filial" => $this->sale->filial
                          ], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);

      Log::info("Start Send Link2Bot for Phone: " . $body);
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
        Log::error($responseBodyAsString);
      }*/
      Log::info("End Send Link2Bot");
      $this->sale->update(['status' => 'ENVIADO']);
    }
  }
