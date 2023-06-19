<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    protected $repository;

    public function __construct(Sale $sale)
    {
        $this->repository = $sale;
        $this->middleware(['can:Mensagens']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user();

        if($user->is_admin){
            $sales = $this->repository->latest()->paginate(10);

            return view('Integrador.Sales.index', compact('sales'));
        }
        $sales = DB::table('sales')
            ->leftJoin('campaigns','sales.campaign_id','=','campaigns.id')
            ->leftJoin('tenants','campaigns.tenant_id','=','tenants.id')
            ->where('tenants.id',$user->tenant_id)
            ->orderBy('sales.createD_at','DESC')
            ->paginate(10);

        return view('Integrador.Sales.index', compact('sales'));
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
