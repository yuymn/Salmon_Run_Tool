<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ResultHst extends Model
{
    public function insertData($insertData){
        $currentTime = date("Y/m/d H:i:s");
        return
        DB::table('RESULT_HST')->insert([
            'SHIFT_NO' => $insertData['SHIFT_NO'] ?? '',
            'STAGE_NO' => $insertData['STAGE_NO'] ?? '',
            'RESULT' => $insertData['RESULT'] ?? '',
            'SHIFT_TIMES' => $insertData['SHIFT_TIMES'] ?? '',
            'CLEAR_WAVE_COUNT' => $insertData['CLEAR_WAVE_COUNT'] ?? '',
            'PLAY_WAVE_COUNT' => $insertData['PLAY_WAVE_COUNT'] ?? '',
            'SPECIAL_ID' => $insertData['SPECIAL_ID'] ?? '',
            'SPECIAL_REMAIN' => $insertData['SPECIAL_REMAIN'] ?? null,
            'FRIEND_FLG' => $insertData['FRIEND_FLG'] ?? null,
            'TIDE' => $insertData['TIDE'] ??  null,
            'COND_ID' => $insertData['COND_ID'] ?? '',
            'RATE' => $insertData['RATE'] ?? null,
            'WEAPON_ID' => $insertData['WEAPON_ID'] ?? '',
            'CREATE_DT' => $currentTime ?? '',
        ]);
    }
}
