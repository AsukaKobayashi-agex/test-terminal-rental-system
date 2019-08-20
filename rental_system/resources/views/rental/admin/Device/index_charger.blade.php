@extends('rental.admin.common.include')

@section('content')
    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">充電器一覧</h6>
        </div>
        <div class="card-body">
            <div >
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                    <thead>
                    <tr>
                        <th width=100px >端末ID</th>
                        <th>充電器名</th>
                        <th>充電器タイプ</th>
                        <th width="10%"></th>
                    </tr>
                    </thead>

                    <div name="search_bar" class="mb-3">
                        @if(count($errors) > 0)
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form id='search' method="post" action="/admin/index_charger">
                            @csrf
                            <div class="row">
                                <div class="col-lg-2 mb-3">
                                    <input type="number" name="search_id" class="form-control" value="{{$search_id}}" placeholder="端末ID" >
                                </div>
                                <div class="col-lg-3 mb-3 mb-lg-0">
                                    <input type="search" name="search_word" class="form-control" value="{{$search_word}}" placeholder="端末名" >
                                </div>
                                <div class="col-lg-3 mb-3 mb-lg-0">
                                    <select name="charger_type" class="form-control">
                                        <option value="">充電器タイプ</option>
                                        <option value="1" {{$charger_type==="1" ? 'selected': null}}>USB TYPE-B</option>
                                        <option value="2"{{$charger_type==="2" ? 'selected': null}}>USB TYPE-C</option>
                                        <option value="3" {{$charger_type==="3" ? 'selected': null}}>iphone ライトニング</option>
                                        <option value="4" {{$charger_type==="4" ? 'selected': null}}>iphone 旧型</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 mb-3 mb-lg-0">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            @include('rental.admin.common.admin_paginate_bar')
                        </form>
                        <div class="form-group float-left mx-3">
                            <a target="_blank" href="/admin/add_charger" class="btn btn-success btn-icon-split float-right">
                            <span class="icon text-white-50">
                              <i class="fas fa-flag"></i>
                            </span>
                                <span class="text">充電器を追加する</span>
                            </a>
                        </div>
                    </div>


                    @if(empty($charger_list))
                        <tr class="font-weight-bold">
                            <td></td>
                            <td>一致する項目はありません</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif

                    <tbody>
                    @foreach($charger_list as $device)
                        <tr class="font-weight-bold">
                            <td>
                                <?=$device['rental_device_id']?>
                            </td>
                            <td>
                                <a class="text-lg text-warning" target="_blank" href="/admin/info_charger?rental_device_id=<?=$device['rental_device_id']?>" ><?=$device['charger_name']?></a>
                            </td>
                           <td>
                               @if($device['charger_type']==1)
                                   USB TYPE-B
                               @elseif($device['charger_type']==2)
                                   USB TYPE-C
                               @elseif($device['charger_type']==3)
                                   iphone ライトニング
                               @elseif($device['charger_type']==4)
                                   iphone 旧型
                               @else
                                   Other
                               @endif
                           </td>
                            <td class="align-middle px-sm-2 px-0">
                                @php($i= $device['rental_device_id'])
                                <form name="set_form<?=$i?>" id="unset_form<?=$i?>" method="post" action="index_charger/archive">
                                    @csrf
                                    <input type="hidden" name="set_device_id"  value="<?=$device['rental_device_id']?>">
                                </form>
                                <button type="button" data-toggle="modal" data-target="#setModal<?=$i?>" class="btn btn-danger btn-user btn-block px-0 align-middle">
                                    <span class="d-lg-inline d-none"><i class="fas fa-archive"></i></span><span class="d-lg-none">x</span></button>
                            </td>
                            <!--   削除モーダル -->
                            <div class="modal fade" id="setModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">アーカイブ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>この端末のアーカイブ状態にしますか？<br></h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                                            <a class="btn btn-primary once" href="javascript:document.set_form<?=$i?>.submit()">はい</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="py-3"></div>
        </div>
    </div>

@endsection
