
@extends('rental.admin.common.include')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">PCの情報を編集する</h1>
        <p class="mb-4"> PCの情報を記入してください。</p>
        @if(count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="m-0 font-weight-bold text-primary">

            <form method="post" name="pc_form" action="/admin/edit_pc/action/" onsubmit="return false;" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-6 float-left mb-3">
                    <input type="hidden" class="form-control" name="test_device_id" value="<?=$detail['test_device_id']?>">
                    <input type="hidden" class="form-control" name="rental_device_id" value="<?=$detail['rental_device_id']?>">
                        <label>端末名<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                        <input type="text" class="form-control {{$errors->has('device_name') ? "alert-danger": null}}" name="device_name" value="{{old('device_name',$detail['device_name'])}}">
                    </div>

                <div class="col-sm-3 float-left mb-3">
                    <label>OS<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                    <select class="form-control" name="os">
                        <option value="3"{{$detail['os']=== 3 ? 'selected': null}}>Windows</option>
                        <option value="4"{{$detail['os']=== 4 ? 'selected': null}}>MacOS</option>
                    </select>
                </div>

                <div class="col-sm-3 float-left mb-3">
                    <label>OSバージョン<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                    <input type="text" class="form-control {{$errors->has('os_version') ? "alert-danger": null}}" name="os_version" value="{{old('os_version',$detail['os_version'])}}">
                </div>

                <div class="col-sm-6 float-left mb-3">
                    <label>PCアカウント名<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                    <input type="text" class="form-control {{$errors->has('pc_account_name') ? "alert-danger": null}}" name="pc_account_name" value="{{old("pc_account_name",$detail['pc_account_name'])}}">
                </div>

                <div class="col-sm-6 float-left mb-3">
                    <label>メールアドレス<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                    <input type="text" class="form-control {{$errors->has('mail_address') ? "alert-danger": null}}" name="mail_address" value="{{old("mail_address",$detail['mail_address'])}}">
                </div>

                <div class="col-sm-12 float-left mb-3">
                    <label>ソフトウェア<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                    @foreach($software_master as $d )
                        <div class="w-50 float-sm-left">
                            <label><input type="checkbox" name="software_id[]" value="{!! $d['software_id'] !!}"<?= in_array($d['software_id'],$installed_software) ? 'checked' : ''?>>{{$d['software_name']}}</label>
                        </div>
                    @endforeach
                </div>

                <div class="col-sm-12 float-left mb-3">
                    <label>端末画像<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                    <input type="file" name="device_img">
                </div>

                <div class="col-sm-12 float-left mb-3">
                    <label>備考(ユーザー向け)<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                    <textarea class="form-control {{$errors->has('memo') ? "alert-danger": null}}" name=memo rows="5">{{old("memo",$detail['memo'])}}</textarea>
                </div>

                <div class="col-sm-12 float-left mb-3">
                    <label>備考(管理者向け)<span class="m-0 font-weight-bold text-info">（任意）</span></label>
                    <textarea class="form-control {{$errors->has('admin_memo') ? "alert-danger": null}}" name=admin_memo rows="5">{{old("admin_memo",$detail['admin_memo'])}}</textarea>
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
                    <a href="index_pc"><button type="button" class="btn btn-primary">はい</button></a>
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

@endsection

@push('scripts')
    <script>
        function form_submit() {
            document.pc_form.submit();
        }
    </script>
@endpush
