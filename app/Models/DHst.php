<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class DHst extends Model
{
    public function insertData($insertData){
        $currentTime = date("Y/m/d H:i:s");
        return
        DB::table('D_HST')->insert([
            'SHIFT_NO' => $insertData['SHIFT_NO'] ?? '',
            'STAGE_NO' => $insertData['STAGE_NO'] ?? '',
            'SHA_ID' => $insertData['SHA_ID'] ?? '',
            'TIDE' => $insertData['TIDE'] ?? '',
            'COND_ID' => $insertData['COND_ID'] ?? '',
            'SHIFT_TIMES' => $insertData['SHIFT_TIMES'] ?? '',
            'WAVE' => $insertData['WAVE'] ?? '',
            'WEAPON_ID' => $insertData['WEAPON_ID'] ?? '',
            'SPECIAL_ID' => $insertData['SPECIAL_ID'] ?? '',
            'CREATE_DT' => $currentTime ?? '',
        ]);
    }
}
