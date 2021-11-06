<?php

namespace App\Http\Controllers;

use App\Models\DHst;
use App\Models\MstNumbering;
use App\Models\ResultHst;
use Illuminate\Http\Request;

class SendController extends Controller
{
    public function SendDeath(Request $request)
    {
        setcookie('wave',$request->wave);
        setcookie('tide',$request->tide);
        setcookie('shake',$request->cond);
        setcookie('weapon',$request->weapon);
        setcookie('cond',$request->cond);

        $insertData['SHIFT_NO'] = intval($request->shiftNo);
        $insertData['STAGE_NO'] = intval($request->stageNo);
        $insertData['SHIFT_TIMES'] = intval($request->shiftTimes);
        $insertData['WAVE'] = intval($request->wave);
        $insertData['TIDE'] = intval($request->tide);
        $insertData['COND_ID'] = $request->cond;
        $insertData['SHA_ID'] = $request->shake;
        $insertData['WEAPON_ID'] = $request->weapon;
        $dHst = new DHst();
        $dHst->insertData($insertData);

        return redirect('/');

    }

    public function SendResult(Request $request)
    {
        setcookie('wave', '', time()-60);
        setcookie('tide', '', time()-60);
        setcookie('shake', '', time()-60);
        setcookie('weapon', '', time()-60);
        setcookie('cond', '', time()-60);

        $insertData['SHIFT_NO'] = intval($request->shiftNo);
        $insertData['STAGE_NO'] = intval($request->stageNo);
        $insertData['RESULT'] = intval($request->result);
        $insertData['SHIFT_TIMES'] = intval($request->shiftTimes);
        $insertData['SPECIAL_REMAIN'] = intval($request->sp_remain);

        if ($request->result !== '0'){
            $insertData['CLEAR_WAVE_COUNT'] = intval($request->wave)-1;
            $insertData['PLAY_WAVE_COUNT'] = intval($request->wave);
            $insertData['TIDE'] = intval($request->tide);
            $insertData['COND_ID'] = $request->cond;
            $insertData['WEAPON_ID'] = $request->weapon;
        } else {
            $insertData['CLEAR_WAVE_COUNT'] = 3;
            $insertData['PLAY_WAVE_COUNT'] = 3;
        }

        

        //ここからrate計算
        $halfFlg = $request->half_flg;
        $rate = intval($request->rate);

        if (isset($halfFlg)){
            //半減ありの場合
            if ($request->result !== '0'){
                //失敗
                if ($request->wave === '1'){
                    //wave1失敗
                    $rate = $rate -10;
                } elseif ($request->wave === '2'){
                    //wave2失敗
                    $rate = $rate -5;
                }
                //wave3失敗時はそのまま
            }else{
                //クリア
                $rate = $rate +20;
            }
        }else{
           //半減なしの場合
           if ($request->result !== '0'){
            //失敗
                if ($request->wave === '1'){
                    //wave1失敗
                    $rate = $rate -20;
                } elseif ($request->wave === '2'){
                    //wave2失敗
                    $rate = $rate -10;
                }
            //wave3失敗時はそのまま
            }else{
                //クリア
                $rate = $rate +20;
            }

        }
        $insertData['RATE'] = $rate;
        $resultHst = new ResultHst();
        $resultHst->insertData($insertData);

        $mstNumbering = new MstNumbering();
        $mstNumbering->updateTimes(intval($request->shiftTimes) + 1, $rate, intval($request->total) + 1);

        return redirect('/');
    }
}
