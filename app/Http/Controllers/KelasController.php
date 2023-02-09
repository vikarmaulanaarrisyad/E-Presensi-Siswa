<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahunPelajaranAktif = $this->tahunPelajaranAktif();

        return view('admin.kelas.index', compact('tahunPelajaranAktif'));
    }

    /**
     * Show data json.
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
            ->editColumn('jumlah_siswa', function ($query) {
                return 0;
            })
            ->editColumn('wali_kelas', function ($query) {
                return 'Belum memiliki wali kelas';
            })
            ->addColumn('action', function ($query) {
                return '
                <button onclick="editForm(`' . route('kelas.show', $query->id) . '`)" class="btn btn-link text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                <button onclick="deleteData(`' . route('kelas.destroy', $query->id) . '`, `' . $query->class_name . ' ' . $query->class_rombel . '`)" class="btn btn-link text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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
            'class_name' => 'required|min:3',
            'class_rombel' => 'required|min:1',
            'academic_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data ' . $request->class_name . ' ' . $request->class_rombel . ' gagal tersimpan'], 422);
        }

        $data = [
            'class_name' => $request->class_name,
            'class_rombel' => $request->class_rombel,
            'class_code' => 'class_code_' . rand(99999, 10000),
            'academic_id' => $request->academic_id
        ];

        $kelas = Kelas::create($data);

        $kelas->class_teacher()->attach(1);

        return response()->json(['data' => $kelas, 'message' => 'Data ' . $request->class_name . ' ' .  $request->class_rombel . ' berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::findOrfail($id);

        return response()->json(['data' => $kelas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrfail($id);

        $validator = Validator::make($request->all(), [
            'class_name' => 'required|min:3',
            'class_rombel' => 'required|min:1',
            'academic_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data ' . $request->class_name . ' ' .  $request->class_rombel . ' gagal disimpan.'], 422);
        }

        $data = [
            'class_name' => $request->class_name,
            'class_rombel' => $request->class_rombel,
            'academic_id' => $request->academic_id
        ];

        $kelas->update($data);

        $kelas->class_teacher()->sync(1);

        return response()->json(['data' => $kelas, 'message' => 'Data ' . $request->class_name . ' ' .  $request->class_rombel . ' berhasil disimpan.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrfail($id);

        $kelas->delete();
        $kelas->class_teacher()->detach();


        return response()->json(['message' => 'Data ' . $kelas->class_name . ' ' . $kelas->class_rombel . ' berhasil dihapus.']);
    }

    public function tahunPelajaranAktif()
    {
        return  TahunAjaran::active()->pluck('id')->first();
    }
}
