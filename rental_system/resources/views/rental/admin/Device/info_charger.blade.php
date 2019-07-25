

@extends('rental.admin.common.include')

@section('content')


    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">充電器情報
            <a href="edit_charger?rental_device_id=<?=$detail['rental_device_id']?>" class="btn btn-info btn-icon-split m-4">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                <span class="text">情報を編集する</span>
            </a></h1>

            <div class="my-2"></div>

        <div class="m-0 font-weight-bold text-gray-800">

            <div class="row">
                <div class="col-sm-6 float-left mb-3">
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                    <label>充電器名</label>
                        </div>
                    <div class="card-body text-center">
                        <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['charger_name']?></div>
                    </div>
                        </div>
                    </div>

                    <div class="col-sm-6 float-left mb-3">
                        <div class="card shadow mb-4">
                            <div class="card-header py-2">
                    <label>充電器タイプ</label>
                            </div>
                    <div class="card-body text-center">
                            <div class="h4 mb-2 font-weight-bold text-primary">
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
                </div>
            </div>



    <div class="col-sm-12">
        <button onclick="history.back(); return false;" class="btn btn-secondary btn-user btn-block">閉じる</button>
    </div>

@endsection
