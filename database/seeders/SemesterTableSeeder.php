<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterTableSeeder extends Seeder
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
                'semester_name' => 'Ganjil'
            ],
            [
                'id' => 2,
                'semester_name' => 'Genap'
            ]
        ];

        foreach ($data as  $value) {
            Semester::create($value);
        }
    }
}
