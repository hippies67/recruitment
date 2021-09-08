<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $table = "classes";
    protected $fillable = [
        'nama'
    ];

    public function recruitmentUsers()
    {
        return $this->hasMany(RecruitmentUser::class, 'kelas');
    }
}
