<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentUser extends Model
{
    protected $table = "recruitment_users";
    protected $fillable = [
        'recruitment', 'nama_lengkap', 'nim', 'kelas', 'program_studi', 'semester', 'email', 'divisi', 'spesialisasi_divisi', 'pengetahuan_divisi', 'pengalaman_divisi', 'pengalaman_organisasi', 'minat_menjadi_pengurus', 'status', 'email_sent'
    ];

    public function classes()
    {
        return $this->belongsTo(StudentClass::class, 'kelas');
    }

    public function study_programs()
    {
        return $this->belongsTo(StudyProgram::class, 'program_studi');
    }

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'divisi');
    }

    public function recruitments()
    {
        return $this->belongsTo(Recruitment::class, 'recruitment');
    }
}
