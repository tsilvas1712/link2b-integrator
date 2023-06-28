<?php

  namespace App\Http\Controllers\Integrador\Admin\ACL;

  use App\Http\Controllers\Controller;
  use App\Models\Profile;
  use App\Models\Tenant;
  use Illuminate\Http\Request;

  class TenantProfileController extends Controller
  {
    protected $profile, $tenant;

    public function __construct(Profile $profile, Tenant $tenant)
    {
      $this->profile = $profile;
      $this->tenant = $tenant;

      $this->middleware(['can:Admin']);
    }

    public function profilesAvailable($idTenant)
    {
      $tenant = $this->tenant->find($idTenant);
      if (!$tenant) {
        return redirect()->back();
      }

      $profiles = $tenant->profilesAvailable();

      return view('Integrador.Tenant.Profiles.available', compact('profiles', 'tenant'));
    }

    public function attachProfileTenant(Request $request, $idTenant)
    {
      $tenant = $this->tenant->find($idTenant);
      if (!$tenant) {
        return redirect()->back();
      }

      if (!$request->profiles || count($request->profiles) == 0) {
        return redirect()
          ->back()
          ->with('info', 'Precisa escolhar pelo menos um perfil !');
      }

      $tenant->profiles()->attach($request->profiles);

      return redirect()->route('tenants.profiles', $tenant->id);
    }

    public function profiles($idTenant)
    {
      $tenant = $this->tenant->find($idTenant);
      if (!$tenant) {
        return redirect()->back();
      }

      $profiles = $tenant->profiles;

      return view('Integrador.Tenant.Profiles.index', compact('profiles', 'tenant'));
    }


  }
