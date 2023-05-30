<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
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
        $datasysToken = 'RFRTMzlfVElNX0lNQUdFTV9TUA==';
        $datasysUrl = 'https://wsintegracaoclientes.datasys.online/clientes/ConsultasDatasys.asmx';
        $datasys = $this->datasysService->getSales($datasysUrl, $datasysToken);

        

        return view('Integrador.Datasys.index', compact('datasys'));
    }
}
