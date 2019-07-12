
@extends('rental.admin.common.include')

@section('content')

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">



    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">



            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">モバイル端末の追加</h1>
                <p class="mb-4"> 登録するモバイル端末の情報を記入してください。</p>

                <div class="m-0 font-weight-bold text-primary">

                    <form method="post" name="sp_form" action="/admin/add_sp/action/">
                        @csrf
                        <div class="form-group">
                            <label>端末名</label>
                            <input type="text" class="form-control" name="device_name">
                            {{$errors->first('device_name')}}
                        </div>

                        <div class="form-group">
                            <label>モバイル種別</label>
                            <select class="form-control" name="mobile_type">
                                <option value="1">スマートフォン</option>
                                <option value="2">タブレット</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>種別</label>
                            <select class="form-control" name="communication_line">
                                <option value="1">Wifi専用</option>
                                <option value="2">あり</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>キャリア</label>
                            <select class="form-control" name="carrier_id">
                                @foreach($mobile_carrier as $d)
                                <option value="{!! $d->carrier_id !!}">{{$d->carrier_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>社内LAN接続</label>
                            <select class="form-control" name="wifi_line">
                                <option value="1">なし</option>
                                <option value="2">あり</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>電話番号</label>
                            <input type="text" class="form-control" name="number">
                            {{$errors->first('number')}}
                        </div>

                        <div class="form-group">
                            <label>メールアドレス</label>
                            <input type="text" class="form-control" name="mail_address">
                            {{$errors->first('mail_address')}}
                        </div>

                        <div class="form-group">
                            <label>OS</label>
                            <select class="form-control" name="os">
                                <option value="1">Android</option>
                                <option value="2">iOS</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>充電器タイプ</label>
                            <select class="form-control" name="charger_type">
                                <option value="1">USB TYPE-B</option>
                                <option value="2">USB TYPE-C</option>
                                <option value="3">iphone ライトニング</option>
                                <option value="4">iphone　旧型</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>画面サイズ</label>
                            <input type="text" class="form-control" name="display_size">
                            {{$errors->first('display_size')}}
                        </div>

                        <div class="form-group">
                            <label>解像度</label>
                            <input type="text" class="form-control" name="resolution">
                            {{$errors->first('resolution')}}
                        </div>

                        <div class="form-group">
                            <label>発売時期</label>
                            <input type="text" class="form-control" name="launch_date">
                        </div>

                        <div class="form-group">
                            <label>SIM/UIM</label>
                            <select class="form-control" name="sim_card">
                                <option value="1">標準SIM</option>
                                <option value="2">nanoSIM</option>
                                <option value="3">microSIM</option>
                                <option value="4">miniSIM</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>インストールアプリ</label>
                                @foreach($mobile_app_master as $d)
                                    <div>
                                    <label><input type="checkbox" name="mobile_app_id[]" value="{!! $d->mobile_app_id !!}">{{$d->app_name}}</label>
                                    </div>
                                @endforeach
                        </div>

                        <div class="form-group">
                            <label>備考(ユーザー向け)</label>
                            <textarea class="form-control" name=memo rows="5"></textarea>
                            {{$errors->first('memo')}}
                        </div>

                        <div class="form-group">
                            <label>備考(管理者向け)</label>
                            <textarea class="form-control" name=admin_memo rows="5"></textarea>
                            {{$errors->first('admin_memo')}}
                        </div>
                    </form>
                </div>
            </div>
            <div class="row center-block text-center">
                <div class="col-1">
                </div>
                <div class="col-5">
                    <button type="button" data-toggle="modal" data-target="#basicModal" class="btn btn-outline-secondary btn-block">中断</button>
                </div>
                <div class="col-5">
                    <button type="button" data-toggle="modal" data-target="#saveModal" class="btn btn-outline-primary btn-block">保存</button>
                </div>
            </div>

            <!-- basic modal -->
            <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">中断</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4>情報の登録を中断しますか？<br></h4>
                            <p>（内容は保存されません）</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                            <a href="edit.blade.php"><button type="button" class="btn btn-primary">はい</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- basic modal -->
            <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">保存</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4>記入した情報を登録しますか？<br></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                            <button type="button" class="btn btn-primary" onclick="form_submit()">はい</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            @endsection

            @push('scripts')
                <script>
                    function form_submit() {
                        document.sp_form.submit();
                    }
                </script>
            @endpush
