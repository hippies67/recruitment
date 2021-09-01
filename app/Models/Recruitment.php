<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap', 'kelas', 'prodi', 'semester', 'divisi', 'pengetahuan_divisi', 'pengalaman_divisi', 'pengalaman_organisasi', 'kesanggupan_menjadi_pengurus'
    ];
}
