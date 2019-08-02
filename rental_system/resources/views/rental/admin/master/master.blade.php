

@extends('rental.admin.common.include')

@section('content')

    <!-- Begin Page Content -->

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">マスター管理</h1>
    <p class="mb-4"> モバイルアプリ・PCソフトウェア・キャリアの管理ができます。</p>

    @if(count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if (session('flash_message'))
        <div class="alert alert-success text-center">
            {{ session('flash_message') }}
        </div>
    @endif


    <div class="row">
    <div class="col-md-4 mb-3">
        <div class="card font-weight-bold text-primary shadow">
            <div class="card-header">
                モバイルアプリ
                <button type="button" class="btn btn-outline-primary btn-sm text-xs float-right" data-toggle="modal" data-target="#appAddModal"><i class="fas fa-fw fa-plus"></i>追加</button>
                <!--   アプリ追加モーダル -->
                <div class="modal fade" id="appAddModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">アプリ追加</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form name="addApp" method="post" action="/admin/master/add_app">
                                @csrf
                                <div class="modal-body">
                                    <h4>アプリ名を入力</h4>
                                    <input type="text" class="form-control" name="app_name" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="reset()">キャンセル</button>
                                    <button type="submit" class="btn btn-primary btn-user">追加</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-bordered" style="table-layout: fixed">
                    <thead>
                    <tr>
                        <th>アプリ名</th>
                        <th width="110px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_mobile_app as $app)
                        <tr>
                            <td class="align-middle">
                                <?=$app['app_name']?>
                            </td>
                            <td class="align-middle px-0">
                                    <button type="button" class="btn btn-sm btn-success float-left mx-1 mb-sm-0 mb-2" data-toggle="modal" data-target="#appRenameModal{{$app['mobile_app_id']}}" >編集</button>
                                    <button type="button" class="btn btn-sm btn-danger float-left mx-1 mb-sm-0 mb-2" data-toggle="modal" data-target="#appDeleteModal{{$app['mobile_app_id']}}" >削除</button>
                                <!--   アプリ削除モーダル -->
                                <div class="modal fade" id="appDeleteModal{{$app['mobile_app_id']}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">アプリ削除</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post"  name="delete_app">
                                                @csrf
                                                <div class="modal-body">
                                                    <h4>「<?=$app['app_name']?>」を削除しますか？</h4>
                                                    <input type="hidden" name="mobile_app_id" value="{{$app['mobile_app_id']}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                                                    <button type="submit" class="btn btn-danger btn-user" formaction="/admin/master/delete_app">はい</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--   アプリ編集モーダル -->
                                <div class="modal fade" id="appRenameModal{{$app['mobile_app_id']}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">アプリ名変更</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" name="rename_app">
                                                @csrf
                                                <div class="modal-body">
                                                    <h4>アプリ名を入力</h4>
                                                    <input type="hidden" name="mobile_app_id" value="{{$app['mobile_app_id']}}">
                                                    <input type="text" class="form-control" name="app_name"  value="<?=$app['app_name']?>" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="reset()">キャンセル</button>
                                                    <button type="submit" class="btn btn-success btn-user" formaction="/admin/master/rename_app">変更</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card font-weight-bold text-primary shadow">
            <div class="card-header">
                PCソフトウェア
                <button type="button" class="btn btn-outline-primary btn-sm text-xs float-right" data-toggle="modal" data-target="#softwareAddModal"><i class="fas fa-fw fa-plus"></i>追加</button>
                <!--   ソフトウェア追加モーダル -->
                <div class="modal fade" id="softwareAddModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">ソフトウェア追加</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form name="addApp" method="post" action="/admin/master/add_software">
                                @csrf

                                <div class="modal-body">
                                    <h4>ソフトウェア名を入力</h4>
                                    <input type="text" class="form-control" name="software_name" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="reset()">キャンセル</button>
                                    <button type="submit" class="btn btn-primary btn-user">追加</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-bordered" style="table-layout: fixed">
                    <thead>
                    <tr>
                        <th>ソフトウェア名</th>
                        <th width="110px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_software as $software)
                        <tr>
                            <td class="align-middle">
                                <span><?=$software['software_name']?></span>
                            </td>
                            <td class="align-middle px-0">
                                    <button type="button" class="btn btn-sm btn-success float-left mx-1 mb-sm-0 mb-2" data-toggle="modal" data-target="#softwareRenameModal{{$software['software_id']}}">編集</button>
                                    <button type="button" class="btn btn-sm btn-danger float-left mx-1 mb-sm-0 mb-2" data-toggle="modal" data-target="#softwareDeleteModal{{$software['software_id']}}">削除</button>
                                <!--   アプリ削除モーダル -->
                                <div class="modal fade" id="softwareDeleteModal{{$software['software_id']}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">ソフトウェア削除</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post"  name="delete_software">
                                                @csrf
                                                <div class="modal-body">
                                                    <h4>「<?=$software['software_name']?>」を削除しますか？</h4>
                                                    <input type="hidden" name="software_id" value="{{$software['software_id']}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                                                    <button type="submit" class="btn btn-danger btn-user" formaction="/admin/master/delete_software">はい</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--   ソフトウェア編集モーダル -->
                                    <div class="modal fade" id="softwareRenameModal{{$software['software_id']}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">ソフトウェア名変更</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post"  name="rename_software">
                                                    @csrf
                                                    <div class="modal-body">
                                                    <h4>ソフトウェア名を入力</h4>
                                                    <input type="hidden" name="software_id" value="{{$software['software_id']}}">
                                                    <input type="text" class="form-control" name="software_name"  value="<?=$software['software_name']?>" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="reset()">キャンセル</button>
                                                        <button type="submit" class="btn btn-success btn-user" formaction="/admin/master/rename_software">変更</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card font-weight-bold text-primary shadow">
            <div class="card-header">
                キャリア
                <button type="button" class="btn btn-outline-primary btn-sm text-xs float-right" data-toggle="modal" data-target="#carrierAddModal"><i class="fas fa-fw fa-plus"></i>追加</button>
                <!--   キャリア追加モーダル -->
                <div class="modal fade" id="carrierAddModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">キャリア追加</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form name="addApp" method="post" action="/admin/master/add_carrier">
                                @csrf

                                <div class="modal-body">
                                    <h4>キャリア名を入力</h4>
                                    <input type="text" class="form-control" name="carrier_name" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="reset()">キャンセル</button>
                                    <button type="submit" class="btn btn-primary btn-user">追加</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-bordered" style="table-layout: fixed">
                    <thead>
                    <tr>
                        <th>キャリア名</th>
                        <th width="110px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_carrier as $carrier)
                        <tr>
                            <td class="align-middle">
                                <span><?=$carrier['carrier_name']?></span>
                            </td>
                            <td class="align-middle px-0">
                                    <button type="button" class="btn btn-sm btn-success float-left mx-1 mb-sm-0 mb-2" data-toggle="modal" data-target="#carrierRenameModal{{$carrier['carrier_id']}}">編集</button>
                                    <button type="button" class="btn btn-sm btn-danger float-left mx-1 mb-sm-0 mb-2" data-toggle="modal" data-target="#carrierDeleteModal{{$carrier['carrier_id']}}">削除</button>
                                <!--   アプリ削除モーダル -->
                                <div class="modal fade" id="carrierDeleteModal{{$carrier['carrier_id']}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">キャリア削除</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post"  name="delete_carrier">
                                                @csrf
                                                <div class="modal-body">
                                                    <h4>「<?=$carrier['carrier_name']?>」を削除しますか？</h4>
                                                    <input type="hidden" name="carrier_id" value="{{$carrier['carrier_id']}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                                                    <button type="submit" class="btn btn-danger btn-user" formaction="/admin/master/delete_carrier">はい</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--   キャリア編集モーダル -->
                                    <div class="modal fade" id="carrierRenameModal{{$carrier['carrier_id']}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">キャリア名変更</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post"  name="rename_carrier">
                                                    @csrf
                                                    <div class="modal-body">
                                                    <h4>キャリア名を入力</h4>
                                                    <input type="hidden" name="carrier_id" value="{{$carrier['carrier_id']}}">
                                                    <input type="text" class="form-control" name="carrier_name"  value="<?=$carrier['carrier_name']?>" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="reset()">キャンセル</button>
                                                        <button type="submit" class="btn btn-success btn-user" formaction="/admin/master/rename_carrier">変更</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
