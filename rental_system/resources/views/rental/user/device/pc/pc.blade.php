@extends('rental.user.common.user_base')
@section('content')
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PC端末一覧</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                        <thead>
                        <tr>
                            <th width=40px><input type="checkbox" id="check_all"></th>
                            <th>端末名/OS</th>
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
                                        <select name="os" class="form-control form-control-user">
                                            <option value="" selected>OS</option>
                                            <option value="3">Windows</option>
                                            <option value="4">Mac OS</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                        <input type="search" name="os_version" class="form-control form-control-user" value="" placeholder="OSバージョン" >
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

                        <tbody>@foreach($pc_device_list as $device)
                            <tr>
                                <td><input type="checkbox" class="checkbox" form="action" name="action[]" value="<?=$device['rental_device_id']?>"></td>
                                <td>
                                    <a class="text-lg" href="/detail-pc?rental_device_id=<?=$device['test_device_id']?>" ><?=$device['device_name']?></a>
                                    <br>
                                    @if($device['os']==3)
                                        Windows
                                    @elseif($device['os']==4)
                                        Mac OS
                                    @else
                                        Other OS
                                    @endif

                                <?=$device['os_version']?>

                                </td>
                                <td>
                                    @if($device['status']===1)
                                        @if($userid==$device['user_id'])
                                            <form id='return' method="post" action="/return">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-block" name="action[]"  value="<?=$device['rental_device_id']?>">返却</button>
                                            </form>
                                        @else
                                            <form id='rent-user' method="post" action="/rent-user">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-dark btn-block" name="user_id"  value="<?=$device['user_id']?>"><?=$device['name']?><br>(<?=date('m月d日 G時i分',strtotime($device['rental_datetime']))?>)</button>
                                            </form>
                                        @endif

                                    @else
                                        <form id='rental' method="post" action="/rental">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-block" name="action[]"  value="<?=$device['rental_device_id']?>">貸出</button>
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
