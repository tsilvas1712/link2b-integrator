<?php

namespace App\Console\Commands;

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
        $sales = new DatasysService();
        $datasysToken = 'RFRTMzlfVElNX0lNQUdFTV9TUA==';
        $datasysUrl = 'https://wsintegracaoclientes.datasys.online/clientes/ConsultasDatasys.asmx';

        return count($sales->getSales($datasysUrl, $datasysToken));
    }
}
