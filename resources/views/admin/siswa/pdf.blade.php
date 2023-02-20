<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Siswa</title>

    <link rel="stylesheet" href="{{ public_path('/AdminLTE/dist/css/adminlte.min.css') }}">

    <style>
        .text-uppercase {
            text-transform: uppercase;
        }

        .border-2 {
            border: 2px solid black;
        }
    </style>
</head>

<body>

    <h6 class="text-center text-bold text-uppercase">Daftar Siswa {{ $kelas->class_name }} {{ $kelas->class_rombel }}
    </h6>
    <h6 class="text-center text-bold">SMP AL-IRSYAD TEGAL</h6>
    <h6 class="text-center text-bold text-uppercase">{{ $kelas->academic->academic_name }}</h6>
    <br>
    <h6 class="text-left">Wali Kelas : Vikar</h6>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th style="width: 5%">No</th>
                <th style="width: 5%">NISN</th>
                <th>Nama Siswa</th>
                <th style="width:2%">L/P</th>
                <th style="width: 5%">Tempat</th>
                <th style="width: 13%">Tanggal Lahir</th>
                <th style="width:10%">Nama OrangTua</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $siswa)
                @php
                    $nis = substr($siswa->student_identification_number, 14);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $siswa->student_identification_school }}</td>
                    <td>{{ $siswa->student_name }}</td>
                    <td>{{ $siswa->gander }}</td>
                    <td>{{ $siswa->place_birth }}</td>
                    <td>{{ $siswa->date_birth }}</td>
                    <td>{{ $siswa->father_name }} - {{ $siswa->mother_name }}</td>
                    <td>{{ $siswa->student_address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <p>Mengetahui,</p>
    <p class="pt-0">Kepala Sekolah</p>
    <br>
    <br>
    <p>Vikar Maulana</p>
</body>

</html>
