<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MstCondition extends Model
{
    //use HasFactory;
    public function selectData()
    {
        return DB::table('MST_CONDITION')
        ->get();
    }
}
