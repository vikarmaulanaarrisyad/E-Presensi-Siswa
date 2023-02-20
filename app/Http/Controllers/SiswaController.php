<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

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
        $kelas = Kelas::where('academic_id', $tahunPelajaranAktif)->get();
        $jumlahSiswaTidakAktif = Siswa::where('status', 'tidak aktif')->count();
        $jumlahSiswaPindahSekolah = Siswa::where('status', 'pindah sekolah')->count();
        $jumlahSiswaKeluar = Siswa::where('status', 'keluar')->count();
        $jumlahSiswaAktif = Siswa::active()->where('academic_id', $tahunPelajaranAktif)->count();

        return view('admin.siswa.index', compact('tahunPelajaranAktif', 'kelas', 'jumlahSiswaTidakAktif', 'jumlahSiswaAktif', 'jumlahSiswaKeluar', 'jumlahSiswaPindahSekolah'));
    }

    public function data(Request $request)
    {
        // $query = Siswa::with('class_student')->active()->get();

        $tahunPelajaranAktif = $this->tahunPelajaranAktif();

        $query = Siswa::with('class_student')
            // ->active()
            ->whereHas('class_student', function ($query) {
                $query->where('class_id', '!=', 0);
            })
            ->where('academic_id', $tahunPelajaranAktif)
            ->when($request->has('status') && $request->status != "", function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->get();


        return datatables($query)
            ->addIndexColumn()
            ->editColumn('date_birth', function ($query) {
                return $query->place_birth . ', ' . tanggal_indonesia($query->date_birth);
            })
            ->editColumn('kelas', function ($query) {
                return $query->class_student->first()->class_name . ' ' . $query->class_student->first()->class_rombel;
            })
            ->editColumn('umur', function ($query) {
                return  Carbon::parse($query->date_birth)->age;
            })
            ->editColumn('status', function ($query) {
                return '<span class="badge badge-' . $query->statusColor() . '">' . $query->statusText() . '</span>';
            })
            ->editColumn('action', function ($query) {
                $aksi = '';

                if ($query->status == 'aktif') {
                    $aksi = '
                      <a href="' . route('kesiswaan.detail', $query->id) . '"  class="btn btn-link text-warning" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye" ></i></a>
                     <button onclick="editForm(`' . route('kesiswaan.show', $query->id) . '`)" class="btn btn-link text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                ';
                } else {
                    $aksi .= '
                      <a href="' . route('kesiswaan.detail', $query->id) . '"  class="btn btn-link text-warning" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye" ></i></a>
                     <button onclick="editForm(`' . route('kesiswaan.show', $query->id) . '`)" class="btn btn-link text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                      <button onclick="deleteData(`' . route('kesiswaan.destroy', $query->id) . '`, `' . $query->student_name . '`)" class="btn btn-link text-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                ';
                }

                return $aksi;
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

        return view('admin.siswa.detail', compact('siswa'));
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
        $siswa = $this->getSiswaId($id);

        if ($siswa->status == 'aktif') {
            return response()->json(['message' => 'Data ' . $siswa->student_name . ' ' . $siswa->student_identification_school . ' gagal dihapus.'], 422);
        }

        $siswa->delete();
        return response()->json(['message' => 'Data ' . $siswa->student_name . ' ' . $siswa->student_identification_school . ' berhasil dihapus.'], 422);
    }


    public function importSiswaExcel(Request $request)
    {
        // validasi
        $validator = Validator::make($request->all(), [
            'import_siswa' => 'required|mimes:csv,xls,xlsx',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Gagal mengupload file'], 422);
        }

        // menangkap file exvel
        $file = $request->file('import_siswa');

        // membuat nama file
        $fileName = auth()->user()->name . '_' . $file->getClientOriginalName();

        // upload ke folder public
        $file->move('file_siswa', $fileName);


        Excel::import(new SiswaImport, public_path('/file_siswa/' . $fileName));


        return redirect()->back();
    }

    public function tahunPelajaranAktif()
    {
        return TahunAjaran::active()->pluck('id')->first();
    }

    public function getSiswaId($id)
    {
        return Siswa::findOrfail($id);
    }

    public function exportPDF(Request $request, $id)
    {
        $tahunPelajaranAktif = $this->tahunPelajaranAktif();

        $kelas = Kelas::findOrfail($id);

        $data = Siswa::with('class_student')
            ->whereHas('class_student', function ($query) use ($kelas) {
                $query->where('class_id', $kelas->id);
            })
            ->where('academic_id', $tahunPelajaranAktif)
            ->get();

        $pdf = PDF::loadView('admin.siswa.pdf', compact('data', 'kelas', 'tahunPelajaranAktif'))
            ->setPaper('letter', 'landscape');

        return $pdf->stream('Laporan-data-siswa-' . $kelas->class_name . ' ' . $kelas->class_rombel . '.pdf');
    }
}
