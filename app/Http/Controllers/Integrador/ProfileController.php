<?php

namespace App\Http\Controllers\Integrador;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = $this->repository->latest()->paginate(8);

       return view('Integrador.Profile.index',compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Integrador.Profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('profiles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = $this->repository->where('id',$id)->first();

        if(!$profile)
            return redirect()->back();

        return view('Integrador.Profile.show',compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = $this->repository->where('id',$id)->first();

        if(!$profile)
            return redirect()->back();

        return view('Integrador.Profile.edit',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = $this->repository->where('id',$id)->first();

        if(!$profile)
            return redirect()->back();

        $profile->update($request->all());

        return redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = $this->repository->where('id',$id)->first();

        if(!$profile)
            return redirect()->back();

        $profile->delete();

        return redirect()->route('profiles.index');
    }
}
