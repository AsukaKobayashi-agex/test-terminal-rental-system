
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
                    @if(count($errors) > 0)
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="m-0 font-weight-bold text-primary">

                        <form method="post" name="sp_form" action="/admin/edit_sp/action/" onsubmit="return false;" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="test_device_id" value="<?=$detail['test_device_id']?>">
                                <input type="hidden" class="form-control" name="rental_device_id" value="<?=$detail['rental_device_id']?>">

                                <div class="col-sm-6 float-left mb-3">
                                    <label>端末名<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                    <input type="text" class="form-control {{$errors->has('device_name') ? "alert-danger": null}}" name="device_name" value="{{old('device_name',$detail['device_name'])}}">
                                </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>モバイル種別<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="mobile_type">
                                    <option value="1"{{(!$errors->has('*') && $detail['mobile_type']=== 1) || old('mobile_type')==="1" ? 'selected': null}}>スマートフォン</option>
                                    <option value="2"{{(!$errors->has('*') && $detail['mobile_type']=== 2) || old('mobile_type')==="2" ? 'selected': null}}>タブレット</option>
                                </select>
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>モバイル回線<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="communication_line">
                                    <option value="0"{{(!$errors->has('*') && $detail['communication_line']=== 0) || old('communication_line')==="0"? 'selected': null}}>なし</option>
                                    <option value="1"{{(!$errors->has('*') && $detail['communication_line']=== 1) || old('communication_line')==="1"? 'selected': null}}>あり</option>
                                </select>
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>Wi-fi回線<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="wifi_line">
                                    <option value="0"{{(!$errors->has('*') && $detail['wifi_line']=== 0) || old('wifi_line')==="0"? 'selected': null}}>なし</option>
                                    <option value="1"{{(!$errors->has('*') && $detail['wifi_line']=== 1) || old('wifi_line')==="1"? 'selected': null}}>あり</option>
                                </select>
                            </div>

                            <div class="col-sm-3 float-left mb-3">
                                <label>OS<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="os">
                                    <option value="1"{{(!$errors->has('*') && $detail['os']=== 1) || old('os')==="1" ? 'selected': null}}>Android</option>
                                    <option value="2"{{(!$errors->has('*') && $detail['os']=== 2) || old('os')==="2" ? 'selected': null}}>iOS</option>
                                </select>
                            </div>

                            <div class="col-sm-3 float-left mb-3">
                                <label>OSバージョン<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <input type="text" class="form-control {{$errors->has('os_version') ? "alert-danger": null}}" name="os_version" value="{{old('os_version',$detail['os_version'])}}">
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>キャリア<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="carrier_id">
                                    <option value="0"{{old('carrier_id',$detail['carrier_id']=== 0) ? 'selected': null}}>なし</option>
                                    @foreach($mobile_carrier as $d)
                                        <option value="{!! $d->carrier_id !!}"{{(!$errors->has('*') && $detail['carrier_id']===$d->carrier_id) || old('carrier_id')=== "$d->carrier_id" ? 'selected': null}}>{{$d->carrier_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>SIM/UIM<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="sim_card">
                                    <option value="0"{{(!$errors->has('*') && $detail['sim_card']=== 0) || old('sim_card')==="0" ? 'selected': null}}>SIMなし</option>
                                    <option value="1"{{(!$errors->has('*') && $detail['sim_card']=== 1) || old('sim_card')==="1" ? 'selected': null}}>標準SIM</option>
                                    <option value="2"{{(!$errors->has('*') && $detail['sim_card']=== 2) || old('sim_card')==="2" ? 'selected': null}}>nanoSIM</option>
                                    <option value="3"{{(!$errors->has('*') && $detail['sim_card']=== 3) || old('sim_card')==="3" ? 'selected': null}}>microSIM</option>
                                    <option value="4"{{(!$errors->has('*') && $detail['sim_card']=== 4) || old('sim_card')==="4" ? 'selected': null}}>miniSIM</option>
                                </select>
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>充電器タイプ<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control" name="charger_type">
                                    <option value="1"{{(!$errors->has('*') && $detail['charger_type']=== 1) || old('charger_type')==="1" ? 'selected': null}}>USB TYPE-B</option>
                                    <option value="2"{{(!$errors->has('*') && $detail['charger_type']=== 2) || old('charger_type')==="2" ? 'selected': null}}>USB TYPE-C</option>
                                    <option value="3"{{(!$errors->has('*') && $detail['charger_type']=== 3) || old('charger_type')==="3" ? 'selected': null}}>iphone ライトニング</option>
                                    <option value="4"{{(!$errors->has('*') && $detail['charger_type']=== 4) || old('charger_type')==="4" ? 'selected': null}}>iphone　旧型</option>
                                    <option value="0"{{(!$errors->has('*') && $detail['charger_type']=== 0) || old('charger_type')==="0" ? 'selected': null}}>その他</option>
                                </select>
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>電話番号<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="text" class="form-control {{$errors->has('number') ? "alert-danger": null}}" name="number" value="{{old('number',$detail['number'])}}">
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>メールアドレス<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="text" class="form-control{{$errors->has('mail_address') ? "alert-danger": null}}" name="mail_address" value="{{old('mail_address',$detail['mail_address'])}}">
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>画面サイズ<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="text" class="form-control {{$errors->has('display_size') ? "alert-danger": null}}" name="display_size" value="{{old('display_size',$detail['display_size'])}}">
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>解像度<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="text" class="form-control {{$errors->has('resolution') ? "alert-danger": null}}" name="resolution" value="{{old('resolution',$detail['resolution'])}}">
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>発売時期<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="date" class="form-control" name="launch_date" value="{{old('launch_date',$detail['launch_date'])}}">
                            </div>

                            <div class="col-sm-12 float-left mb-3">
                                <label>インストールアプリ<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                @foreach($mobile_app_master as $d)
                                    <div class="w-50 float-sm-left">
                                        <label><input type="checkbox" name="mobile_app_id[]" value="{!! $d['mobile_app_id']!!}"{{(!$errors->has('*') && in_array($d['mobile_app_id'],$installed_app)) || old('mobile_app_id') && in_array( $d['mobile_app_id'] ,old('mobile_app_id')) ? 'checked' : ''}}>{{$d['app_name']}}</label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-sm-12 float-left mb-3">
                                <label>端末画像<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <input type="file" name="device_img">
                            </div>

                            <div class="col-sm-12 float-left mb-3">
                                <label>備考(ユーザー向け)<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <textarea class="form-control {{$errors->has('memo') ? "alert-danger": null}}" name=memo rows="5">{{old('memo',$detail['memo'])}}</textarea>
                            </div>

                            <div class="col-sm-12 float-left mb-3">
                                <label>備考(管理者向け)<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                <textarea class="form-control {{$errors->has('admin_memo') ? "alert-danger": null}}" name=admin_memo rows="5">{{old('admin_memo',$detail['admin_memo'])}}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row float-left center w-100 my-3 center-block text-center">
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
