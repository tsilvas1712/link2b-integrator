<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Sale;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $user = auth()->user();
    if ($user->is_admin) {
      $panels = [];
      $panels['tenants'] = Tenant::all()->count();
      $panels['campaigns'] = Campaign::all()->count();
      $panels['users'] = User::all()->count();
      $panels['sales'] = Sale::all()->count();
      return view('Integrador.index', compact('panels'));
    }
    $panels = [];
    $panels['tenants'] = Tenant::where('id', $user->tenant_id)->count();
    $panels['campaigns'] = Campaign::where('tenant_id', $user->tenant_id)->count();
    $panels['users'] = User::where('tenant_id', $user->tenant_id)->count();
    $panels['sales'] = DB::table('sales')
      ->leftJoin('campaigns', 'sales.campaign_id', '=', 'campaigns.id')
      ->leftJoin('tenants', 'campaigns.tenant_id', '=', 'tenants.id')
      ->where('tenants.id', $user->tenant_id)
      ->count();
    $panels['agendadas'] = DB::table('sales')
      ->leftJoin('campaigns', 'sales.campaign_id', '=', 'campaigns.id')
      ->leftJoin('tenants', 'campaigns.tenant_id', '=', 'tenants.id')
      ->where('tenants.id', $user->tenant_id)
      ->where('status', 'AGENDADO')
      ->count();
    $panels['enviadas'] = DB::table('sales')
      ->leftJoin('campaigns', 'sales.campaign_id', '=', 'campaigns.id')
      ->leftJoin('tenants', 'campaigns.tenant_id', '=', 'tenants.id')
      ->where('tenants.id', $user->tenant_id)
      ->where('status', 'ENVIADO')
      ->count();

    $campaigns = Campaign::where('tenant_id', $user->tenant_id)->get();

    return view('Integrador.index2', compact(['panels', 'campaigns']));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //

  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
