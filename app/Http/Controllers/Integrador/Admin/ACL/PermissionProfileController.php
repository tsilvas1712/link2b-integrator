<?php

  namespace App\Http\Controllers\Integrador\Admin\ACL;

  use App\Http\Controllers\Controller;
  use App\Models\Permission;
  use App\Models\Profile;
  use Illuminate\Http\Request;

  class PermissionProfileController extends Controller
  {
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
      $this->profile = $profile;
      $this->permission = $permission;

      $this->middleware(['can:Admin']);
    }

    public function permissionsAvailable($idProfile)
    {
      $profile = $this->profile->with('permissions')->find($idProfile);
      if (!$profile) {
        return redirect()->back();
      }

      $permissions = $profile->permissionsAvailable();

      return view('Integrador.Profile.Permissions.available', compact('profile', 'permissions'));
    }

    public function attachPermissionsProfile(Request $request, $idProfile)
    {
      $profile = $this->profile->with('permissions')->find($idProfile);
      if (!$profile) {
        return redirect()->back();
      }

      if (!$request->permissions || count($request->permissions) == 0) {
        return redirect()
          ->back()
          ->with('info', 'Precisa escolhar pelo menos uma permissão !');
      }


      $profile->permissions()->attach($request->permissions);

      return redirect()->route('profiles.permissions', $profile->id);
    }

    public function permissions($idProfile)
    {
      $profile = $this->profile->with('permissions')->find($idProfile);
      if (!$profile) {
        return redirect()->back();
      }

      $permissions = $profile->permissions;

      return view('Integrador.Profile.Permissions.index', compact('profile', 'permissions'));
    }
  }
