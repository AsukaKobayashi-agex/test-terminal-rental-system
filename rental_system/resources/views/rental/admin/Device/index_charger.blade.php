@extends('rental.admin.common.include')

@section('content')
    <!-- Page Heading -->
    <?php
    //preDump($all_device_list);
    $userid = "1";
    ?>

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
                        <th>充電器名</th>
                        <th>充電器タイプ</th>
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
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <input type="search" name="search_word" class="form-control form-control-user" value="{{$search_word}}" placeholder="端末名を入力" >
                                </div>
                                <div class="col-sm-2 px-1 mb-3 mb-sm-0">
                                    <select name="charger_type" class="form-control form-control-user">
                                        <option value="">充電器タイプ</option>
                                        <option value="1" {{$charger_type==="1" ? 'selected': null}}>USB TYPE-B</option>
                                        <option value="2"{{$charger_type==="2" ? 'selected': null}}>USB TYPE-C</option>
                                        <option value="3" {{$charger_type==="3" ? 'selected': null}}>iphone ライトニング</option>
                                        <option value="4" {{$charger_type==="4" ? 'selected': null}}>iphone 旧型</option>
                                    </select>
                                </div>

                                <span class="col-sm-2">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                    </button>
                                </span>
                            </form>
                            <a href="#" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-flag"></i>
                                </span>
                                <span class="text" data-toggle="modal" data-target="#basicModal">追加</span>
                            </a>
                        </div>
                    </div>


                    @if(empty($charger_list))
                        <tr class="font-weight-bold">
                            <td></td>
                            <td>一致する項目はありません</td>
                            <td></td>
                        </tr>
                    @endif

                    <tbody>
                    @foreach($charger_list as $device)
                        <tr class="font-weight-bold">
                            <td>
                                <a class="text-lg text-warning" target="_blank" href="/detail-charger?rental_device_id=<?=$device['rental_device_id']?>" ><?=$device['charger_name']?></a>
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection