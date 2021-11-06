<?php
namespace App\Services;

class GetApiDataService
{
    public function getData(){

        $options = stream_context_create(array('ssl' => array(
            'verify_peer'      => false,
            'verify_peer_name' => false
          )));
           
        $json = file_get_contents('https://splamp.info/salmon/api/now', false, $options);
        $array = json_decode($json, TRUE);

        //変数まとめ
        $apiData['currentShiftNo'] = $array[0]['num'];
        $apiData['stageVal'] = $array[0]['stage_ja'];
        $apiData['stageId'] = $array[0]['stage'];
        $apiData['buki1Val'] = $array[0]['w1_ja'];
        $apiData['buki2Val'] = $array[0]['w2_ja'];
        $apiData['buki3Val'] = $array[0]['w3_ja'];
        $apiData['buki4Val'] = $array[0]['w4_ja'];
        $apiData['buki1Id'] = $array[0]['w1'];
        $apiData['buki2Id'] = $array[0]['w2'];
        $apiData['buki3Id'] = $array[0]['w3'];
        $apiData['buki4Id'] = $array[0]['w4'];

        return $apiData;

    }
}