<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
        $this->middleware(['can:Permissões']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->repository->latest()->paginate(8);

        return view('Integrador.Permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Integrador.Permission.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = $this->repository->where('id',$id)->first();

        if(!$permission)
            return redirect()->back();

        return view('Integrador.Permission.show',compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = $this->repository->where('id',$id)->first();

        if(!$permission)
            return redirect()->back();

        return view('Integrador.Permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = $this->repository->where('id',$id)->first();

        if(!$permission)
            return redirect()->back();

        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = $this->repository->where('id',$id)->first();

        if(!$permission)
            return redirect()->back();

        $permission->delete();

        return redirect()->route('permissions.index');
    }
}
