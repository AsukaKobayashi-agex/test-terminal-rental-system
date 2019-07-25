@extends('rental.admin.common.include')

@section('content')
    <!-- Page Heading -->
    <?php
    //preDump($all_device_list);
    $userid = "1";
    ?>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

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
                        <div class="form-group row">
                            <form name='search' method="post" action="#">
                                @csrf
                                <div class="w-100">
                                    <div class="col-lg-2 float-left mb-3">
                                        <input type="number" name="search_id" class="form-control" value="{{$search_id}}" placeholder="端末ID" >
                                    </div>
                                    <div class="col-lg-4 float-left mb-3">
                                        <input type="search" name="search_word" class="form-control" value="{{$search_word}}" placeholder="端末名" >
                                    </div>
                                    <div class="col-lg-2 float-left mb-3">
                                        <select name="type" class="form-control">
                                            <option value="">カテゴリ</option>
                                            <option value="1" {{$type==="1" ? 'selected': null}}>スマホ</option>
                                            <option value="2" {{$type==="2" ? 'selected': null}}>タブレット</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 float-left mb-3">
                                        <select name="os" class="form-control">
                                            <option value="">OS</option>
                                            <option value="1" {{($os==="1") ? 'selected': null}}>Android</option>
                                            <option value="2" {{($os==="2") ? 'selected': null}}>iOS</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 float-left mb-3">
                                        <input type="text" name="os_version" class="form-control" value="{{$os_version}}" placeholder="OSバージョン" >
                                    </div>

                                </div>
                                <div class="w-100 d-flex d-inline justify-content-end">
                                    <div class="col-lg-2 mb-3">
                                        <select name="search_carrier" class="form-control">
                                            <option value="">キャリア</option>
                                            <option value="1" {{($search_carrier==="1") ? 'selected': null}}>docomo</option>
                                            <option value="2" {{($search_carrier==="2") ? 'selected': null}}>au</option>
                                            <option value="3" {{($search_carrier==="3") ? 'selected': null}}>softbank</option>
                                            <option value="0" {{($search_carrier==="0") ? 'selected': null}}>なし</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                            <div class="form-group float-left row mx-2">
                                <a href="add_sp" class="btn btn-success btn-icon-split float-right">
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
                        </tr>
                    @endif

                    <tbody>@foreach($mobile_device_list as $device)
                        <tr class="font-weight-bold">
                            <td>
                                <?=$device['rental_device_id']?>
                            </td>
                            <td>
                                <a class="text-lg" href="edit_sp?rental_device_id=<?=$device['rental_device_id']?>" ><?=$device['device_name']?></a>
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
