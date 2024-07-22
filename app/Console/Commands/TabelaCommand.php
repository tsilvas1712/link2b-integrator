<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\Datasys;
use App\Models\Sale;
use App\Repository\DatasysRepository;
use App\Repository\SaleRepository;
use App\Services\DatasysService;
use Illuminate\Console\Command;

class TabelaCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'datasys:tabela';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Sincronizar todos os dados da tabela Datays para envio de mensagens';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $campaigns = Campaign::where('active', true)->get();
    $datasys = new Datasys();
    $sale = new Sale();

    foreach ($campaigns as $campaign) {
      $repositorySale = new SaleRepository($sale);
      $repositoryDatasys = new DatasysRepository($datasys);
      $dataService = new DatasysService($repositorySale, $repositoryDatasys);

      $tenant_id = $campaign->tenant_id;

      $dataService->sendDatasys($tenant_id, $campaign->id, $campaign->sales_modalities);
    }
  }
}
