<?php

namespace App\Http\Controllers;

use App\Models\MstCondition;
use App\Models\MstNumbering;
use App\Models\MstShake;
use App\Services\GetApiDataService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $mstNumbering = new MstNumbering();
        $mstCondition = new MstCondition();
        $mstShake = new MstShake();
        $service = new GetApiDataService();
        $apiData = $service->getData();
        $dbData = $mstNumbering->selectData();
        $condData = $mstCondition->selectData();
        $shakeData = $mstShake->selectData();
        $currentShiftNo = $apiData['currentShiftNo'];
        $dbShiftNo = $dbData->CURRENT_SHIFT_NO;
        $rate = $dbData->CURRENT_RATE;
        if ($currentShiftNo !== $dbShiftNo){
            $mstNumbering->updateData($currentShiftNo);
            setcookie('wave', '', time()-60);
            setcookie('tide', '', time()-60);
            setcookie('shake', '', time()-60);
            setcookie('weapon', '', time()-60);
            setcookie('cond', '', time()-60);
        }
        $tide0Cond = [];
        $tide1Cond = [];
        $tide2Cond = [];
        foreach ($condData as $cond) {
            if ($cond->TIDE === 0){
                $tide0Cond[] = $cond;
            } elseif($cond->TIDE === 1) {
                $tide1Cond[] = $cond;
            } elseif($cond->TIDE === 2) {
                $tide2Cond[] = $cond;
            }
        }
        $condDataDisp[] = $tide0Cond;
        $condDataDisp[] = $tide1Cond;
        $condDataDisp[] = $tide2Cond;

        $hiruShake = [];
        $yoruShake = [];
        $kiriShake = [];
        $grillShake = [];
        $rashShake = [];
        foreach ($shakeData as $shake) {
            if ($shake->TYPE === null){
                $hiruShake[] = $shake;
            } elseif ($shake->TYPE === 0){
                $hiruShake[] = $shake;
            } elseif($shake->TYPE === 1) {
                $hiruShake[] = $shake;
            }
        }
        $yoruShake = $shakeData;
        $shakeDataDisp[] = $hiruShake;
        $shakeDataDisp[] = $yoruShake;


        return view('index', ['shift_data' => $apiData, 'db_data' => $dbData, 'cond_data' => $condDataDisp, 'shake_data' => $shakeDataDisp]);
    }
}
