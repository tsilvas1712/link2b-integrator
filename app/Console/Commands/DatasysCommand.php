<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\Sale;
use App\Repository\SaleRepository;
use App\Services\DatasysService;
use Illuminate\Console\Command;

class DatasysCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'datasys:sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza as Vendas no Sistema Datasys';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        return $this->info($this->showSales());
    }

    protected function showSales()
    {
        $campaigns = Campaign::where('active', true)->get();
        $sale = new Sale();
        $repository = new SaleRepository($sale);
        $dataService = new DatasysService($repository);

        foreach ($campaigns as $campaign) {
            $datasysToken = $campaign->token_customer;
            $datasysUrl = $campaign->endpoint_customer;
            $datasysCampaign = $campaign->id;
            $datasysFiltro = $campaign->sales_modalities;
            $datasys = $dataService->getSales($datasysUrl, $datasysToken, $datasysFiltro, $datasysCampaign);
        }

        return count($datasys);
    }
}
