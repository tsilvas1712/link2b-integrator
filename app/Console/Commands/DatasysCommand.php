<?php

namespace App\Console\Commands;

use App\Models\Customer;
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
        $customers = Customer::where('active', true)->get();
        $sales = new DatasysService();
        
        foreach($customers as $customer) {
            $datasysToken = $customer->token_customer;
            $datasysUrl = $customer->endpoint_customer;
            $datasysFiltro = $customer->tipo_vendas;
            $datasys = $sales->getSales($datasysUrl, $datasysToken, $datasysFiltro);
        }
        
        return count($datasys);
    }
}
