@extends('rental.admin.common.include')

@section('content')
    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">アーカイブ</h6>
        </div>

        <div class="card-body">
            <div>
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                    <thead>
                    <tr>
                        <th width=100px >端末ID</th>
                        <th>端末名</th>
                        <th width=15%></th>
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
                            <form id='search' method="post" action="/admin/archived">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-2 mb-3">
                                        <input type="number" name="search_id" class="form-control" value="{{$search_id}}" placeholder="端末ID" >
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <input type="search" name="search_word" class="form-control" value="{{$search_word}}" placeholder="端末名" >
                                    </div>
                                    <div class="col-sm-2 mb-3">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                @include('rental.admin.common.admin_paginate_bar')
                            </form>
                    </div>

                    <tbody>
                    @if(empty($all_device_list))
                        <tr class="font-weight-bold">
                            <td></td>
                            <td>一致する項目はありません</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif

                    @foreach($all_device_list as $device)
                        <tr  class="font-weight-bold">
                            <td class="text-center align-middle">
                                <?=$device['rental_device_id']?>
                            </td>
                            @if($device['device_category']===1)
                                @if($device['test_device_category']===1)
                                    <td >
                                        <a class="text-lg text-primary" target="_blank" href="/admin/info_sp?rental_device_id=<?=$device['rental_device_id']?>" >
                                            <?=$device['device_name']?>
                                        </a>
                                    </td>
                                @elseif($device['test_device_category']===2)
                                    <td>
                                        <a class="text-lg text-success" target="_blank" href="/admin/info_pc?rental_device_id=<?=$device['rental_device_id']?>" >
                                            <?=$device['device_name']?>
                                        </a>
                                    </td>
                                @endif
                            @elseif($device['device_category']===2)
                                <td>
                                    <a class="text-lg text-warning" target="_blank" href="/admin/info_charger?rental_device_id=<?=$device['rental_device_id']?>" >
                                        <?=$device['charger_name']?>
                                    </a>
                                </td>
                            @endif
                            <td class="align-middle px-sm-2 px-0">
                                @php($i= $device['rental_device_id'])
                                <form name="unset_form<?=$i?>" id="unset_form<?=$i?>" method="post" action="archived/unset">
                                    @csrf
                                    <input type="hidden" name="unset_device_id"  value="<?=$device['rental_device_id']?>">
                                </form>
                                <button type="button" data-toggle="modal" data-target="#unsetModal<?=$i?>" class="btn btn-primary btn-user btn-block px-0 align-middle"><span class="d-lg-inline d-none">アーカイブ解除</span><span class="d-lg-none">x</span></button>
                            </td>
                            <!--   削除モーダル -->
                            <div class="modal fade" id="unsetModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">アーカイブ解除</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>この端末のアーカイブ状態を解除しますか？<br></h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                                            <a class="btn btn-primary once" href="javascript:document.unset_form<?=$i?>.submit()">はい</a>
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
