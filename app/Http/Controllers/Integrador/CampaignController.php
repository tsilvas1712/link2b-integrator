<?php

  namespace App\Http\Controllers\Integrador;

  use App\Http\Controllers\Controller;
  use App\Models\Campaign;
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
  }
