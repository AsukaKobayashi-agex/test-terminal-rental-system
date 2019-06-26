@extends('rental.user.common.user_base')
@section('content')
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">充電器一覧</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                        <thead>
                        <tr>
                            <th width=40px><input type="checkbox" id="check_all"></th>
                            <th>充電器名/充電器タイプ</th>
                            <th width=40%></th>
                        </tr>
                        </thead>

                        <div name="search_bar">
                            @if(count($errors) > 0)
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="form-group row">
                                <form name='search' method="post" action="#">
                                    @csrf
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="search" name="search_word" class="form-control form-control-user" value="" placeholder="端末名を入力" >
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        <select name="charger_type" class="form-control form-control-user">
                                            <option value="" selected>充電器タイプ</option>
                                            <option value="1">USB TYPE-B</option>
                                            <option value="2">USB TYPE-C</option>
                                            <option value="3">iphone ライトニング</option>
                                            <option value="4">iphone 旧型</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        <select name="status" class="form-control form-control-user">
                                            <option value=""selected>ステータス</option>
                                            <option value="0">貸出可</option>
                                            <option value="1">貸出中</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @component('rental.user.common.bundle_bar')
                        @endcomponent

                        <?php
                        //preDump($all_device_list);
                        $userid = "1";
                        ?>

                        <tbody>@foreach($charger_list as $value)
                            <tr>
                                <td><input type="checkbox" class="checkbox" form="action" name="action[]" value="<?=$value['rental_device_id']?>"></td>
                                <td>
                                    <a class="text-lg" href="/detail?id=<?=$value['charger_id']?>" ><?=$value['charger_name']?></a>
                                    <br>
                                    @if($value['charger_type']==1)
                                        USB TYPE-B
                                    @elseif($value['charger_type']==2)
                                        USB TYPE-C
                                    @elseif($value['charger_type']==2)
                                        iphone ライトニング
                                    @elseif($value['charger_type']==2)
                                        iphone 旧型
                                    @else
                                        Other
                                    @endif
                                </td>
                                <td>
                                    @if($value['status']===1)
                                        @if($userid==$value['user_id'])
                                            <form id='return' method="post" action="/return">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-block" name="action[]"  value="<?=$value['rental_device_id']?>">返却</button>
                                            </form>
                                        @else
                                            <form id='rent-user' method="post" action="/rent-user">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-dark btn-block" name="user_id"  value="<?=$value['user_id']?>"><?=$value['name']?><br>(<?=$value['rental_datetime']?>)</button>
                                            </form>
                                        @endif

                                    @else
                                        <form id='rental' method="post" action="/rental">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-block" name="action[]"  value="<?=$value['rental_device_id']?>">貸出</button>
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
