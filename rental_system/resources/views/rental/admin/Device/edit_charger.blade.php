

@extends('rental.admin.common.info')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">充電器情報を編集する</h1>
    <p class="mb-4"> 充電器の情報を記入してください。</p>
    @if(count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="m-0 font-weight-bold text-primary">

        <form method="post" name="charger_form" action="/admin/edit_charger/action/" onsubmit="return false;">
            @csrf
            <input type="hidden" class="form-control" name="charger_id" value="<?=$detail['charger_id']?>">
            <input type="hidden" class="form-control" name="rental_device_id" value="<?=$detail['rental_device_id']?>">
            <div class="col-sm-6 float-left mb-3">
                <label>充電器名<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                <input type="text" class="form-control {{$errors->has('charger_name') ? "alert-danger": null}}" name="charger_name" value="{{old('charger_name',$detail['charger_name'])}}">
            </div>

            <div class="col-sm-6 float-left mb-3">
                <label>充電器タイプ<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                <select class="form-control" name="charger_type">
                    <option value="1"{{(!$errors->has('*') && $detail['charger_type']== 1) || old('charger_type')==="1" ? 'selected': null}}>USB TYPE-B</option>
                    <option value="2"{{(!$errors->has('*') && $detail['charger_type']== 2) || old('charger_type')==="2" ? 'selected': null}}>USB　TYPE-C</option>
                    <option value="3"{{(!$errors->has('*') && $detail['charger_type']== 3) || old('charger_type')==="3" ? 'selected': null}}>iphone ライトニング</option>
                    <option value="4"{{(!$errors->has('*') && $detail['charger_type']== 4) || old('charger_type')==="4" ? 'selected': null}}>iphone 旧型</option>
                    <option value="0"{{(!$errors->has('*') && $detail['charger_type']== 5) || old('charger_type')==="0" ? 'selected': null}}>その他</option>
                </select>
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
                <a href="/admin/info_charger?rental_device_id=<?=$detail['rental_device_id']?>"><button type="button" class="btn btn-primary">はい</button></a>
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
                <button type="button" class="btn btn-primary" onclick="document.charger_form.submit();this.disabled=true;">はい</button>
            </div>
        </div>
    </div>
</div>

@endsection
