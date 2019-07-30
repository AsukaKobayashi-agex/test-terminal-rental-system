@extends('rental.user.common.auth_base')
@section('subTitle',"アカウント作成")

@section('content')

    <div class="card o-hidden {{ old('group_id')==10 ? 'selected' : null }} border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block d-flex align-items-baseline">
                    <img class="h-100 w-100" src="/bootsample/img/laptop.jfif">
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">アカウントを作成</h1>
                        </div>
                        @if(count($errors) > 0)
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form class="user" method="post" action="/sign-up/sign-up-confirm">
                            @csrf
                            <div class="form-group">
                                    <input type="text" class="form-control {{$errors->has('username')? 'alert-danger':null}}" name="username" value="{{ old('username') }}" placeholder="氏名*">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control {{$errors->has('address')? 'alert-danger':null}}" name="address" value="{{ old('address') }}" placeholder="メールアドレス*">
                            </div>
                            <div class="form-group">
                                <div class="mb-3 mb-sm-0">
                                    <select class="form-control mb-3 {{$errors->has('division_id')? 'alert-danger':null}}" name="division_id"  id="division">
                                        <option class="division" value="" selected>事業部を選択*</option>
                                        <option class="division" value="10" {{ old('division_id')==10 ? 'selected' : null }}>コンサルティング</option>
                                        <option class="division" value="20" {{ old('division_id')==20 ? 'selected' : null }}>システムソリューション</option>
                                        <option class="division" value="30" {{ old('division_id')==30 ? 'selected' : null }}>クリエイティブ</option>
                                        <option class="division" value="40" {{ old('division_id')==40 ? 'selected' : null }}>Sharing Kyoto</option>
                                        <option class="division" value="50" {{ old('division_id')==50 ? 'selected' : null }}>経営本部</option>
                                        <option class="division" value="0" {{ old('division_id')==="0" ? 'selected' : null }}>所属なし</option>
                                    </select>
                                    <select class="form-control {{$errors->has('group_id')? 'alert-danger':null}}" name="group_id" id="group">
                                        <option value="">グループを選択*</option>
                                        <option class="con" value="1010" hidden {{ old('group_id')==1010 ? 'selected' : null }}>第1グループ</option>
                                        <option class="con" value="1020" hidden {{ old('group_id')==1020 ? 'selected' : null }}>第2グループ</option>
                                        <option class="con" value="1030" hidden {{ old('group_id')==1030 ? 'selected' : null }}>事業企画グループ</option>
                                        <option class="ss" value="2010" hidden {{ old('group_id')==2010 ? 'selected' : null }}>第1ソリューショングループ</option>
                                        <option class="ss" value="2020" hidden {{ old('group_id')==2020 ? 'selected' : null }}>第2ソリューショングループ</option>
                                        <option class="ss" value="2030" hidden {{ old('group_id')==2030 ? 'selected' : null }}>事業運営グループ</option>
                                        <option class="cre" value="3010" hidden {{ old('group_id')==3010 ? 'selected' : null }}>クリエイティブグループ</option>
                                        <option class="sk" value="4010" hidden {{ old('group_id')==4010 ? 'selected' : null }}>カフェプロデュースグループ</option>
                                        <option class="sk" value="4020" hidden {{ old('group_id')==4020 ? 'selected' : null }}>メディア運営・観光サポートグループ</option>
                                        <option class="sk" value="4030" hidden {{ old('group_id')==4030 ? 'selected' : null }}>マーケティング支援スループ</option>
                                        <option class="mng" value="5010" hidden {{ old('group_id')==5010 ? 'selected' : null }}>総務・法務グループ</option>
                                        <option class="mng" value="5020" hidden {{ old('group_id')==5020 ? 'selected' : null }}>経営企画・情報システムグループ</option>
                                        <option class="mng" value="5030" hidden {{ old('group_id')==5030 ? 'selected' : null }}>人事・経理グループ</option>
                                        <option value="0" {{ old('group_id')==="0" ? 'selected' : null }}>所属なし</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control {{$errors->has('password')? 'alert-danger':null}}" id="password" name="password" placeholder="パスワード*(4文字以上)">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control {{$errors->has('repeatPassword')? 'alert-danger':null}}" id="repeatPassword" name="repeatPassword" placeholder="パスワードを再入力*">
                                </div>
                            </div>
                            <div class="form-group">
                                *必須項目
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                次へ
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="/login">既にアカウントを持っている</a>
                        </div>
                    </div>
                    @component('rental.user.common.footer')
                    @endcomponent
                </div>
            </div>
        </div>
    </div>

@endsection

