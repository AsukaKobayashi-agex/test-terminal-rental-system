
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
                    @if(count($errors) > 0)
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="post" name="sp_form" action="/admin/add_sp/action/" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div class="col-sm-6 float-left mb-3">
                                <label>端末名<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <input type="text" class="form-control {{$errors->has('device_name') ? "alert-danger": null}}" name="device_name" value="{{old('device_name')}}">
                            </div>

                            <div class="col-sm-6 float-left mb-3">
                                <label>モバイル種別<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                                <select class="form-control {{$errors->has('mobile_type') ? "alert-danger": null}}" name="mobile_type">
                                    <option value="">-----</option>
                                    <option value="1" {{old('mobile_type')=== "1" ? 'selected': null}}>スマートフォン</option>
                                    <option value="2" {{old('mobile_type')=== "2" ? 'selected': null}}>タブレット</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <label>モバイル回線<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                            <select class="form-control {{$errors->has('communication_line') ? "alert-danger": null}}" name="communication_line">
                                <option value="">-----</option>
                                <option value="0" {{old('communication_line')=== "0" ? 'selected': null}}>なし</option>
                                <option value="1" {{old('communication_line')=== "1" ? 'selected': null}}>あり</option>
                            </select>
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <label>WiFi回線<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                            <select class="form-control {{$errors->has('wifi_line') ? "alert-danger": null}}" name="wifi_line">
                                <option value="">-----</option>
                                <option value="0" {{old('wifi_line')=== "0" ? 'selected': null}}>なし</option>
                                <option value="1" {{old('wifi_line')=== "1" ? 'selected': null}}>あり</option>
                            </select>
                        </div>

                        <div class="col-sm-3 float-left mb-3">
                            <label>OS<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                            <select class="form-control {{$errors->has('os') ? "alert-danger": null}}" name="os">
                                <option value="">-----</option>
                                <option value="1" {{old('os')=== "1" ? 'selected': null}}>Android</option>
                                <option value="2" {{old('os')=== "2" ? 'selected': null}}>iOS</option>
                            </select>
                        </div>

                        <div class="col-sm-3 float-left mb-3">
                            <label>OSバージョン<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                            <input type="text" class="form-control {{$errors->has('os_version') ? "alert-danger": null}}" name="os_version"  value="{{old('os_version')}}">
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <label>キャリア<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                            <select class="form-control {{$errors->has('carrier_id') ? "alert-danger": null}}" name="carrier_id">
                                <option value="">-----</option>
                                <option value="0">なし</option>
                            @foreach($mobile_carrier as $d)
                                <option value="{!! $d['carrier_id'] !!}" {{old('carrier_id')=== "{$d['carrier_id']}" ? 'selected': null}}>{{$d['carrier_name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <label>SIM/UIM<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                            <select class="form-control {{$errors->has('sim_card') ? "alert-danger": null}}" name="sim_card">
                                <option value="">-----</option>
                                <option value="0" {{old('sim_card')=== "0" ? 'selected': null}}>SIMなし</option>
                                <option value="1" {{old('sim_card')=== "1" ? 'selected': null}}>標準SIM</option>
                                <option value="2" {{old('sim_card')=== "2" ? 'selected': null}}>nanoSIM</option>
                                <option value="3" {{old('sim_card')=== "3" ? 'selected': null}}>microSIM</option>
                                <option value="4" {{old('sim_card')=== "4" ? 'selected': null}}>miniSIM</option>
                                <option value="5" {{old('sim_card')=== "5" ? 'selected': null}}>eSIM</option>
                            </select>
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <label>充電器タイプ<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                            <select class="form-control {{$errors->has('charger_type') ? "alert-danger": null}}" name="charger_type">
                                <option value="">-----</option>
                                <option value="1" {{old('charger_type')=== "1" ? 'selected': null}}>USB TYPE-B</option>
                                <option value="2" {{old('charger_type')=== "2" ? 'selected': null}}>USB TYPE-C</option>
                                <option value="3" {{old('charger_type')=== "3" ? 'selected': null}}>iphone ライトニング</option>
                                <option value="4" {{old('charger_type')=== "4" ? 'selected': null}}>iphone 旧型</option>
                                <option value="0" {{old('charger_type')=== "0" ? 'selected': null}}>その他</option>
                            </select>
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <label>電話番号<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                            @if($errors->has('number'))
                                <span class="text-danger">
                                    {{$errors->first('number')}}
                                </span>
                            @endif
                            <input type="tel" class="form-control  {{$errors->has('number') ? "alert-danger": null}}" name="number"  value="{{old('number')}}">
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <label>メールアドレス<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                            <input type="text" class="form-control {{$errors->has('mail_address') ? "alert-danger": null}}" name="mail_address"  value="{{old('mail_address')}}">
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <label>画面サイズ<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                            <input type="text" class="form-control {{$errors->has('display_size') ? "alert-danger": null}}" name="display_size" value="{{old('display_size')}}">
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <label>解像度<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                            <input type="text" class="form-control {{$errors->has("resolution") ? "alert-danger": null}}" name="resolution" value="{{old('resolution')}}">
                        </div>

                        <div class="col-sm-6 float-left mb-3">
                            <label>発売時期<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                            <input type="date" class="form-control" name="launch_date" value="{{old('launch_date')}}">
                        </div>

                        <div class="col-sm-12 float-left mb-3">
                            <label class="d-block">インストールアプリ<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                                @foreach($mobile_app_master as $d)
                                    <div class="w-50 float-sm-left">
                                    <label><input type="checkbox" name="mobile_app_id[]" value="{!! $d['mobile_app_id'] !!}" {{old('mobile_app_id') && in_array( $d['mobile_app_id'] ,old('mobile_app_id')) ? 'checked': null}}>{{ $d['app_name'] }}</label>
                                    </div>
                                @endforeach
                        </div>

                        <div class="col-sm-12 float-left mb-3">
                            <label>端末画像<span class="m-0 font-weight-bold text-info">（任意）</span><span class="m-0 text-secondary text-xs">最大3MB</span></label>
                            <input type="file" name="device_img" accept="image/jpeg">
                        </div>

                        <div class="col-sm-12 float-left mb-3">
                            <label>備考(ユーザー向け)<span class="m-0 font-weight-bold text-info">（任意）</span><span class="m-0 text-secondary text-xs">改行は１文字としてカウント</span></label>
                            <textarea class="form-control {{$errors->has('memo') ? "alert-danger": null}}" name=memo rows="5">{{old('memo')}}</textarea>
                        </div>

                        <div class="col-sm-12 float-left mb-3">
                            <label>備考(管理者向け)<span class="m-0 font-weight-bold text-info">（任意）</span><span class="m-0 text-secondary text-xs">改行は１文字としてカウント</span></label>
                            <textarea class="form-control {{$errors->has('admin_memo') ? "alert-danger": null}}" name=admin_memo rows="5">{{old('admin_memo')}}</textarea>
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
                            <a href="/admin/index_sp"><button type="button" class="btn btn-primary">はい</button></a>
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
                            <button type="button" class="btn btn-primary once" onclick="document.sp_form.submit();this.disabled=true;">はい</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @endsection

