@extends('rental.user.common.user_base')
@section('subTitle',"マイリスト")

@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
@if(empty($all_mylist))
    <div>
        <h4 class="font-weight-bold text-lg-center my-5">登録されているマイリストはありません</h4>
    </div>
@else
<div class="form-group row" id="bundle_bar">
    <form class="w-100" method="post" id="action">
        @csrf
        <div class="d-flex">
            <span class="h4 w-25 font-weight-bold text-primary">マイリスト一覧</span>
            <div class="w-75 mx-3 text-right">
                <button type="submit" class="btn btn-primary btn-user col-md-3 mb-md-0 mb-2 bundle" disabled="disabled" formaction="/rental">一括貸出</button>
                <button type="submit" class="btn btn-danger btn-user col-md-3 bundle" disabled="disabled" formaction="/return">一括返却</button>
            </div>
        </div>
    </form>
</div>
@endif

<ol class="text-primary font-weight-bold">
    @foreach($all_mylist as $mylist)
        <li><a href="#<?=$mylist['mylist_name']?>"><?=$mylist['mylist_name']?></a></li>
    @endforeach
</ol>


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
        <div class="h4 m-0 font-weight-bold text-primary" id="<?=$mylist['mylist_name']?>">
            <?=$mylist['mylist_name']?>
            <button type="button" class="btn btn-sm btn-outline-primary text-xs" data-toggle="modal" data-target="#renameModal<?=$mylist['mylist_id']?>"><i class="fas fa-fw fa-pen"></i></button>
            <button type="button" class="btn btn-sm btn-outline-danger text-xs" data-toggle="modal" data-target="#mylistDeleteModal<?=$mylist['mylist_id']?>">削除</button>
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
                    <form name="rename<?=$mylist['mylist_id']?>" method="post" action="/mylist/rename">
                        @csrf

                            <div class="modal-body">
                            <h4>マイリストの名前を入力</h4>
                                <input type="hidden" name="mylist_id"  value="<?=$mylist['mylist_id']?>">
                                <input type="text" class="form-control" name="mylist_name"  value="<?=$mylist['mylist_name']?>" required maxlength="100">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                            <button type="submit" class="btn btn-primary btn-user" href="javascript:document.rename<?=$mylist['mylist_id']?>.submit()">変更</button>
                        </div>
                    </form>
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
                        <h4>マイリストを削除します。<br>よろしいですか？</h4>
                        <form name="deletemylist<?=$mylist['mylist_id']?>" method="post" action="/mylist/delete-mylist">
                            @csrf
                            <input type="hidden" name="mylist_id"  value="<?=$mylist['mylist_id']?>">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                        <a class="btn btn-danger" href="javascript:document.deletemylist<?=$mylist['mylist_id']?>.submit()">削除</a>
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
                                    <input type="checkbox" class="custom-control-input" id="checkAll<?=$mylist['mylist_name']?>">
                                    <label class="custom-control-label" for="checkAll<?=$mylist['mylist_name']?>"></label>
                                </div>
                            @endif
                        </th>
                        <th>端末名</th>
                        <th width=40%></th>
                        <th width=10%></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($all_mylist_device as $device)
                    @if($device['mylist_id'] === $mylist['mylist_id'])
                    <tr  class="font-weight-bold">
                        <td class="text-center align-middle">
                            <div class="custom-control custom-checkbox mylist-checkbox">
                                @php($i= "{$device['rental_device_id']}"."{$mylist['mylist_id']}")
                                <input type="checkbox" class="custom-control-input" form="action" name="rental_device_id[]" value="<?=$device['rental_device_id']?>" id="customCheck<?=$i?>">
                                <label class="custom-control-label" for="customCheck<?=$i?>"></label>
                            </div>
                        </td>
                        @if($device['device_category']===1)
                            @if($device['test_device_category']===1)
                                <td class="align-middle">
                                    <a class="text-lg text-primary" target="_blank" href="/detail-mobile?rental_device_id=<?=$device['rental_device_id']?>" >
                                        <?=$device['device_name']?>
                                    </a>
                                </td>
                            @elseif($device['test_device_category']===2)
                                <td class="align-middle">
                                    <a class="text-lg text-success" target="_blank" href="/detail-pc?rental_device_id=<?=$device['rental_device_id']?>" >
                                        <?=$device['device_name']?>
                                    </a>
                                </td>
                            @endif
                        @elseif($device['device_category']===2)
                            <td class="align-middle">
                                <a class="text-lg text-warning" target="_blank" href="/detail-charger?rental_device_id=<?=$device['rental_device_id']?>" >
                                    <?=$device['charger_name']?>
                                </a>
                            </td>
                        @endif
                        <td class="align-middle">
                        @if($device['status']===1)
                            @if(isset($user_info) && $user_info['user_id']==$device['user_id'])
                                <form name='return' method="post" action="/return">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-block" name="rental_device_id[]"  value="<?=$device['rental_device_id']?>">返却</button>
                                </form>
                            @else
                                <form name='rent-user' method="post" action="/rent-user" target="_blank">
                                    @csrf
                                    <button type="submit" class="btn btn-light btn-outline-dark btn-block" name="user_id"  value="<?=$device['user_id']?>"><?=$device['name']?><span class="d-md-block d-none">(<?=date('m月d日 G時i分',strtotime($device['rental_datetime']))?>)</span></button>
                                </form>
                            @endif

                        @else
                            <form name='rental' method="post" action="/rental">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block" name="rental_device_id[]"  value="<?=$device['rental_device_id']?>">貸出</button>
                            </form>
                        @endif
                        </td>
                        <td class="align-middle px-sm-2 px-0">
                            <form name="delete_form<?=$i?>" id="delete_form<?=$i?>" method="post" action="/mylist/delete">
                                @csrf
                                <input type="hidden" name="delete_device_id"  value="<?=$device['rental_device_id']?>">
                                <input type="hidden" name="delete_mylist_id"  value="<?=$mylist['mylist_id']?>">
                            </form>
                            <button type="button" data-toggle="modal" data-target="#deleteModal<?=$i?>" class="btn btn-primary btn-user btn-block px-0 align-middle"><span class="d-lg-inline d-none">削除</span><span class="d-lg-none">x</span></button>
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
                        <td class="align-middle"></td>
                        <td class="align-middle">登録されている端末はありません</td>
                        <td class="align-middle"></td>
                        <td class="align-middle"></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach


@endsection

