<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahunPelajaranAktif = $this->tahunPelajaranAktif();

        return view('admin.siswa.index', compact('tahunPelajaranAktif'));
    }

    public function data(Request $request)
    {
        $query = Siswa::all();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('action', function ($query) {
                return '
                <a href="' . route('kesiswaan.detail', $query->id) . '"  class="btn btn-link text-warning" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye" ></i></a>
                <button onclick="editForm(`' . route('kesiswaan.show', $query->id) . '`)" class="btn btn-link text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                <button onclick="deleteData(`' . route('kesiswaan.destroy', $query->id) . '`, `' . $query->student_name . '`)" class="btn btn-link text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|min:1',
            'student_identification_number' => 'required|min:18',
            'student_identification_school' => 'required|min:10',
            'student_registration_number' => 'required|min:16',
            'student_address' => 'required|min:1',
            'student_phone_number' => 'required|min:1|max:14',
            'gander' => 'required|in:L,P',
            'place_birth' => 'required',
            'date_birth' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'father_work' => 'required',
            'mother_work' => 'required',
            'child_number' => 'required',
            'income' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data ' . $request->student_name . ' ' . $request->student_identification_school . ' gagal tersimpan.'], 422);
        }

        $siswa = Siswa::create($request->all());

        return response()->json(['data' => $siswa, 'message' => 'Data ' . $request->student_name . ' ' . $siswa->student_identification_school . ' berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = $this->getSiswaId($id);

        return response()->json(['data' => $siswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $siswa = $this->getSiswaId($id);

        return view ('admin.siswa.detail', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $siswa = $this->getSiswaId($id);

        $validator = Validator::make($request->all(), [
            'student_name' => 'required|min:1',
            'student_identification_number' => 'required|min:18',
            'student_identification_school' => 'required|min:10',
            'student_registration_number' => 'required|min:16',
            'student_address' => 'required|min:1',
            'student_phone_number' => 'required|min:1|max:14',
            'gander' => 'required|in:L,P',
            'place_birth' => 'required',
            'date_birth' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'father_work' => 'required',
            'mother_work' => 'required',
            'child_number' => 'required',
            'income' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data ' . $siswa->student_name . ' ' . $siswa->student_identification_school . ' gagal tersimpan.'], 422);
        }


        $siswa->update($request->all());


        return response()->json(['data' => $siswa, 'message' => 'Data ' . $siswa->student_name . ' ' . $siswa->student_identification_school . ' berhasil disimpan.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $siswa = $this->getSiswaId($id);

        // if ($siswa->status == 'aktif') {
        //     return response()->json(['message' => 'Data ' . $siswa->student_name . ' ' . $siswa->student_identification_school . ' gagal dihapus.'], 422);
        // }


    }

    public function tahunPelajaranAktif()
    {
        return TahunAjaran::active()->pluck('id')->first();
    }

    public function getSiswaId($id)
    {
        return Siswa::findOrfail($id);
    }
}
