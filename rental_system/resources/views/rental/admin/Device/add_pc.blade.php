
@extends('rental.admin.common.include')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">PCを登録する</h1>
        <p class="mb-4"> 登録するPCの情報を記入してください。</p>

        <div class="m-0 font-weight-bold text-primary">

            <form method="post" name="pc_form" action="/admin/add_pc/action/">
                @csrf
                <div class="form-group">
                    <label>OS</label>
                    <select class="form-control" name="os">
                        <option value="3">Windows</option>
                        <option value="4">MacOS</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>端末名</label>
                    <input type="text" class="form-control" name="device_name">
                    {{$errors->first('device_name')}}
                </div>

                <div class="form-group">
                    <label>PCアカウント名</label>
                    <input type="text" class="form-control" name="pc_account_name">
                    {{$errors->first('pc_account_name')}}
                </div>

                <div class="form-group">
                    <label>ソフトウェア</label>
                        @foreach($software_master as $d)
                        <div>
                            <label><input type="checkbox" name="software_id[]" value="{!! $d->software_id !!}" >{{$d->software_name}}</label>
                        </div>
                        @endforeach
                </div>

                <div class="form-group">
                    <label>アドレス</label>
                    <input type="text" class="form-control" name="mail_address">
                    {{$errors->first('mail_address')}}
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

@endsection

@push('scripts')
    <script>
        function form_submit() {
            document.pc_form.submit();
        }
    </script>
@endpush
