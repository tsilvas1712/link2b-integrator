<?php

  namespace App\Http\Controllers\Integrador;

  use App\Http\Controllers\Controller;
  use App\Http\Requests\StoreUpdateTenant;
  use App\Models\Tenant;

  class TenantController extends Controller
  {
    protected $repository;

    public function __construct(Tenant $tenant)
    {
      $this->repository = $tenant;
      $this->middleware(['can:Empresas']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $tenants = $this->repository->latest()->paginate(8);

      return view('Integrador.Tenant.index', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateTenant $request)
    {
      $data = $request->all();
      $data['active'] = true;

      $this->repository->create($data);

      return redirect()->route('tenants.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      //
      return view('Integrador.Tenant.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $tenant = $this->repository->where('id', $id)->first();

      if (!$tenant) {
        return redirect()->back();
      }

      return view('Integrador.Tenant.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $tenant = $this->repository->where('id', $id)->first();

      if (!$tenant) {
        return redirect()->back();
      }

      return view('Integrador.Tenant.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateTenant $request, string $id)
    {
      $tenant = $this->repository->where('id', $id)->first();

      if (!$tenant) {
        return redirect()->back();
      }

      $tenant->update($request->all());

      return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $tenant = $this->repository->where('id', $id)->first();

      if (!$tenant) {
        return redirect()->back();
      }

      $tenant->delete();

      return redirect()->route('tenants.index');
    }
  }
