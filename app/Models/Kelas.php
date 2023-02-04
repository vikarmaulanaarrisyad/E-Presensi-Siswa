<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'classes';

    public function academic()
    {
        return $this->belongsTo(TahunAjaran::class, 'academic_id', 'id');
    }

    public function class_teacher()
    {
        return $this->belongsToMany(Guru::class, 'class_teacher', 'class_id', 'teacher_id')->withTimestamps();
    }

    public function class_student()
    {
        return $this->belongsToMany(Siswa::class, 'class_student', 'student_id', 'class_id')->withTimestamps();
    }
}
