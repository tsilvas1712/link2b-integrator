<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Requests\ReceiveDataRequest;
use App\Models\Datasys;
use App\Models\Tenant;
use Illuminate\Http\Request;

class DataSyncController extends Controller
{

  //
  public function receiveData(ReceiveDataRequest $request)
  {
    $data = $request->validated();

    foreach ($data as $row) {
      Datasys::create($row);
    }

    //Datasys::insert($data);

    return response()->json(count($data) . ' Registros Criados');
  }
}
