<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MstNumbering extends Model
{
    //use HasFactory;

    public function selectData()
    {
        return DB::table('MST_NUMBERING')
        ->first();
    }

    public function updateData($shiftNo)
    {
        $currentTime = date("Y/m/d H:i:s");
        return DB::table('MST_NUMBERING')
        ->update(['CURRENT_SHIFT_NO' => $shiftNo, 'CURRENT_SHIFT_TIMES' => 1, 'CURRENT_RATE' => 400, 'UPDATE_DT' => $currentTime]);
    }

    public function updateTimes($shiftTimes, $rate, $total)
    {
        $currentTime = date("Y/m/d H:i:s");
        return DB::table('MST_NUMBERING')
        ->update(['CURRENT_SHIFT_TIMES' => $shiftTimes, 'CURRENT_RATE' => $rate, 'TOTAL_COUNT' => $total, 'UPDATE_DT' => $currentTime]);
    }
}
