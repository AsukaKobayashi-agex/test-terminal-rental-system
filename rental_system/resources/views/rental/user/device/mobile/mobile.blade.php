@extends('rental.user.common.user_base')
@section('subTitle',"モバイル一覧")

@section('content')
    <!-- Page Heading -->
    <?php
    //preDump($all_device_list);

    ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">モバイル端末一覧</h6>
        </div>
        <div class="card-body">
            <div >
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                        <thead>
                            <tr>
                                <th width=40px class="align-middle text-center">
                                    <div class="custom-control custom-checkbox {{empty($mobile_device_list) ? 'invisible' : null}}">
                                        <input type="checkbox" class="custom-control-input" id="check_all">
                                        <label class="custom-control-label" for="check_all"></label>
                                    </div>
                                </th>
                                <th>端末名/OS</th>
                                <th width=40%></th>
                            </tr>
                        </thead>

                        <div name="search_bar">
                            @if(count($errors) > 0)
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif
                            <div class="form-group row">
                                <form name='search' method="post" action="#">
                                    @csrf
                                    <div class="col-lg-2 px-1 mb-3">
                                        <input type="search" name="search_word" class="form-control" value="{{$search_word}}" placeholder="端末名を入力" >
                                    </div>
                                    <div class="col-lg-2 px-1 mb-3">
                                        <select name="type" class="form-control">
                                            <option value="">カテゴリ</option>
                                            <option value="1" {{$type==="1" ? 'selected': null}}>スマホ</option>
                                            <option value="2" {{$type==="2" ? 'selected': null}}>タブレット</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 px-1 mb-3">
                                        <select name="os" class="form-control">
                                            <option value="">OS</option>
                                            <option value="1" {{($os==="1") ? 'selected': null}}>Android</option>
                                            <option value="2" {{($os==="2") ? 'selected': null}}>iOS</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 px-1 mb-3">
                                        <input type="search" name="os_version" class="form-control" value="{{$os_version}}" placeholder="OSバージョン" >
                                    </div>

                                    <div class="col-lg-2 px-1 mb-3">
                                       <select name="wifi" class="form-control">
                                            <option value="">Wi-Fi</option>
                                            <option value="0" {{$wifi==="0" ? 'selected': null}}><span><i class="fas fa-fw fa-wifi"></i></span>
                                                Wi-Fiなし</option>
                                            <option value="1" {{$wifi==="1" ? 'selected': null}}>Wi-Fiあり</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 px-1 mb-3">
                                        <select name="com_line" class="form-control">
                                            <option value="">モバイル</option>
                                            <option value="0" {{$com_line==="0" ? 'selected': null}}>モバイル回線なし</option>
                                            <option value="1" {{$com_line==="1" ? 'selected': null}}>モバイル回線あり</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-8 px-1">
                                    </div>
                                    <div class="col-lg-2 px-1">
                                        <select name="status" class="form-control">
                                            <option value="" >ステータス</option>
                                            <option value="0" {{$status==="0" ? 'selected': null}}>貸出可</option>
                                            <option value="1"{{$status==="1" ? 'selected': null}}>貸出中</option>
                                              @if(\Auth::guard('user')->check())
                                            <option value="user=<?=$user_info['user_id']?>" {{$status=="user={$user_info['user_id']}" ? 'selected': null}}>返却</option>
                                        @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-2 px-1">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @component('rental.user.common.bundle_bar')
                        @endcomponent

                        @if(empty($mobile_device_list))
                            <tr class="font-weight-bold">
                                <td class="align-middle"></td>
                                <td class="align-middle">一致する項目はありません</td>
                                <td class="align-middle"></td>
                            </tr>
                        @endif

                        <tbody>@foreach($mobile_device_list as $device)
                            <tr class="font-weight-bold">
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

                                <td class="align-middle">
                                    <a class="text-lg" target="_blank" href="/detail-mobile?rental_device_id=<?=$device['rental_device_id']?>" ><?=$device['device_name']?></a>
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
                                <td class="align-middle">
                                    @if($device['status']===1)
                                        @if(isset($user_info) && $user_info['user_id']==$device['user_id'])
                                            <form id='return' method="post" action="/return">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-block" name="rental_device_id[]"  value="<?=$device['rental_device_id']?>">返却</button>
                                            </form>
                                        @else
                                            <form id='rent-user' method="post" action="/rent-user" target="_blank">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-dark btn-light btn-block" name="user_id"  value="<?=$device['user_id']?>"><?=$device['name']?><span class="d-md-block d-none">(<?=date('m月d日 G時i分',strtotime($device['rental_datetime']))?>)</span></button>
                                            </form>
                                        @endif

                                    @else
                                        <form id='rental' method="post" action="/rental">
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
