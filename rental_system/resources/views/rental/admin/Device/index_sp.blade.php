@extends('rental.admin.common.include')

@section('content')
    <!-- Page Heading -->



    <!-- DataTales Example -->
    <div class="card shadow mb-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">モバイル端末一覧</h6>
        </div>
        <div class="card-body">
            <div >
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                    <thead>
                    <tr>
                        <th width=100px >端末ID</th>
                        <th>端末名</th>
                        <th>OS</th>
                        <th>キャリア</th>
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
                        <form id='search' method="post" action="/admin/index_sp">
                            @csrf
                            <div class="w-100 row">
                                <div class="col-lg-2 mb-3 order-lg-1">
                                    <input type="number" name="search_id" class="form-control" value="{{$search_id}}" placeholder="端末ID" >
                                </div>
                                <div class="col-lg-4 mb-3 order-lg-2">
                                    <input type="search" name="search_word" class="form-control" value="{{$search_word}}" placeholder="端末名" >
                                </div>

                                <div class="col-lg-2 mb-3  order-lg-6">
                                    <select name="os" class="form-control">
                                        <option value="">OS</option>
                                        <option value="1" {{($os==="1") ? 'selected': null}}>Android</option>
                                        <option value="2" {{($os==="2") ? 'selected': null}}>iOS</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-3 order-lg-7">
                                    <input type="text" name="os_version" class="form-control" value="{{$os_version}}" placeholder="OSバージョン" >
                                </div>

                                <div class="col-lg-2 mb-3 order-lg-3">
                                    <select name="type" class="form-control">
                                        <option value="">カテゴリ</option>
                                        <option value="1" {{$type==="1" ? 'selected': null}}>スマホ</option>
                                        <option value="2" {{$type==="2" ? 'selected': null}}>タブレット</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 mb-3 order-lg-4">
                                    <select name="search_carrier" class="form-control">
                                        <option value="">キャリア</option>
                                        @foreach($all_carrier as $carrier)
                                            <option value="{{$carrier['carrier_id']}}" {{($search_carrier==$carrier['carrier_id']) ? 'selected': null}}>{{$carrier['carrier_name']}}</option>
                                        @endforeach
                                        <option value="0" {{($search_carrier==="0") ? 'selected': null}}>なし</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 mb-3  order-lg-5">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            @include('rental.admin.common.admin_paginate_bar')
                        </form>
                        <div class="form-group float-left mx-3">
                            <a target="_blank" href="/admin/add_sp" class="btn btn-success btn-icon-split float-right">
                            <span class="icon text-white-50">
                              <i class="fas fa-flag"></i>
                            </span>
                                <span class="text">モバイル端末を追加する</span>
                            </a>
                        </div>
                    </div>

                    @if(empty($mobile_device_list))
                        <tr class="font-weight-bold">
                            <td></td>
                            <td>一致する項目はありません</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif

                    <tbody>@foreach($mobile_device_list as $device)
                        <tr class="font-weight-bold">
                            <td>
                                <?=$device['rental_device_id']?>
                            </td>
                            <td>
                                <a class="text-lg" target="_blank" href="/admin/info_sp?rental_device_id=<?=$device['rental_device_id']?>" ><?=$device['device_name']?></a>
                            </td>
                            <td> @if($device['os']==1)
                                    Android
                                @elseif($device['os']==2)
                                    iOS
                                @else
                                    Other OS
                                @endif
                                <?=$device['os_version']?>
                            </td>
                            <td>
                                <?=$device['carrier_name']?>
                            </td>
                            <td class="align-middle px-sm-2 px-0">
                                @php($i= $device['rental_device_id'])
                                <form name="set_form<?=$i?>" id="unset_form<?=$i?>" method="post" action="index_sp/archive">
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
