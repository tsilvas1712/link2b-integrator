<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $repository;
    public function __construct(Customer $customer)
    {
        $this->repository = $customer;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->repository->latest()->paginate();

        return view('Integrador.Customer.index',[
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Integrador.Customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = $this->repository->where('id',$id)->first();

        if(!$customer)
            return redirect()->back();

        return view('Integrador.Customer.show',[
            'customer' => $customer
        ]);
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
        $customer = $this->repository->where('id',$id)->first();

        if(!$customer)
            return redirect()->back();

        $customer->delete();

        return redirect()->route('clientes.index');
    }
}
