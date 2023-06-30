<?php

  namespace App\Console\Commands;

  use App\Models\Campaign;
  use App\Models\Datasys;
  use App\Models\Sale;
  use App\Repository\DatasysRepository;
  use App\Repository\SaleRepository;
  use App\Services\DatasysService;
  use Illuminate\Console\Command;

  class DatasysSyncCommand extends Command
  {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datasys:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronizar todos os dados da Datasys';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      $campaigns = Campaign::where('active', true)->get();
      $datasys = new Datasys();
      $sale = new Sale();
      $repositorySale = new SaleRepository($sale);
      $repositoryDatasys = new DatasysRepository($datasys);
      $dataService = new DatasysService($repositorySale, $repositoryDatasys);


      foreach ($campaigns as $campaign) {
        $datasysToken = $campaign->token_customer;
        $datasysUrl = $campaign->endpoint_customer;
        $tenant_id = $campaign->tenant_id;

        $dataService->syncDatasys($datasysUrl, $datasysToken, $tenant_id);
        $dataService->sendDatasys($tenant_id, $campaign->id, $campaign->sales_modalities);
        $datasys->truncate();
      }


    }
  }
