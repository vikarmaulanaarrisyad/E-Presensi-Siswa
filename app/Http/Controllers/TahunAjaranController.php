<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semesters = Semester::all();

        return view('admin.tahunpelajaran.index', compact('semesters'));
    }

    public function data(Request $request)
    {
        $query = TahunAjaran::orderBy('id', 'DESC');

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('semester', function ($query) {
                return $query->semester->semester_name;
            })
            ->editColumn('status', function ($query) {
                return '<span class="badge badge-' . $query->statusColor() . '">' . $query->statusText() . '</span>';
            })
            ->addColumn('action', function ($query) {
                return '
                <button onclick="updateStatus(`' . route('tahun-ajaran.updateStatus', $query->id) . '`, `' . $query->academic_name . ' ' . $query->semester->semester_name . '`)" class="btn btn-link text-warning" data-toggle="tooltip" data-placement="top" title="ubah status"><i class="fas fa-paint-brush" ></i></button>
                <button onclick="editForm(`' . route('tahun-ajaran.show', $query->id) . '`)" class="btn btn-link text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                <button onclick="deleteData(`' . route('tahun-ajaran.destroy', $query->id) . '`, `' . $query->academic_name . ' ' . $query->semester->semester_name . '`)" class="btn btn-link text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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
        //validasi request form
        $validator = Validator::make($request->all(), [
            'academic_name' => 'required|min:3',
            'academic_start' => 'required|date_format:Y-m-d',
            'academic_end' => 'required|date_format:Y-m-d',
            'semester_id' => 'required',
            'status' => 'nullable',
        ], [
            'academic_name.required' => 'Tahun pelajaran wajib diisi.',
            'academic_start.required' => 'Tanggal mulai tahun pelajaran wajib diisi.',
            'academic_end.required' => 'Tanggal akhir tahun pelajaran wajib diisi.',
            'semester_id.required' => 'Semester wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data ' . $request->academic_name . ' ' . $request->semester->semester_name . ' gagal tersimpan.'], 422);
        }

        $data = [
            'academic_name' => $request->academic_name,
            'academic_start' => $request->academic_start,
            'academic_end' => $request->academic_end,
            'semester_id' => $request->semester_id,
            'status' => 'tidak aktif',
        ];

        $tahunAjaran = TahunAjaran::create($data);

        return response()->json(['data' => $tahunAjaran, 'message' => 'Data ' . $request->academic_name . ' ' . $tahunAjaran->semester->semester_name . ' berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TahunAjaran $tahunAjaran)
    {
        return response()->json(['data' => $tahunAjaran]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        //validasi request form
        $validator = Validator::make($request->all(), [
            'academic_name' => 'required|min:3',
            'academic_start' => 'required|date_format:Y-m-d',
            'academic_end' => 'required|date_format:Y-m-d',
            'semester_id' => 'required',
            'status' => 'nullable',
        ], [
            'academic_name.required' => 'Tahun pelajaran wajib diisi.',
            'academic_start.required' => 'Tanggal mulai tahun pelajaran wajib diisi.',
            'academic_end.required' => 'Tanggal akhir tahun pelajaran wajib diisi.',
            'semester_id.required' => 'Semester wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Data ' . $request->academic_name . ' ' . $request->semester->semester_name . ' gagal tersimpan.'], 422);
        }

        $data = [
            'academic_name' => $request->academic_name,
            'academic_start' => $request->academic_start,
            'academic_end' => $request->academic_end,
            'semester_id' => $request->semester_id,
        ];

        $tahunAjaran->update($data);

        return response()->json(['data' => $tahunAjaran, 'message' => 'Data ' . $request->academic_name . ' ' . $tahunAjaran->semester->semester_name . ' berhasil disimpan.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(TahunAjaran $tahunAjaran)
    {
        if ($tahunAjaran->status == 'aktif') {
            return response()->json(['message' => 'Data ' . $tahunAjaran->academic_name . ' ' . $tahunAjaran->semester->semester_name . ' sedang aktif.'], 422);
        }

        $tahunAjaran->delete();
        return response()->json(['message' => 'Data ' . $tahunAjaran->academic_name . ' ' . $tahunAjaran->semester->semester_name . ' berhasil dihapus.']);
    }

    public function updateStatus($id)
    {
        $tahunAjaran = Tahunajaran::all();

        $tahunPelajaran = Tahunajaran::find($id);

        if ($tahunPelajaran->status != 'tidak aktif') {
            return response()->json(['message' => 'Data ' . $tahunPelajaran->academic_name . ' ' . $tahunPelajaran->semester->semester_name . ' sudah aktif.'], 401);
        }

        foreach ($tahunAjaran as $item) {
            $item->update(['status' => 'tidak aktif']);
        }

        $tahunPelajaran->update(['status' => 'aktif']);

        return response()->json(['message' => 'Data ' . $tahunPelajaran->academic_name . ' ' . $tahunPelajaran->semester->semester_name . '  aktif.']);
    }
}
