@extends('rental.user.common.user_base')
@section('content')
    <!-- Page Heading -->

    @php
        //exit(var_dump($detail_list));
    @endphp



    <!-- 基礎情報-->
    <div class="row mb-4">
        <div class="col-sm-6">
            <div class="card border-left-primary shadow mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">充電器名</h6>
                </div>
                <div class="card-body text-center">
                    <div class="h2 mb-2 font-weight-bold text-gray-800"><?=$detail['charger_name']?></div>
                </div>
            </div>
            <div class="shadow w-100 px-2">
                <div class="row">
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">カテゴリ</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800">充電器</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">充電器タイプ</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800">
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

                    <div class="w-100 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">ステータス</h6>
                            </div>
                            <div class="card-body mx-auto w-50">
                                @if($detail['status']===1)
                                    @if($user_info['user_id']==$detail['user_id'])
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
    </div>
    

    <div class="col-sm-6">
        <a href="#" onclick="window.close(); return false;" class="btn btn-secondary btn-user btn-block">閉じる</a>
    </div>


@endsection
