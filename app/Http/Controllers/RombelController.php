<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahunPelajaranAktif = $this->tahunPelajaranAktif();

        return view('admin.rombel.index', compact('tahunPelajaranAktif'));
    }

    /**
     * Show the json resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $tahunPelajaranAktif = $this->tahunPelajaranAktif();


        $query = Kelas::orderBy('class_name', 'ASC')
            ->where('academic_id', $tahunPelajaranAktif);

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('wali_kelas', function ($query) {
                return '-';
            })
            ->editColumn('jumlah_siswa', function ($query) {
                return $query->class_student->count() . '/'. $query->capacity . ' Siswa';
            })
            ->editColumn('kelebihan_siswa', function ($query) {
                return '-';
            })
            ->addColumn('action', function ($query) {
                return '
                    <a href="' . route('rombel.detail', $query->id) . '"  class="btn btn-link text-warning" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye"></i></a>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function siswaStore(Request $request, $id)
    {
        $kelas = Kelas::findOrfail($id);

        foreach ($request->siswa_id as $key => $siswa) {
            $siswas = Siswa::find($siswa);
            $siswas->update([
                'academic_id' => $this->tahunPelajaranAktif()
            ]);
            $kelas->class_student()->attach($siswas);
        }

        return response()->json(['data' => $kelas, 'message' => 'Data siswa berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $kelas = Kelas::findOrfail($id);

        $kelasSiswa = Siswa::whereHas('class_student', function (Builder $query) use ($id) {
            $query->where('class_id', $id);
        })->get();


        return view('admin.rombel.detail', compact('kelas', 'kelasSiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //


    }

    public function tahunPelajaranAktif()
    {
        return  TahunAjaran::active()->pluck('id')->first();
    }

    public function getAllSiswa()
    {

        $tahunPelajaranAktif = $this->tahunPelajaranAktif();


        $query = Siswa::whereHas('academic', function ($query) use ($tahunPelajaranAktif) {
            $query->where('academic_id',  $tahunPelajaranAktif);
        })
            ->whereDoesntHave('class_student')
            ->get();


        // $query = Siswa::with('class_student')
        //     ->active()
        //     ->whereDoesntHave('class_student')
        //     ->get();


        return datatables($query)
            ->addIndexColumn()
            ->editColumn('siswa_id', function ($query) {
                return '<input type="checkbox" name="siswa_id[]" id="siswa" value="' . $query->id . '`">';
            })
            ->editColumn('nama_siswa', function ($query) {
                return $query->student_name;
            })
            ->editColumn('nisn_siswa', function ($query) {
                return $query->student_identification_school;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function siswaDestroy($id)
    {
        $siswa = Siswa::findOrfail($id);

        $siswa->class_student()->detach();

        return response()->json(['data' => $siswa, 'message' => 'Data siswa berhasil dikeluarkan']);
    }
}
