<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentUser extends Model
{
    protected $table = "recruitment_users";
    protected $fillable = [
        'recruitment', 'nama_lengkap', 'kelas', 'program_studi', 'semester', 'email', 'divisi', 'pengetahuan_divisi', 'pengalaman_divisi', 'pengalaman_organisasi', 'minat_menjadi_pengurus', 'status'
    ];
}
