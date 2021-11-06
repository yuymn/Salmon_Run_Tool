<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title></title>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
	<link rel='stylesheet' href="{{ asset('css/bootstrap.min.css') }}">
	{{--<link rel='stylesheet' href="{{ asset('css/common.css') }}">--}}
</head>
<body>
    <div class="container">
        <div>
            <h5>サーモンランデータ収集ツール</h5>
        </div>
        <form method="post">
            {{ csrf_field() }}
            <div>
                開催中：第 {{ $shift_data['currentShiftNo'] }} 回　　場所：{{ $shift_data['stageVal'] }}
            </div>
            <input type="hidden" name="shiftNo" value="{{ $shift_data['currentShiftNo'] }}">
            <input type="hidden" name="rate" value="{{ $db_data->CURRENT_RATE }}">
            <input type="hidden" name="total" value="{{ $db_data->TOTAL_COUNT }}">
            <div>
                現在評価：たつじん{{ $db_data->CURRENT_RATE }}　 {{ $db_data->CURRENT_SHIFT_TIMES }}回目／累計{{ $db_data->TOTAL_COUNT }}回目
            </div>
            <input type="hidden" name="stageNo" value="{{ $shift_data['stageId'] }}">
            <div>
                ブキ：<br>
                <div class="row">
                    <div class="col-6">
                        <input type="radio" name="weapon" id="weapon1" value="{{ $shift_data['buki1Id'] }}" @isset($_COOKIE['weapon']) @if($_COOKIE['weapon']===$shift_data['buki1Id']) checked @endif @endisset><label for="weapon1" class="mr-3 small">{{ $shift_data['buki1Val'] }}</label>
                    </div>
                    <div class="col-6">
                        <input type="radio" name="weapon" id="weapon2" value="{{ $shift_data['buki2Id'] }}" @isset($_COOKIE['weapon']) @if($_COOKIE['weapon']===$shift_data['buki2Id']) checked @endif @endisset><label for="weapon2" class="mr-3 small">{{ $shift_data['buki2Val'] }}</label><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <input type="radio" name="weapon" id="weapon3" value="{{ $shift_data['buki3Id'] }}" @isset($_COOKIE['weapon']) @if($_COOKIE['weapon']===$shift_data['buki3Id']) checked @endif @endisset><label for="weapon3" class="mr-3 small">{{ $shift_data['buki3Val'] }}</label>
                    </div>
                    <div class="col-6">
                        <input type="radio" name="weapon" id="weapon4" value="{{ $shift_data['buki4Id'] }}" @isset($_COOKIE['weapon']) @if($_COOKIE['weapon']===$shift_data['buki4Id']) checked @endif @endisset><label for="weapon4" class="mr-3 small">{{ $shift_data['buki4Val'] }}</label>
                    </div>    
                </div>
            </div>
            <input type="hidden" name="shiftTimes" value="{{ $db_data->CURRENT_SHIFT_TIMES }}">
            <div>
                        Wave：
                        <input type="radio" name="wave" id="wave1" value="1"  @isset($_COOKIE['wave']) @if($_COOKIE['wave']==='1') checked @endif @else checked @endisset><label for="wave1" class="mr-3">Wave1</label>
                        <input type="radio" name="wave" id="wave2" value="2" @isset($_COOKIE['wave']) @if($_COOKIE['wave']==='2') checked @endif @endisset><label for="wave2" class="mr-3">Wave2</label>
                        <input type="radio" name="wave" id="wave3" value="3" @isset($_COOKIE['wave']) @if($_COOKIE['wave']==='3') checked @endif @endisset><label for="wave3">Wave3</label>
            </div>
            <div class="form-group">
                高さ：
                <input type="radio" name="tide" id="tide0" value="0"  @isset($_COOKIE['tide']) @if($_COOKIE['tide']==='0') checked @endif @endisset><label for="tide0" class="mr-3">干潮</label>
                <input type="radio" name="tide" id="tide1" value="1" @isset($_COOKIE['tide']) @if($_COOKIE['tide']==='1') checked @endif @else checked @endisset><label for="tide1" class="mr-3">通常</label>
                <input type="radio" name="tide" id="tide2" value="2" @isset($_COOKIE['tide']) @if($_COOKIE['tide']==='2') checked @endif @endisset><label for="tide2">満潮</label>
            </div>
            <input type="hidden" name="cookie_flg" value="@isset($_COOKIE['cond'])1 @endisset">
            <div class="form-group" id="cond0_group">
                状況：
                @foreach ($cond_data[0] as $data)
                <input type="radio" name="cond" value="{{ $data->COND_ID }}" id="cond0_{{$data->COND_ID}}" @isset($_COOKIE['cond']) @if($_COOKIE['cond']===$data->COND_ID) checked @endif @endisset><label for="cond0_{{$data->COND_ID}}" class="mr-3">{{ $data->VALUE }}</label>
                @endforeach
            </div>
            <div class="form-group" id="cond1_group">
                状況：
                @foreach ($cond_data[1] as $data)
                <input type="radio" name="cond" value="{{ $data->COND_ID }}" id="cond1_{{$data->COND_ID}}" @isset($_COOKIE['cond']) @if($_COOKIE['cond']===$data->COND_ID) checked @endif @endisset><label for="cond1_{{$data->COND_ID}}" class="mr-3">{{ $data->VALUE }}</label>
                @endforeach
            </div>
            <div class="form-group" id="cond2_group">
                状況：
                @foreach ($cond_data[2] as $data)
                <input type="radio" name="cond" value="{{ $data->COND_ID }}"  id="cond2_{{$data->COND_ID}}" @isset($_COOKIE['cond']) @if($_COOKIE['cond']===$data->COND_ID) checked @endif @endisset><label for="cond2_{{$data->COND_ID}}" class="mr-3">{{ $data->VALUE }}</label>
                @endforeach
            </div>

            <ul class="nav nav-tabs">
                <li class="nav-item"><a href="#death" class="nav-link navbar-default active" data-toggle="tab">デス</a></li>
                <li class="nav-item"><a href="#result" class="nav-link navbar-default" data-toggle="tab">リザルト</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="death">
                    <div class="form-group" id="hiru_shake_group">
                        @foreach ($shake_data[0] as $data)
                        <input type="radio" name="shake" value="{{ $data->SHA_ID }}"  id="shake0_{{$data->SHA_ID}}"><label for="shake0_{{$data->SHA_ID}}" class="mr-3">{{ $data->VALUE }}</label>
                        @endforeach
                    </div>
                    <div class="form-group" id="yoru_shake_group">
                        @foreach ($shake_data[1] as $data)
                        <input type="radio" name="shake" value="{{ $data->SHA_ID }}"  id="shake1_{{$data->SHA_ID}}"><label for="shake1_{{$data->SHA_ID}}" class="mr-3">{{ $data->VALUE }}</label>
                        @endforeach
                    </div>
                    <div class="">
                        <button formaction="send0" class="btn btn-primary" type="submit">送信！</button>
                    </div>
                </div>
                <div class="tab-pane" id="result">
                    <div class="form-group">
                        <input type="radio" name="result" id="result0" value="0" checked><label for="result0" class="mr-3">クリア</label>
                        <input type="radio" name="result" id="result1" value="1"><label for="result1" class="mr-3">時間切れ</label>
                        <input type="radio" name="result" id="result2" value="2"><label for="result2">ゼンメツ</label>
                    </div>
                    <div class="form-group">
                        スペシャル残り：
                        <input type="radio" name="sp_remain" id="sp_remain0" value="0" checked><label for="sp_remain0" class="mr-3">0</label>
                        <input type="radio" name="sp_remain" id="sp_remain1" value="1"><label for="sp_remain1" class="mr-3">1</label>
                        <input type="radio" name="sp_remain" id="sp_remain2" value="2"><label for="sp_remain2">2</label>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="half_flg" id="half_flg" value="1"><label for="half_flg" class="mr-3">半減フラグ</label>
                    </div>

                    <div class="">
                        <button formaction="send1" class="btn btn-primary" type="submit">送信！</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(function () {
            $("#hiru_shake_group").show();
            $("#yoru_shake_group").hide();

            if ($('input[name="tide"]:checked').val() === '0'){
                $("#cond0_group").show();
                $("#cond1_group").hide();
                $("#cond2_group").hide();
                if ($('input[name="cookie_flg"]').val() === ''){
                $('input[name=cond]').val(['00']);
                }
            }
            if ($('input[name="tide"]:checked').val() === '1'){
                $("#cond0_group").hide();
                $("#cond1_group").show();
                $("#cond2_group").hide();
                if ($('input[name="cookie_flg"]').val() === ''){
                    $('input[name=cond]').val(['10']);
                }

            }
            if ($('input[name="tide"]:checked').val() === '2'){
                $("#cond0_group").hide();
                $("#cond1_group").hide();
                $("#cond2_group").show();
                if ($('input[name="cookie_flg"]').val() === ''){

                    $('input[name=cond]').val(['20']);
                }
            }
            
            $('input[name="tide"]').change(function () {
                if ($('input[name="tide"]:checked').val() === '0'){
                    $("#cond0_group").show();
                    $("#cond1_group").hide();
                    $("#cond2_group").hide();
                    $('input[name=cond]').val(['00']);
                }
                if ($('input[name="tide"]:checked').val() === '1'){
                    $("#cond0_group").hide();
                    $("#cond1_group").show();
                    $("#cond2_group").hide();
                    $('input[name=cond]').val(['10']);
                }
                if ($('input[name="tide"]:checked').val() === '2'){
                    $("#cond0_group").hide();
                    $("#cond1_group").hide();
                    $("#cond2_group").show();
                    $('input[name=cond]').val(['20']);
                }
            });
            $('input[name="cond"]').change(function () {
                if ($('input[name="cond"]:checked').val().slice(-1) === '0'){
                    $("#hiru_shake_group").show();
                    $("#yoru_shake_group").hide();
                }else{
                    $("#hiru_shake_group").hide();
                    $("#yoru_shake_group").show();
                }
            });

            //タイマー関連
            $('input[name="weapon"]').change(function () {
                var startTime;
                var endTime;
                //ブキ選択時の時刻を記録しておく
                startTime = new Date();
                document.cookie = 'waveStart=' + startTime;
                //wave終了時
                startTime.setSeconds(startTime.getSeconds() + 70);
                document.cookie = 'waveEnd=' + startTime;

                //うーんいったんパス。

                setTimeout(function() {
                    // 1秒（1000ms）後に処理
                    if ($('input[name="wave"]:checked').val() === '1'){
                        $('input[name=wave]').val(['2']);
                    }else if ($('input[name="wave"]:checked').val() === '2'){
                        $('input[name=wave]').val(['3']);
                    }
                }, 11500);
            });
        });

    </script>
