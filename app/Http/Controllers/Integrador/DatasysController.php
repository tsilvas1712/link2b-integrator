<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\DatasysService;

class DatasysController extends Controller
{
    //
    protected $datasysService;

    public function __construct(DatasysService $datasysService)
    {
        $this->datasysService = $datasysService;
    }

    public function index()
    {
        $customers = Customer::where('active', true)->get();
        
        foreach($customers as $customer) {
            $datasysToken = $customer->token_customer;
            $datasysUrl = $customer->endpoint_customer;
            $datasysFiltro = $customer->tipo_vendas;
            $datasys = $this->datasysService->getSales($datasysUrl, $datasysToken, $datasysFiltro);
        }
        

        

        return view('Integrador.Datasys.index', compact('datasys'));
    }
}
