<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'deskripsi'
    ];

    public function specialization_divisions()
    {
        return $this->hasMany(SpecializationDivision::class, 'division');
    }

    public function recruitmentUsers()
    {
        return $this->hasMany(RecruitmentUser::class, 'divisi');
    }
}
