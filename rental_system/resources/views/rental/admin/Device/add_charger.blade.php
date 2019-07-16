

@extends('rental.admin.common.include')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">充電器を登録する</h1>
                    <p class="mb-4"> 登録する充電器の情報を記入してください。</p>

                    <div class="m-0 font-weight-bold text-primary">

                        <form method="post" name="charger_form" action="/admin/add_charger/action/">
                            @csrf
                            <div class="form-group">
                                <label>充電器名</label>
                                <input type="text" class="form-control" name="charger_name" required value="{{old('charger_name')}}">
                                {{$errors->first('charger_name')}}
                            </div>

                            <div class="form-group">
                                <label>充電器タイプ</label>
                                <select class="form-control" name="charger_type">
                                    <option value="1">USB TYPE-B</option>
                                    <option value="2">USB　TYPE-C</option>
                                    <option value="3">iphone ライトニング</option>
                                    <option value="4">iphone 旧型</option>
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


    // 変換前
    var beforeStr = new Array('ｧ','ｨ','ｩ','ｪ','ｫ','ｬ','ｭ','ｮ','ｯ','ｰ','ｳﾞ','ｶﾞ','ｷﾞ','ｸﾞ','ｹﾞ','ｺﾞ','ｻﾞ','ｼﾞ','ｽﾞ','ｾﾞ','ｿﾞ','ﾀﾞ','ﾁﾞ','ﾂﾞ','ﾃﾞ','ﾄﾞ','ﾊﾞ','ﾋﾞ','ﾌﾞ','ﾍﾞ','ﾎﾞ','ﾊﾟ','ﾋﾟ','ﾌﾟ','ﾍﾟ','ﾎﾟ','ｱ','ｲ','ｳ','ｴ','ｵ','ｶ','ｷ','ｸ','ｹ','ｺ','ｻ','ｼ','ｽ','ｾ','ｿ','ﾀ','ﾁ','ﾂ','ﾃ','ﾄ','ﾅ','ﾆ','ﾇ','ﾈ','ﾉ','ﾊ','ﾋ','ﾌ','ﾍ','ﾎ','ﾏ','ﾐ','ﾑ','ﾒ','ﾓ','ﾔ','ﾕ','ﾖ','ﾗ','ﾘ','ﾙ','ﾚ','ﾛ','ﾜ','ｦ','ﾝ');
    // 変換後
    var afterStr = new Array('ァ','ィ','ゥ','ェ','ォ','ャ','ュ','ョ','ッ','ー','ヴ','ガ','ギ','グ','ゲ','ゴ','ザ','ジ','ズ','ゼ','ゾ','ダ','ヂ','ヅ','デ','ド','バ','ビ','ブ','ベ','ボ','パ','ピ','プ','ペ','ポ','ア','イ','ウ','エ','オ','カ','キ','ク','ケ','コ','サ','シ','ス','セ','ソ','タ','チ','ツ','テ','ト','ナ','ニ','ヌ','ネ','ノ','ハ','ヒ','フ','ヘ','ホ','マ','ミ','ム','メ','モ','ヤ','ユ','ヨ','ラ','リ','ル','レ','ロ','ワ','ヲ','ン');

    function convertStr(str) {
        var fullStr = str;
        for(var i = 0; i < beforeStr.length; i++) {
            fullStr = fullStr.replace(new RegExp(beforeStr[i], 'g'), afterStr[i]);
        }
        return fullStr;
    }
    $(function() {
        $('.form-control').on('blur', function() {
            var str = $(this).val();
            $(this).val(convertStr(str));
        });

    });

    function form_submit() {
    document.charger_form.submit();
}
</script>
@endpush
