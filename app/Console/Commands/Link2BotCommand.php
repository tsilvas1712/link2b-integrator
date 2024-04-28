<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\Sale;
use App\Services\Link2BService;
use Illuminate\Console\Command;

class Link2BotCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'link2bot:send';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Dispara Mensagem Whatsapp';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    return $this->info($this->sendWhats());
  }

  public function sendWhats()
  {
    $campaigns = Campaign::where('active', true)->get();

    $link2BService = new Link2BService();
    $count = 0;

    foreach ($campaigns as $campaign) {
      $sales = Sale::where('status', 'PENDENTE')->orWhere('status', 'PORTABILIDADE')->get();

      foreach ($sales as $sale) {
        $count++;

        $multiSales = Sale::where('gsm', $sale['gsm'])
          ->where('id_venda', $sale['id_venda'])
          ->where('modalidade', $sale['modalidade'])
          ->get();

        if (count($multiSales) > 1) {
          $first = true;
          foreach ($multiSales as $row) {
            if ($first) {
              $link2BService->sendWhats($row, $campaign);
              $first = false;
            } else {
              $row->update(['status' => 'REPETIDO']);
            }
          }
        } else {
          $link2BService->sendWhats($sale, $campaign);
        }
      }
    }

    return $count;
  }
}
