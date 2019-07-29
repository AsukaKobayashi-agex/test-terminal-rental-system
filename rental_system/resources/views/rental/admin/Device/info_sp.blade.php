
@extends('rental.admin.common.include')

@section('content')

    <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">モバイル端末情報
                        <a href="/admin/edit_sp?rental_device_id=<?=$detail['rental_device_id']?>" class="btn btn-info btn-icon-split m-4">
                        <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                        <span class="text">情報を編集する</span>
                        </a></h1>

                    <div class="m-0 font-weight-bold text-gray-800">

                        <div class="row">
                        <div class="col-sm-6 float-left mb-3">
                        <div class="card shadow mb-4">
                            <div class="card-header py-2">
                                    <label>端末名</label>
                            </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['device_name']?></div>
                                </div>
                        </div>
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>モバイル種別</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary">
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
                        </div>

                        <div class="row">
                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>モバイル回線</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary">
                                            @if($detail['communication_line']===1)
                                                あり
                                            @else
                                                なし
                                            @endif
                                        </div>
                                </div>
                        </div>
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>Wi-fi回線</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary">
                                            @if($detail['wifi_line']===1)
                                                あり
                                            @else
                                                なし
                                            @endif
                                        </div>
                                </div>
                        </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>OS</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary">
                                            @if($detail['os']==1)
                                                Android
                                            @elseif($detail['os']==2)
                                                iOS
                                            @else
                                                その他
                                            @endif
                                            <?=$detail['os_version']?>
                                        </div>
                                </div>
                        </div>
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>キャリア</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['carrier_name']?></div>
                                </div>
                        </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>SIM/UIM</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary">
                                            @if($detail['sim_card']==1)
                                                標準SIM
                                            @elseif($detail['sim_card']==2)
                                                nanoSIM
                                            @elseif($detail['sim_card']==3)
                                                microSIM
                                            @elseif($detail['sim_card']==4)
                                                miniSIM
                                            @endif
                                        </div>
                                </div>
                        </div>
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>充電器タイプ</label>
                                </div>
                                <div class="h4 mb-2 font-weight-bold text-primary">
                                    <div class="card-body text-center">
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
                        </div>

                        <div class="row">
                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>電話番号</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['number']?></div>
                                </div>
                        </div>
                            </div>

                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>メールアドレス</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['mail_address']?></div>
                                </div>
                        </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>画面サイズ</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['display_size']?></div>
                                </div>
                        </div>
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>解像度</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['resolution']?></div>
                                </div>
                        </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-sm-6 float-left mb-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-2">
                                    <label>発売時期</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary">
                                            @if($detail['launch_date']=='1900-01-01')
                                            @else
                                                <?=date('Y年m月d日',strtotime($detail['launch_date']))?>
                                            @endif
                                        </div>
                                </div>
                            </div>
                        </div>

                    </div>

                            <div class="card shadow mb-4 w-100">
                                <div class="card-header py-2">
                                    <label>インストールアプリ</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary">
                                            @foreach($installed_app as $app)
                                                <ul class="m-0">
                                                    <li class="h5 font-weight-bold text-primary d-inline-block"><?=$app['app_name']?></li>
                                                    <li class="h6 font-weight-bold text-gray-800 d-inline-block">(<?=date('Y年m月d日',strtotime($app['add_date']))?>)</li>
                                                </ul>
                                            @endforeach
                                        </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4 w-100">
                                <div class="card-header py-2">
                                    <label>備考(ユーザー向け)</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['memo']?></div>
                                </div>
                            </div>

                            <div class="card shadow mb-4 w-100">
                                <div class="card-header py-2">
                                    <label>備考(管理者向け)</label>
                                </div>
                                    <div class="card-body text-center">
                                        <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['admin_memo']?></div>
                                </div>
                            </div>

                            <label>端末画像</label>
                            <div class="card-body">
                                @if($detail['device_img']===1)
                                    <img class="rounded w-50 h-50" src="bootsample/img/device_image_{{$detail['rental_device_id']}}.jpg" alt="device_image">
                                @else
                                    <img class="rounded w-50 h-50" src="/bootsample/img/noImage.png" alt="no_image">
                                @endif
                            </div>
                        </div>

                </div>
        </div>
        </div>



    <div class="col-sm-12">
        <a href="#" onclick="window.close(); return false;" class="btn btn-secondary btn-user btn-block">閉じる</a>
    </div>

    @endsection

