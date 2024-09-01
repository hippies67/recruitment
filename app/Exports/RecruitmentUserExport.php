<?php

namespace App\Exports;

use App\Models\RecruitmentUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecruitmentUserExport implements WithHeadings, FromQuery
{
    public function query()
    {
        return RecruitmentUser::query()
            ->join('recruitments', 'recruitment_users.recruitment', '=', 'recruitments.id')
            ->join('classes', 'recruitment_users.kelas', '=', 'classes.id')
            ->join('study_programs', 'recruitment_users.program_studi', '=', 'study_programs.id')
            ->join('semesters', 'recruitment_users.semester', '=', 'semesters.id')
            ->join('divisions', 'recruitment_users.divisi', '=', 'divisions.id')
            ->join('specialization_divisions', 'recruitment_users.spesialisasi_divisi', '=', 'specialization_divisions.id')
            ->select('recruitment_users.id',
                'recruitments.tahun',
'recruitment_users.nama_lengkap',
'recruitment_users.nim',
'recruitment_users.alamat',
'classes.nama AS kelas',
'study_programs.nama AS program_studi',
'semesters.nama AS semester',
'recruitment_users.email',
'divisions.nama AS divisi',
'specialization_divisions.nama AS spesialisasi_divisi',
'recruitment_users.pengetahuan_divisi',
'recruitment_users.pengalaman_divisi',
'recruitment_users.pengalaman_organisasi',
'recruitment_users.minat_menjadi_pengurus',
'recruitment_users.status',
'recruitment_users.email_sent',
'recruitment_users.stage',
'recruitment_users.created_at');
    }

    public function headings(): array{
        return ['id', 'recruitment','nama_lengkap','nim','alamat','kelas',
            'program_studi','semester','email','divisi',
            'spesialisasi_divisi','pengetahuan_divisi',
            'pengalaman_divisi','pengalaman_organisasi','minat_menjadi_pengurus',
            'status','email_sent','stage','created_at'];
    }
}
