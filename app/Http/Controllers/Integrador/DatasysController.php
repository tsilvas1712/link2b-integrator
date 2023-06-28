<?php

  namespace App\Http\Controllers\Integrador;

  use App\Http\Controllers\Controller;
  use App\Models\Campaign;
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
      $campaigns = Campaign::where('active', true)->get();

      foreach ($campaigns as $campaign) {
        $datasysToken = $campaign->token_customer;
        $datasysUrl = $campaign->endpoint_customer;
        $datasysCampaign = $campaign->id;
        $datasysFiltro = $campaign->sales_modalities;
        $datasys = $this->datasysService->getSales($datasysUrl, $datasysToken, $datasysFiltro, $datasysCampaign);
      }


      return view('Integrador.Datasys.index', compact('datasys'));
    }
  }
