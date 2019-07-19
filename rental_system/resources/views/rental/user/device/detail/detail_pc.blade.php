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
                    <h6 class="m-0 font-weight-bold text-primary">端末名</h6>
                </div>
                <div class="card-body text-center">
                    <div class="h2 mb-2 font-weight-bold text-gray-800"><?=$detail['device_name']?></div>
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
                                <div class="h5 mb-2 font-weight-bold text-gray-800">PC</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">OS</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800">
                                    @if($detail['os']==3)
                                        Windows
                                    @elseif($detail['os']==4)
                                        Mac OS
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
                                <h6 class="m-0 font-weight-bold text-primary">メールアドレス</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="h5 mb-2 font-weight-bold text-gray-800"><?=$detail['mail_address']?></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 p-0 m-0">
                        <div class="card h-100">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">ステータス</h6>
                            </div>
                            <div class="card-body">
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
        <div class="col-sm-6">
            <div class="card border-left-primary shadow">
                <div class="card-body">
                    @if($detail['device_img']===1)
                        <img class="rounded w-100 h-100" src="/bootsample/img/1g.jpg" alt="device_image">
                    @else
                        <img class="rounded w-100 h-100" src="/bootsample/img/noImage.png" alt="no_image">
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    
    <!--詳細情報-->
    <div class="row">
        <div class="col-sm-6 mb-4">
            <div class="card border-left-success shadow mb-4 h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-success">ソフトウェア</h6>
                </div>
                <div class="card-body">
                    @foreach($installed_software_list as $software)
                        <ul class="m-0">
                            <li class="h5 w-50 list-inline-item font-weight-bold text-gray-800"><?=$software['software_name']?></li>
                            <li class="h6 list-inline-item font-weight-bold text-gray-800">(<?=date('Y年m月d日',strtotime($software['add_date']))?>)</li>
                        </ul>
                    @endforeach
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
                        <div class="row font-weight-bold text-gray-800"><?=$detail['memo']?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div >
        <a href="#" onclick="window.close(); return false;" class="btn btn-secondary btn-user btn-block">閉じる</a>
</div>


@endsection
