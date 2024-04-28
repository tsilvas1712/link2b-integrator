<?php

use App\Http\Controllers\API\DataSyncController;
use App\Models\Campaign;
  use App\Models\Datasys;
  use App\Models\Sale;
  use App\Repository\DatasysRepository;
  use App\Repository\SaleRepository;
  use App\Services\DatasysService;
  use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

  Route::get('/datasync',function (){
    $campaigns = Campaign::where('active', true)->get();
    $datasys = new Datasys();
    $sale = new Sale();
    $repositorySale = new SaleRepository($sale);
    $repositoryDatasys = new DatasysRepository($datasys);
    $dataService = new DatasysService($repositorySale, $repositoryDatasys);


    foreach ($campaigns as $campaign) {
      $datasysToken = $campaign->token_customer;
      $datasysUrl = $campaign->endpoint_customer;
      $tenant_id = $campaign->tenant_id;

      $dataService->syncDatasys($datasysUrl, $datasysToken, $tenant_id);
      $dataService->sendDatasys($tenant_id, $campaign->id, $campaign->sales_modalities);
      $datasys->truncate();
    }

    return 'ok';

  });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/receivedata',[DataSyncController::class,'receiveData'])
->middleware('auth:sanctum')
->name('api.receivedata');
