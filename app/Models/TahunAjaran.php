<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'academic_years';

    public function semester()
    {
        return $this->belongsTo(Semester::class);
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
                $color = 'danger';
                break;
            default:
                break;
        }

        return $color;
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
}
