<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenant;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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

  public function listUsers($tenant)
  {
    $users = User::where('tenant_id', $tenant)->get();
    $tenant = $this->repository->where('id', $tenant)->first();


    return view('Integrador.Tenant.users.index', compact(['users', 'tenant']));
  }

  public function createUser($tenant)
  {
    return view('Integrador.Tenant.users.create', [
      'tenant' => $tenant
    ]);
  }

  public function saveUser(Request $request)
  {
    $data = $request->all();
    $data['is_active'] = true;
    $data['password'] = Hash::make($data['password']);
    $user = new User();
    $user->create($data);

    return redirect()->route('tenant.users', $data['tenant_id']);
  }
  public function editUser($id)
  {
    $user = User::where('id', $id)->first();

    if (!$user) {
      return redirect()->back();
    }
    return view('Integrador.Tenant.users.edit', compact('user'));
  }

  public function showUser($id)
  {
    $user = User::where('id', $id)->first();

    if (!$user) {
      return redirect()->back();
    }
    return view('Integrador.Tenant.users.show', compact('user'));
  }

  public function updateUser(Request $request, $id)
  {
    $user = User::where('id', $id)->first();

    if (!$user) {
      return redirect()->back();
    }
    $data = $request->all();
    $data['tenant_id'] = $user->tenant_id;
    $data['password'] = Hash::make($data['password']);

    $user->update($data);
    return view('Integrador.Tenant.users.show', compact('user'));
  }

  public function destroyUser($id)
  {
    $user = User::where('id', $id)->first();

    if (!$user) {
      return redirect()->back();
    }
    return view('Integrador.Tenant.users.show', compact('user'));
  }

  public function gerarToken($id)
  {
    $tenant = Tenant::where('id', $id)->first();
    $user = User::where('tenant_id', $id)->first();
    $user->tokens()->delete();

    $token = $user->createToken('access_token')->plainTextToken;
    $tenant->update(['token' => $token]);


    return redirect()->route('tenant.token', $id);
  }

  public function tenantToken($id)
  {
    $tenant = Tenant::where('id', $id)->first();

    return view('Integrador.Tenant.token', compact('tenant'));
  }
}
