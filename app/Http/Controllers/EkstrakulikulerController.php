<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use App\Http\Requests\StoreEkstrakulikulerRequest;
use App\Http\Requests\UpdateEkstrakulikulerRequest;

class EkstrakulikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('eskul.eskul');
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
    public function store(StoreEkstrakulikulerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ekstrakulikuler $ekstrakulikuler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ekstrakulikuler $ekstrakulikuler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEkstrakulikulerRequest $request, Ekstrakulikuler $ekstrakulikuler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ekstrakulikuler $ekstrakulikuler)
    {
        //
    }
}
