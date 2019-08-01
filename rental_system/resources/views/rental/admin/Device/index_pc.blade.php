@extends('rental.admin.common.include')

@section('content')
    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PC端末一覧</h6>
        </div>
        <div class="card-body">
            <div >
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                    <thead>
                    <tr>
                        <th width=100px >端末ID</th>
                        <th>端末名</th>
                        <th>OS</th>
                        <th>PCアカウント名</th>
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
                        <form id='search' method="post" action="/admin/index_pc">
                            @csrf
                            <div class="row">
                                <div class="col-lg-2 mb-3">
                                    <input type="number" name="search_id" class="form-control" value="{{$search_id}}" placeholder="端末ID" >
                                </div>
                                <div class="col-lg-2 mb-3 mb-lg-0">
                                    <input type="search" name="search_word" class="form-control" value="{{$search_word}}" placeholder="端末名" >
                                </div>
                                <div class="col-lg-2 mb-3 mb-lg-0">
                                    <select name="os" class="form-control">
                                        <option value="" selected>OS</option>
                                        <option value="3" {{$os==="3" ? 'selected': null}}>Windows</option>
                                        <option value="4" {{$os==="4" ? 'selected': null}}>Mac OS</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 mb-3 mb-lg-0">
                                    <input type="text" name="os_version" class="form-control" value="{{$os_version}}" placeholder="OSバージョン" >
                                </div>
                                <div class="col-lg-2 mb-3 mb-lg-0">
                                    <input type="search" name="search_account" class="form-control" value="{{$search_account}}" placeholder="PCアカウント名" >
                                </div>
                                <div class="col-lg-2 mb-3 mb-lg-0">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            @include('rental.admin.common.admin_paginate_bar')
                        </form>
                        <div class="form-group float-left mx-3">
                            <a href="/admin/add_pc" class="btn btn-success btn-icon-split float-right">
                                <span class="icon text-white-50">
                                      <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">PC端末を追加する</span>
                            </a>
                        </div>
                    </div>

                    @if(empty($pc_device_list))
                        <tr class="font-weight-bold">
                            <td></td>
                            <td>一致する項目はありません</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif

                    <tbody>@foreach($pc_device_list as $device)
                        <tr class="font-weight-bold">
                            <td>
                                <?=$device['rental_device_id']?>
                            </td>
                            <td>
                                <a class="text-lg text-success" target="_blank" href="/admin/info_pc?rental_device_id=<?=$device['rental_device_id']?>" ><?=$device['device_name']?></a>
                            </td>

                            <td>
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
                                <?=$device['pc_account_name']?>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="py-3"></div>
        </div>
    </div>

@endsection
