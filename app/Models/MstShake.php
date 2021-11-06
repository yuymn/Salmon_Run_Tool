<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MstShake extends Model
{
    //use HasFactory;
    public function selectData()
    {
        return DB::table('MST_SHAKE')
        ->orderBy('ORDER_DISP')
        ->get();
    }
}
