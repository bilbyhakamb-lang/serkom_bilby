<?php

namespace App\Http\Controllers;

use App\Models\ProfileSekolah;
use App\Http\Requests\StoreProfileSekolahRequest;
use App\Http\Requests\UpdateProfileSekolahRequest;

class ProfileSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Profile Sekolah'
        ];
        return view('profile.profile',$data);
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
    public function store(StoreProfileSekolahRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileSekolah $profileSekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfileSekolah $profileSekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileSekolahRequest $request, ProfileSekolah $profileSekolah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileSekolah $profileSekolah)
    {
        //
    }
}
