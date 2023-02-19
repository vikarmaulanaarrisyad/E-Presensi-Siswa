<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'students';

    public function academic()
    {
        return $this->belongsTo(TahunAjaran::class, 'academic_id', 'id');
    }

    public function class_student()
    {
        return $this->belongsToMany(Kelas::class, 'class_student', 'student_id', 'class_id')->withTimestamps();
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where('status', 'aktif');
    }


    public function statusText()
    {
        $text = '';

        switch ($this->status) {
            case 'aktif':
                $text = 'Aktif';
                break;
            case 'tidak aktif':
                $text = 'Tidak Aktif';
                break;
            case 'pindah sekolah':
                $text = 'Pindah Sekolah';
                break;
            case 'keluar':
                $text = 'Drop Out';
                break;
            default:
                break;
        }

        return $text;
    }

    public function statusColor()
    {
        $color = '';

        switch ($this->status) {
            case 'aktif':
                $color = 'success';
                break;
            case 'tidak aktif':
                $color = 'warning';
                break;
            case 'pindah sekolah':
                $color = 'dark';
                break;
            case 'keluar':
                $color = 'danger';
                break;
            default:
                break;
        }

        return $color;
    }
}
