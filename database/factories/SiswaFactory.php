<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */


class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Siswa::class;

    public function definition()
    {
        return [
            'student_name' => $this->faker->name(),
            'student_identification_number' => rand(1, 18),
            'student_identification_school' => rand(1, 10),
            'student_registration_number' => rand(1, 16),
            'student_address' => $this->faker->address(),
            'student_phone_number' => $this->faker->phoneNumber(),
            'gander' => 'L',
            'place_birth' => 'TEGAL',
            'date_birth' => '2000-02-01',
            'father_name' => 'Ayah',
            'mother_name' => 'Ibu',
            'father_work' => 'tidak bekerja',
            'mother_work'   => 'tidak bekerja',
            'child_number' => rand(1, 5),
            'income' => 4,
            'status' => 'aktif',
            'academic_id' => 7

        ];
    }
}
