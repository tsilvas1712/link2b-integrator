<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRangeRequest;
use App\Models\Campaign;
use App\Models\Datasys;
use App\Models\Sale;
use App\Repository\DatasysRepository;
use App\Repository\SaleRepository;
use App\Services\DatasysService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    protected $repository;

    public function __construct(Campaign $campaign)
    {
        $this->repository = $campaign;

        $this->middleware(['can:Campanhas']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->is_admin) {
            $campaigns = $this->repository->latest()->paginate();

            return view('Integrador.Campaigns.index', compact('campaigns'));
        }

        $campaigns = $this->repository->where('tenant_id', $user->tenant->id)->latest()->paginate();


        return view('Integrador.Campaigns.index', compact('campaigns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['active'] = true;
        $user = auth()->user();

        $data['tenant_id'] = $user->tenant->id;

        $this->repository->create($data);

        return redirect()->route('campanhas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Integrador.Campaigns.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $campaign = $this->repository->where('id', $id)->first();

        if (!$campaign) {
            return redirect()->back();
        }

        return view('Integrador.Campaigns.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $campaign = $this->repository->where('id', $id)->first();

        if (!$campaign) {
            return redirect()->back();
        }

        return view('Integrador.Campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $campaign = $this->repository->where('id', $id)->first();

        if (!$campaign) {
            return redirect()->back();
        }

        $campaign->update($request->all());

        return redirect()->route('campanhas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $campaign = $this->repository->where('id', $id)->first();

        if (!$campaign) {
            return redirect()->back();
        }

        $campaign->delete();

        return redirect()->route('campanhas.index');
    }

    public function maitence($id)
    {
        $campaign = $this->repository->where('id', $id)->first();
        $sales = null;

        return view('Integrador.Campaigns.maintence', compact('campaign','sales'));
    }

    public function maitenceSync($id, Request $request)
    {
        $campaign = $this->repository->where('id', $id)->first();
        $data = $request->all();

        $datasys = new Datasys();
        $sale = new Sale();
        $repositorySale = new SaleRepository($sale);
        $repositoryDatasys = new DatasysRepository($datasys);
        $dataService = new DatasysService($repositorySale, $repositoryDatasys);
        $datasysToken = $campaign->token_customer;
        $datasysUrl = $campaign->endpoint_customer;
        $tenant_id = $campaign->tenant_id;


        $dataService->syncDatasys($datasysUrl, $datasysToken, $tenant_id,$data['data_inicial'],$data['data_final']);
        $sales = $dataService->sendDatasys($tenant_id, $campaign->id, $campaign->sales_modalities);
        $datasys->truncate();

          return view('Integrador.Campaigns.maintence', [
              'campaign' => $campaign,
              'sales' => $sales
          ]);
      }
}
