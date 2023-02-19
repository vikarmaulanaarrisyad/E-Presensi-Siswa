<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
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

            $jumlahKelas = Kelas::where('academic_id', $this->getTahunAjaranAktif())->count();
            $jumlahSiswaAktif = Siswa::where('academic_id', $this->getTahunAjaranAktif())
                            ->active()
                            ->count();
            $jumlahSiswaTidakAktif = Siswa::where('academic_id', $this->getTahunAjaranAktif())
                            ->where('status','tidak aktif')
                            ->count();
            $jumlahSiswaPutusSekolah = Siswa::where('academic_id', $this->getTahunAjaranAktif())
                            ->where('status','putus sekolah')
                            ->Orwhere('status','keluar')
                            ->count();

            return view('admin.dashboard.index', compact('jumlahKelas', 'jumlahSiswaAktif', 'jumlahSiswaTidakAktif', 'jumlahSiswaPutusSekolah'));
        } else if ($roleGuru) {
            return view('guru.dashboard.index');
        } else if ($roleSiswa) {
            return view('siswa.dashboard.index');
        } else if ($roleOrtu) {
            return view('ortu.dashboard.index');
        }
    }

    public function getTahunAjaranAktif()
    {
        return TahunAjaran::active()->pluck('id')->first();
    }
}
