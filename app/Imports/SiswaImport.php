<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SiswaImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{

    public function getTahunPelajaranAktif()
    {
        return TahunAjaran::active()->pluck('id')->first();
    }

    public function collection(Collection $rows)
    {


        foreach ($rows as $row) {
            // $tanggal_lahir = ($row['tanggal_lahir'] - 25569) * 86400;
            if (!isset($row['nama'])) {
                return null;
            }

            Siswa::updateOrCreate(
                [
                    'student_identification_school' => $row['nisn'],
                ],
                [
                    'student_name' => $row['nama'],
                    'student_identification_number' => $row['nis'],
                    'student_registration_number' => $row['nik'],
                    'place_birth' => $row['tempat_lahir'],
                    'date_birth' => date('Y-m-d', $row['tanggal_lahir']),
                    'gander' => $row['jenis_kelamin'],
                    'child_number' => $row['anak_ke'],
                    'student_address' => $row['alamat'],
                    'student_phone_number' => $row['nomor_hp'],
                    'father_name' => $row['nama_ayah'],
                    'mother_name' => $row['nama_ibu'],
                    'father_work' => $row['pekerjaan_ayah'],
                    'mother_work' => $row['pekerjaan_ibu'],
                    'income' => $row['penghasilan_ortu'],
                    'academic_id' => $this->getTahunPelajaranAktif(),

                ]
            );
        }
    }

    public function chunkSize(): int
    {
        return 5000;
    }

    public function batchSize(): int
    {
        return 5000;
    }
}
