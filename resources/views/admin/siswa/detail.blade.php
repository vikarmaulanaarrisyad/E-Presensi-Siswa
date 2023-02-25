@extends('layouts.app')

@section('title', 'Data Siswa')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('kesiswaan.index') }}">Data Siswa</a></li>
    <li class="breadcrumb-item active">Detail Siswa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{ asset('AdminLTE/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $siswa->student_name }}</h3>
                    <p class="text-muted text-center">{{ $siswa->class_student->first()->class_name ?? '' }} {{ $siswa->class_student->first()->class_rombel ?? '' }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>NISN</b> <a class="float-right">{{ $siswa->student_identification_school }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>NIS</b> <a class="float-right">{{ $siswa->student_identification_number }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>NIK</b> <a class="float-right">{{ $siswa->student_registration_number }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tahun Masuk</b> <a class="float-right">{{ $siswa->academic->academic_name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detail Siswa</h3>
                </div>

                <div class="card-body">
                    <input type="hidden" name="" id="tgl" value="{{ $siswa->date_birth }}">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Jenis Kelamin</b> <a class="float-right">{{ $siswa->gander }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tempat, Tanggal Lahir</b> <a class="float-right" id="ttl"> {{ $siswa->place_birth }}
                                , {{ tanggal_indonesia($siswa->date_birth) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Anak Ke</b> <a class="float-right">{{ $siswa->child_number }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Usia</b> <a class="float-right" id="usia"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Alamat</b> <a class="float-right">{{ $siswa->student_address }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detail Orang Tua</h3>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Nama Ayah</b> <a class="float-right">{{ $siswa->father_name }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Pekerjaan Ayah</b> <a class="float-right">{{ $siswa->father_work }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Nama Ibu</b> <a class="float-right">{{ $siswa->mother_name }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Pekerjaan Ibu</b> <a class="float-right">{{ $siswa->mother_work }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Penghasilan</b> <a class="float-right" id="income">{{ $siswa->income }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            let uang = $('#income').text()
            let tanggalLahir = new Date($('#tgl').val());
            let today = new Date();
            let umur = today.getFullYear() - tanggalLahir.getFullYear();
            if (today.getMonth() < tanggalLahir.getMonth() ||
                (today.getMonth() === tanggalLahir.getMonth() && today.getDate() < tanggalLahir.getDate())) {
                umur--;
            }

            $('#usia').text(umur);
            $('#income').text(format_uang(uang));
        });
    </script>
@endpush
