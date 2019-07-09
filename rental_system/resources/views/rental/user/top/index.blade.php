@extends('rental.user.common.user_base')
@section('content')
<!-- Page Heading -->
@php
    //preDump($_POST['search_word']);
    $userid = "1";
@endphp

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">レンタル品一覧</h6>
    </div>
    <div class="card-body">
        <div>
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                    <thead>
                        <tr>
                            <th width=40px class="align-middle text-center">
                                <div class="custom-control custom-checkbox {{empty($all_device_list) ? 'invisible' : null}}">
                                    <input type="checkbox" class="custom-control-input " id="check_all">
                                    <label class="custom-control-label" for="check_all"></label>
                                </div>
                            </th>
                            <th>端末名</th>
                            <th width=40%></th>
                        </tr>
                    </thead>

                    <div id="search_bar">
                        @if(count($errors) > 0)
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <form id='search' method="post" action="#">
                                @csrf
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <input type="search" name="search_word" class="form-control form-control-user" value="{{isset($_POST['search_word']) ? $_POST['search_word']: null}}" placeholder="端末名を入力" >
                                </div>
                                <div class="col-sm-2 mb-3 mb-sm-0">
                                    <select name="status" class="form-control form-control-user">
                                        <option value="" >ステータス</option>
                                        <option value="0" {{isset($_POST['status']) && $_POST['status']==="0" ? 'selected': null}}>貸出可</option>
                                        <option value="1"{{isset($_POST['status'])&&$_POST['status']==="1" ? 'selected': null}}>貸出中</option>
                                        <option value="user=<?=$userid?>" {{isset($_POST['status'])&&$_POST['status']=="user=$userid" ? 'selected': null}}>返却</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 mb-3 mb-sm-0">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @component('rental.user.common.bundle_bar')
                    @endcomponent

                    <tbody>
                    @if(empty($all_device_list))
                        <tr class="font-weight-bold">
                            <td></td>
                            <td>一致する項目はありません</td>
                            <td></td>
                        </tr>
                    @endif

                    @foreach($all_device_list as $device)
                        <tr  class="font-weight-bold">
                            <td class="text-center align-middle">
                                <div class="custom-control custom-checkbox checkbox">
                                    @if(!isset($i))
                                    @php($i = 1)
                                    @else
                                    @php($i++)
                                    @endif
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
                                        <button type="submit" class="btn btn-danger btn-block" name="rental_device_id[]"  value="<?=$device['rental_device_id']?>">返却</button>
                                    </form>
                                @else
                                    <form name='rent-user' method="post" action="/rent-user">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-dark btn-light btn-block" name="user_id"  value="<?=$device['user_id']?>">
                                            <?=$device['name']?>
                                            <span class="d-md-block d-none">
                                                (<?=date('m月d日 G時i分',strtotime($device['rental_datetime']))?>)
                                            </span>
                                        </button>
                                    </form>
                                @endif

                            @else
                                <form name='rental' method="post" action="/rental">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block" name="rental_device_id[]"  value="<?=$device['rental_device_id']?>">貸出</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection
