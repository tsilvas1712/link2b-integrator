<?php

namespace App\Http\Controllers\Integrador\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantProfileController extends Controller
{
    protected $profile,$tenant;

    public function __construct(Profile $profile,Tenant $tenant)
    {
        $this->profile = $profile;
        $this->tenant = $tenant;
    }

    public function profiles($idTenant)
    {
        $tenant = $this->tenant->find($idTenant);
        if(!$tenant)
            return redirect()->back();

        $profiles = $tenant->profiles;

        return view('Integrador.Profile.Permissions.index',compact('profile','permissions'));
    }


    public function permissionsAvailable($idProfile)
    {
        $profile = $this->profile->with('permissions')->find($idProfile);
        if(!$profile)
            return redirect()->back();

        $permissions = $profile->permissionsAvailable();

        return view('Integrador.Profile.Permissions.available',compact('profile','permissions'));

    }

    public function attachPermissionsProfile(Request $request,$idProfile)
    {
        $profile = $this->profile->with('permissions')->find($idProfile);
        if(!$profile)
            return redirect()->back();

        if(!$request->permissions || count($request->permissions)==0){
            return redirect()
                ->back()
                ->with('info','Precisa escolhar pelo menos uma permissão !');
        }



        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions',$profile->id);


    }
}

}
