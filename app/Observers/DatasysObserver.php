<?php

namespace App\Observers;

use App\Models\Datasys;
use Illuminate\Support\Facades\Auth;

class DatasysObserver
{
    //
    public function creating(Datasys $datasys): void
    {
      $datasys->tenant_id = Auth::user()->tenant_id;
    }

    public function inserting(Datasys $datasys): void
    {
      $datasys->tenant_id = Auth::user()->tenant_id;
    }
}
