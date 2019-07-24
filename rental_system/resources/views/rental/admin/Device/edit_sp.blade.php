
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
                    <h1 class="h3 mb-2 text-gray-800">モバイル端末情報の編集</h1>
                    <p class="mb-4"> モバイル端末の情報を記入してください。</p>
                    @if($errors->first())
                        <div class="alert alert-danger text-center">
                            {{$errors->first('device_name')}}
                            {{$errors->first('number')}}
                            {{$errors->first('mail_address')}}
                            {{$errors->first('os_version')}}
                            {{$errors->first('display_size')}}
                            {{$errors->first('resolution')}}
                            {{$errors->first('memo')}}
                            {{$errors->first('admin_memo')}}
                        </div>
                    @endif

                    <div class="m-0 font-weight-bold text-primary">

                        <form method="post" name="sp_form" action="/admin/edit_sp/action/" onsubmit="return false;">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="test_device_id" value="<?=$detail['test_device_id']?>">

                                <div class="form-group">
                                    <label>端末名<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                    <input type="text" class="form-control" name="device_name" value="<?=$detail['device_name']?>">
                                </div>

                            <div class="form-group">
                                <label>モバイル種別<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="mobile_type">
                                    <option value="1"{{$detail['mobile_type']=== 1 ? 'selected': null}}>スマートフォン</option>
                                    <option value="2"{{$detail['mobile_type']=== 2 ? 'selected': null}}>タブレット</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>モバイル回線<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="communication_line">
                                    <option value="1"{{$detail['communication_line']=== 0 ? 'selected': null}}>なし</option>
                                    <option value="2"{{$detail['communication_line']=== 1 ? 'selected': null}}>あり</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Wi-fi回線<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="wifi_line">
                                    <option value="1"{{$detail['wifi_line']=== 0 ? 'selected': null}}>なし</option>
                                    <option value="2"{{$detail['wifi_line']=== 1 ? 'selected': null}}>あり</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>キャリア<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="carrier_id">
                                    @foreach($mobile_carrier as $d)
                                        <option value="{!! $d->carrier_id !!}">{{$d->carrier_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>SIM/UIM<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="sim_card">
                                    <option value="1"{{$detail['sim_card']=== 1 ? 'selected': null}}>標準SIM</option>
                                    <option value="2"{{$detail['sim_card']=== 2 ? 'selected': null}}>nanoSIM</option>
                                    <option value="3"{{$detail['sim_card']=== 3 ? 'selected': null}}>microSIM</option>
                                    <option value="4"{{$detail['sim_card']=== 4 ? 'selected': null}}>miniSIM</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>充電器タイプ<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="charger_type">
                                    <option value="1"{{$detail['charger_type']=== 1 ? 'selected': null}}>USB TYPE-B</option>
                                    <option value="2"{{$detail['charger_type']=== 2 ? 'selected': null}}>USB TYPE-C</option>
                                    <option value="3"{{$detail['charger_type']=== 3 ? 'selected': null}}>iphone ライトニング</option>
                                    <option value="4"{{$detail['charger_type']=== 4 ? 'selected': null}}>iphone　旧型</option>
                                    <option value="5"{{$detail['charger_type']=== 5 ? 'selected': null}}>その他</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>OS<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="os">
                                    <option value="1"{{$detail['os']=== 1 ? 'selected': null}}>Android</option>
                                    <option value="2"{{$detail['os']=== 2 ? 'selected': null}}>iOS</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>OSバージョン<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="text" class="form-control" name="os_version" value="<?=$detail['os_version']?>">
                            </div>

                            <div class="form-group">
                                <label>電話番号<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="text" class="form-control" name="number" value="<?=$detail['number']?>">
                            </div>

                            <div class="form-group">
                                <label>メールアドレス<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="text" class="form-control" name="mail_address" value="<?=$detail['mail_address']?>">
                            </div>

                            <div class="form-group">
                                <label>画面サイズ<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="text" class="form-control" name="display_size" value="<?=$detail['display_size']?>">
                            </div>

                            <div class="form-group">
                                <label>解像度<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="text" class="form-control" name="resolution" value="<?=$detail['resolution']?>">
                            </div>

                            <div class="form-group">
                                <label>発売時期<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="date" class="form-control" name="launch_date" value="<?=$detail['launch_date']?>">
                            </div>

                            <div class="form-group">
                                <label>インストールアプリ<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                @foreach($mobile_app_master as $d)
                                    <div>
                                        <label><input type="checkbox" name="mobile_app_id[]" value="{!! $d['mobile_app_id']!!}"<?= in_array($d['mobile_app_id'],$installed_app) ? 'checked' : ''?>>{{$d['app_name']}}</label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>備考(ユーザー向け)<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <textarea class="form-control" name=memo rows="5"><?=$detail['memo']?></textarea>
                            </div>

                            <div class="form-group">
                                <label>備考(管理者向け)<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <textarea class="form-control" name=admin_memo rows="5"><?=$detail['admin_memo']?></textarea>
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
                                <a href="index_sp"><button type="button" class="btn btn-primary">はい</button></a>
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
