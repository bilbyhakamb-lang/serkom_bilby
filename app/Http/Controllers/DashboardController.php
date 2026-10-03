<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Berita;
use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin.
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'jumlahSiswa' => Siswa::count(),
            'jumlahGuru' => Guru::count(),
            'beritaTerbaru' => Berita::orderByDesc('id_berita')
                ->take(3)
                ->get(),
        ];

        return view('dashboard.dashboard', $data);
    }

    /**
     * Menampilkan dashboard publik.
     */
    public function indexPublic()
    {
        return $this->index();
    }

    public function create()
    {
        //
    }

    public function store(StoreDashboardRequest $request)
    {
        //
    }

    public function show(Dashboard $dashboard)
    {
        //
    }

    public function edit(Dashboard $dashboard)
    {
        //
    }

    public function update(
        UpdateDashboardRequest $request,
        Dashboard $dashboard
    ) {
        //
    }

    public function destroy(Dashboard $dashboard)
    {
        //
    }
}