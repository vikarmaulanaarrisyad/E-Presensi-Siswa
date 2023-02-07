<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'students';

    public function academic()
    {
        return $this->belongsTo(TahunAjaran::class, 'academic_id','id');
    }
}
