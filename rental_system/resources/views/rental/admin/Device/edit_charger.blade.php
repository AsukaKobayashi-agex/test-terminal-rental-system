

@extends('rental.admin.common.include')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">充電器情報を編集する</h1>
    <p class="mb-4"> 充電器の情報を記入してください。</p>
    @if ($errors->first())
        <div class="alert alert-danger text-center">
            {{ $errors->first('charger_name')}}
        </div>
    @endif

    <div class="m-0 font-weight-bold text-primary">

        <form method="post" name="charger_form" action="/admin/edit_charger/action/" onsubmit="return false;">
            @csrf
            <input type="hidden" class="form-control" name="charger_id" value="<?=$detail['charger_id']?>">
            <div class="form-group">
                <label>充電器名<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                <input type="text" class="form-control" name="charger_name" value="<?=$detail['charger_name']?>">
            </div>

            <div class="form-group">
                <label>充電器タイプ<span class="m-0 font-weight-bold text-danger">（必須）</span></label>
                <select class="form-control" name="charger_type">
                    <option value="1"{{$detail['charger_type']=== 1 ? 'selected': null}}>USB TYPE-B</option>
                    <option value="2"{{$detail['charger_type']=== 2 ? 'selected': null}}>USB　TYPE-C</option>
                    <option value="3"{{$detail['charger_type']=== 3 ? 'selected': null}}>iphone ライトニング</option>
                    <option value="4"{{$detail['charger_type']=== 4 ? 'selected': null}}>iphone 旧型</option>
                    <option value="0"{{$detail['charger_type']=== 5 ? 'selected': null}}>その他</option>
                </select>
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
                <a href="index_charger"><button type="button" class="btn btn-primary">はい</button></a>
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
                <a type="button" class="btn btn-primary" href="javascript:document.charger_form.submit()">はい</a>
            </div>
        </div>
    </div>
</div>

@endsection
