<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializationDivision extends Model
{
    use HasFactory;

    protected $table = "specialization_divisions";
    protected $fillable = [
        'division','nama', 'deskripsi'
    ];

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division');
    }
}
