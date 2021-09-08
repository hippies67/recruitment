<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    protected $table = "study_programs";

    protected $fillable = [
        'nama'
    ];

    public function recruitmentUsers()
    {
        return $this->hasMany(RecruitmentUser::class, 'program_studi');
    }
}
