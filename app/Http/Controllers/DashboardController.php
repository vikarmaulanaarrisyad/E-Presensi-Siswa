<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        //cek role user yang login
        $roleAdmin = auth()->user()->hasRole('admin');
        $roleGuru = auth()->user()->hasRole('guru');
        $roleSiswa = auth()->user()->hasRole('siswa');
        $roleOrtu = auth()->user()->hasRole('ortu');

        if ($roleAdmin) {
            return view('admin.dashboard.index');
        } else if ($roleGuru) {
            return view('guru.dashboard.index');
        } else if ($roleSiswa) {
            return view('siswa.dashboard.index');
        } else if ($roleOrtu) {
            return view('ortu.dashboard.index');
        }
    }
}
