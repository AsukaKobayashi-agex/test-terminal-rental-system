@extends('rental.user.common.user_base')
@section('content')
<!-- Page Heading -->
<?php
//exit(preDump($all_mylist));
$userid = "1";
$i = 1;
//var_dump($all_mylist_device);
//var_dump($all_mylist);
?>

<!-- DataTales Example -->
@if(empty($all_mylist))
    <div>
        <h4 class="font-weight-bold text-lg-center my-5">登録されているマイリストはありません</h4>
    </div>
@else
<div class="form-group row" id="bundle_bar">
    <form class="w-100" method="post" id="action">
        @csrf
        <div class="d-flex d-block">
            <div class="col-sm-8 mb-3 mb-sm-0"></div>
            <div class="col-sm-2 mb-3 mb-sm-0">
                <button type="submit" class="btn btn-primary btn-user btn-block bundle" disabled="disabled" formaction="/rental">一括貸出</button>
            </div>
            <div class="col-sm-2 mb-3 mb-sm-0">
                <button type="submit" class="btn btn-danger btn-user btn-block bundle" disabled="disabled" formaction="/return">一括返却</button>
            </div>
        </div>
    </form>
</div>
@endif
@if(count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@foreach($all_mylist as $mylist)
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="h4 m-0 font-weight-bold text-primary">
            <?=$mylist['mylist_name']?>
            <a class="text-xs text-primary btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#renameModal<?=$mylist['mylist_id']?>"><i class="fas fa-fw fa-pen"></i></a>
            <a class="text-xs btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#mylistDeleteModal<?=$mylist['mylist_id']?>">削除</a>
        </div>
        <!--   名前編集モーダル -->
        <div class="modal fade" id="renameModal<?=$mylist['mylist_id']?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">名前編集</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>マイリストの名前を入力</h4>
                        <form name="rename<?=$mylist['mylist_id']?>" method="post" action="/mylist/rename">
                            @csrf
                            <input type="hidden" name="mylist_id"  value="<?=$mylist['mylist_id']?>">
                            <input type="text" class="form-control form-control-user" name="mylist_name"  value="<?=$mylist['mylist_name']?>">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                        <a class="btn btn-primary" href="javascript:document.rename<?=$mylist['mylist_id']?>.submit()">はい</a>
                    </div>
                </div>
            </div>
        </div>
        <!--   マイリスト削除確認モーダル -->
        <div class="modal fade" id="mylistDeleteModal<?=$mylist['mylist_id']?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">マイリスト削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>マイリストを削除します。</h4>
                        <form name="deletemylist<?=$mylist['mylist_id']?>" method="post" action="/mylist/delete-mylist">
                            @csrf
                            <input type="hidden" name="mylist_id"  value="<?=$mylist['mylist_id']?>">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                        <a class="btn btn-primary" href="javascript:document.deletemylist<?=$mylist['mylist_id']?>.submit()">はい</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div >
                <table class="table table-bordered table-striped data-table" width="100%" cellspacing="0" style="table-layout:fixed;">
                    <thead>
                        <tr>
                            <th width=40px class="align-middle text-center">
                                @php
                                    $mylist_id = array_column($all_mylist_device, 'mylist_id');
                                @endphp
                                @if(in_array("{$mylist['mylist_id']}", $mylist_id))
                                    <div class="custom-control custom-checkbox mylist-check-all">
                                        <input type="checkbox" class="custom-control-input" id="<?=$mylist['mylist_name']?>">
                                        <label class="custom-control-label" for="<?=$mylist['mylist_name']?>"></label>
                                    </div>
                                @endif
                            </th>
                            <th>端末名</th>
                            <th width=40%></th>
                            <th width=10%></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $exist=0;
                    @endphp
                    @foreach($all_mylist_device as $device)
                        @if($device['mylist_id'] === $mylist['mylist_id'])
                        <tr  class="font-weight-bold">
                            <td class="text-center align-middle">
                                <div class="custom-control custom-checkbox mylist-checkbox">
                                    @php
                                    $i ++;
                                    $exist = 1;
                                    @endphp
                                    <input type="checkbox" class="custom-control-input" form="action" name="rental_device_id[]" value="<?=$device['rental_device_id']?>" id="customCheck<?=$i?>">
                                    <label class="custom-control-label" for="customCheck<?=$i?>"></label>
                                </div>
                            </td>
                            @if($device['device_category']===1)
                                @if($device['test_device_category']===1)
                                    <td >
                                        <a class="text-lg text-primary" target="_blank" href="/detail-mobile?rental_device_id=<?=$device['rental_device_id']?>" >
                                            <?=$device['device_name']?>
                                        </a>
                                    </td>
                                @elseif($device['test_device_category']===2)
                                    <td>
                                        <a class="text-lg text-success" target="_blank" href="/detail-pc?rental_device_id=<?=$device['rental_device_id']?>" >
                                            <?=$device['device_name']?>
                                        </a>
                                    </td>
                                @endif
                            @elseif($device['device_category']===2)
                                <td>
                                    <a class="text-lg text-warning" target="_blank" href="/detail-charger?rental_device_id=<?=$device['rental_device_id']?>" >
                                        <?=$device['charger_name']?>
                                    </a>
                                </td>
                            @endif
                            <td>
                            @if($device['status']===1)
                                @if($userid==$device['user_id'])
                                    <form name='return' method="post" action="/return">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-light bg-danger btn-block" name="rental_device_id[]"  value="<?=$device['rental_device_id']?>">返却</button>
                                    </form>
                                @else
                                    <form name='rent-user' method="post" action="/rent-user">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-dark btn-light btn-block" name="user_id"  value="<?=$device['user_id']?>"><?=$device['name']?><span class="d-md-block d-none">(<?=date('m月d日 G時i分',strtotime($device['rental_datetime']))?>)</span></button>
                                    </form>
                                @endif

                            @else
                                <form name='rental' method="post" action="/rental">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block" name="rental_device_id[]"  value="<?=$device['rental_device_id']?>">貸出</button>
                                </form>
                            @endif
                            </td>
                            <td>
                                @php($i= "{$device['rental_device_id']}"."{$mylist['mylist_id']}")
                                <form name="delete_form<?=$i?>" id="delete_form<?=$i?>" method="post" action="/mylist/delete">
                                    @csrf
                                    <input type="hidden" name="delete_device_id"  value="<?=$device['rental_device_id']?>">
                                    <input type="hidden" name="delete_mylist_id"  value="<?=$mylist['mylist_id']?>">
                                </form>
                                <button type="button" data-toggle="modal" data-target="#deleteModal<?=$i?>" class="btn btn-primary btn-user btn-block ">削除</button>
                            </td>
                        </tr>
                        <!--   削除モーダル -->
                        <div class="modal fade" id="deleteModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">削除</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>この端末をマイリストから削除しますか？<br></h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                                        <a class="btn btn-primary" href="javascript:document.delete_form<?=$i?>.submit()">はい</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    @if(!in_array("{$mylist['mylist_id']}", $mylist_id))
                        <tr class="font-weight-bold">
                            <td></td>
                            <td>登録されている端末はありません</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endforeach


@endsection

