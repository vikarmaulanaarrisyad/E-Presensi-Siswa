<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunPelajaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'academic_name' => 'Tahun Pelajaran 2018/2019',
                'academic_start' => '2023-02-01',
                'academic_end' => '2023-02-01',
                'status' => 'tidak aktif',
                'semester_id' => 1,
            ],
            [
                'id' => 2,
                'academic_name' => 'Tahun Pelajaran 2018/2019',
                'academic_start' => '2023-02-01',
                'academic_end' => '2023-02-01',
                'status' => 'tidak aktif',
                'semester_id' => 2,
            ],
            [
                'id' => 3,
                'academic_name' => 'Tahun Pelajaran 2019/2020',
                'academic_start' => '2023-02-01',
                'academic_end' => '2023-02-01',
                'status' => 'tidak aktif',
                'semester_id' => 1,
            ],
            [
                'id' => 4,
                'academic_name' => 'Tahun Pelajaran 2019/2020',
                'academic_start' => '2023-02-01',
                'academic_end' => '2023-02-01',
                'status' => 'tidak aktif',
                'semester_id' => 2,
            ],
            [
                'id' => 5,
                'academic_name' => 'Tahun Pelajaran 2020/2021',
                'academic_start' => '2023-02-01',
                'academic_end' => '2023-02-01',
                'status' => 'tidak aktif',
                'semester_id' => 1,
            ],
            [
                'id' => 6,
                'academic_name' => 'Tahun Pelajaran 2020/2021',
                'academic_start' => '2023-02-01',
                'academic_end' => '2023-02-01',
                'status' => 'aktif',
                'semester_id' => 2,
            ],
        ];

        foreach ($data as $value) {
            TahunAjaran::create($value);
        }
    }
}
