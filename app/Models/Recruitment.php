<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun', 'selayang_pandang', 'banner', 'status'
    ];

    public function recruitmentUsers()
    {
        return $this->hasMany(RecruitmentUser::class, 'recruitment');
    }
    
  
}
