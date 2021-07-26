@extends('rental.user.common.user_base')
@section('subTitle',"端末詳細")

@section('content')
    <!-- Page Heading -->


    <!-- 基礎情報-->
    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="card border-left-primary shadow mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">端末名</h6>
                </div>
                <div class="card-body text-center">
                    <div class="h2 mb-2 font-weight-bold text-gray-800" style="min-height: 24px"><?=$detail['device_name']?></div>
                </div>
            </div>
            <div class="w-100 shadow px-2">
                <div class="row">
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">カテゴリ</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800" style="min-height: 24px">
                                    @if($detail['mobile_type']==1)
                                        スマートフォン
                                    @elseif($detail['mobile_type']==2)
                                        タブレット
                                    @else
                                        その他
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">OS</h6>
                            </div>
                            <div class="card-body text-center" style="min-height: 24px">
                                <div class="h5 mb-2 font-weight-bold text-gray-800">
                                    @if($detail['os']==1)
                                        Android
                                    @elseif($detail['os']==2)
                                        iOS
                                    @else
                                        その他
                                    @endif
                                    <?=$detail['os_version']?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">通信回線</h6>
                            </div>
                            <div class="card-body  text-center">
                                <div class="h6 m-0 font-weight-bold text-gray-800" style="min-height: 24px">
                                    Wi-Fi:
                                    @if($detail['wifi_line']===1)
                                        あり
                                    @else
                                        なし
                                    @endif
                                    <br>モバイル:
                                    @if($detail['communication_line']===1)
                                        あり
                                    @else
                                        なし
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">最終貸出</h6>
                            </div>
                            <div class="card-body  text-center">
                                <div class="h6 m-0 font-weight-bold text-gray-800" style="min-height: 24px">
                                    @if($recent_user)
                                        <?=$recent_user['name']?><br>(<?=$recent_user['registration_datetime']?>)
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">ステータス</h6>
                            </div>
                            <div class="card-body mx-auto w-50">
                                @if($detail['status']===1)
                                    @if(isset($user_info) && $user_info['user_id']==$detail['user_id'])
                                        <form id='return' method="post" action="/return">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-block" name="rental_device_id[]"  value="<?=$detail['rental_device_id']?>">返却</button>
                                        </form>
                                    @else
                                        <form id='rent-user' method="post" action="/rent-user" target="_blank">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-dark btn-light btn-block" name="user_id"  value="<?=$detail['user_id']?>"><?=$detail['name']?><span class="d-md-block d-none">(<?=date('m月d日 G時i分',strtotime($detail['rental_datetime']))?>)</span></button>
                                        </form>
                                    @endif

                                @else
                                    <form id='rental' method="post" action="/rental">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-block" name="rental_device_id[]"  value="<?=$detail['rental_device_id']?>">貸出</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card border-left-primary shadow">
                <div class="card-body h-100">
                    @if($detail['device_img']===1)
                        <img class="rounded w-100 h-100" src="/bootsample/img/device_image_{{$detail['rental_device_id']}}.jpg" alt="device_image">
                    @else
                        <img class="rounded w-100 h-100" src="/bootsample/img/noImage.png" alt="no_image">
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!--詳細情報-->
    <div class="row">
        <div class="col-sm-6">
            <div class="w-100 shadow mb-4 px-2">
                <div class="row">
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-success">キャリア</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800">
                                        <?=$detail['carrier_name']?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-success">充電器タイプ</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800" style="min-height: 24px">
                                    @if($detail['charger_type']==1)
                                        USB TYPE-B
                                    @elseif($detail['charger_type']==2)
                                        USB TYPE-C
                                    @elseif($detail['charger_type']==3)
                                        iphone ライトニング
                                    @elseif($detail['charger_type']==4)
                                        iphone 旧型
                                    @else
                                        その他
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-success">電話番号</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800" style="min-height: 24px">
                                        <?=$detail['number']?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-success">メールアドレス</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800" style="min-height: 24px"><?=$detail['mail_address']?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-4">
            <div class="card border-left-success shadow mb-4 h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-success">インストール済みアプリ</h6>
                </div>
                <div class="card-body">
                    @foreach($installed_app_list as $app)
                        <ul class="m-0 justify-content-center">
                            <li class="h5 w-50 list-inline-item font-weight-bold text-gray-800"><?=$app['app_name']?></li>
                            <li class="h6 list-inline-item font-weight-bold text-gray-800">(<?=date('Y年m月d日',strtotime($app['add_date']))?>)</li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="w-100 shadow mb-4 px-2">
                <div class="row">
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-success">解像度</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800" style="min-height: 24px"><?=$detail['resolution']?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-success">画面サイズ</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800" style="min-height: 24px"><?=$detail['display_size']?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-success" style="min-height: 24px">SIMカード</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800">
                                    @if($detail['sim_card']==1)
                                        標準SIM
                                    @elseif($detail['sim_card']==2)
                                        nanoSIM
                                    @elseif($detail['sim_card']==3)
                                        microSIM
                                    @elseif($detail['sim_card']==4)
                                        miniSIM
                                    @elseif($detail['sim_card']==5)
                                        eSIM
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-success">発売日</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800" style="min-height: 24px">
                                    @if($detail['launch_date'] !== "1900-01-01")
                                        <?=date('Y年m月d日',strtotime($detail['launch_date']))?>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-sm-6 mb-4">
            <div class="card border-left-warning shadow mb-4 h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-warning">備考</h6>
                </div>
                <div class="card-body">
                    <div class="col-sm mr-1">
                        <div class="row font-weight-bold text-gray-800" style="min-height: 24px"><?=$detail['memo']?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div >
        <a href="#" onclick="window.close(); return false;" class="btn btn-secondary btn-user btn-block">閉じる</a>
</div>


@endsection
