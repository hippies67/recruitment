<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama'
    ];

    public function recruitmentUsers()
    {
        return $this->hasMany(RecruitmentUser::class, 'semester');
    }
}
