
@extends('rental.user.common.user_base')
@section('subTitle',"ホーム")

@section('content')
<!-- Page Heading -->


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
                    <form id='search' method="post" action="/">
                        @csrf
                    @if(count($errors) > 0)
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="search" name="search_word" class="form-control" value="{{$search_word}}" placeholder="端末名を入力" >
                            </div>
                            <div class="col-sm-2 mb-3 mb-sm-0">
                                <select name="status" class="form-control">
                                    <option value="" >ステータス</option>
                                    <option value="0" {{$status==="0" ? 'selected': null}}>貸出可</option>
                                    <option value="1"{{$status==="1" ? 'selected': null}}>貸出中</option>
                                    @if(\Auth::guard('user')->check())

                                        <option value="user=<?=$user_info['user_id']?>" {{$status=="user={$user_info['user_id']}" ? 'selected': null}}>返却</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-2 mb-3 mb-sm-0">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                </button>
                            </div>
                        </div>
                        @include('rental.user.common.paginate_bar')
                    </form>
                </div>
                @include('rental.user.common.bundle_bar')

                <tbody>
                @if(empty($all_device_list))
                    <tr class="font-weight-bold">
                        <td class="align-middle"></td>
                        <td class="align-middle">一致する項目はありません</td>
                        <td class="align-middle"></td>
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
                                <input type="checkbox" class="custom-control-input" form="bundle" name="rental_device_id[]" value="<?=$device['rental_device_id']?>" id="customCheck<?=$i?>">
                                <label class="custom-control-label" for="customCheck<?=$i?>"></label>
                            </div>
                        </td>
                        @if($device['device_category']===1)
                            @if($device['test_device_category']===1)
                                <td class="align-middle">
                                    <a class="text-lg text-primary" target="_blank" href="/detail-mobile?rental_device_id=<?=$device['rental_device_id']?>" >
                                        <?=$device['device_name']?>
                                    </a>
                                    @if($device['wifi_line']===1)
                                        <i class="fas fa-fw fa-wifi"></i>
                                    @else
                                        <i class="fas fa-fw"></i>
                                    @endif
                                    @if($device['communication_line']===1)
                                        <i class="fas fa-fw fa-mobile-alt"></i>
                                    @endif
                                    <br>
                                    @if($device['os']==1)
                                        Android
                                    @elseif($device['os']==2)
                                        iOS
                                    @else
                                        Other OS
                                    @endif
                                    <?=$device['os_version']?>

                                </td>
                            @elseif($device['test_device_category']===2)
                                <td class="align-middle">
                                    <a class="text-lg text-success" target="_blank" href="/detail-pc?rental_device_id=<?=$device['rental_device_id']?>" >
                                        <?=$device['device_name']?>
                                    </a>
                                    <br>
                                    @if($device['os']==1)
                                        Android
                                    @elseif($device['os']==2)
                                        iOS
                                    @elseif($device['os']==3)
                                        Windows
                                    @elseif($device['os']==4)
                                        Mac OS
                                    @else
                                    Other OS
                                    @endif
                                    <?=$device['os_version']?>

                                </td>
                            @endif
                        @elseif($device['device_category']===2)
                            <td class="align-middle">
                                <a class="text-lg text-warning" target="_blank" href="/detail-charger?rental_device_id=<?=$device['rental_device_id']?>" >
                                    <?=$device['charger_name']?>
                                </a>
                                <br>
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
                        @endif
                        <td  class="text-center align-middle">
                        @if($device['status']===1)
                            @if(isset($user_info) && $user_info['user_id']==$device['user_id'])
                                <form name='return' method="post" action="/return">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-block" name="rental_device_id[]"  value="<?=$device['rental_device_id']?>">返却</button>
                                </form>
                            @else
                                <form name='rent-user' method="post" action="/rent-user" target="_blank">
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
        <div class="py-3"><!--ページング用余白--></div>
    </div>
</div>


@endsection
