<?php

use App\Models\Recruitment;

function getActiveRecruitment()
{
    return Recruitment::where('status', 'aktif')->first();
}
