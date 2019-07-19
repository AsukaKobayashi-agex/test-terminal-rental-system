@extends('rental.user.common.auth_base')
@section('content')

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block d-flex align-items-baseline">
                    <img class="h-100 w-100" src="/bootsample/img/laptop.jfif">
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">登録内容を確認</h1>
                        </div>
                        @if(count($errors) > 0)
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form class="user" method="post" action="/sign-up/sign-up">
                            @csrf
                            <div class="form-group">
                                    <input type="hidden" name="username" value="<?=$input['username']?>">
                                    <label>氏名：</label>
                                    <div class="h5 text-center"><?=$input['username']?></div>
                            </div>
                            <div class="form-group">
                                    <input type="hidden" name="address" value="<?=$input['address']?>">
                                    <label>メールアドレス：</label>
                                    <div class="h5 text-center"><?=$input['address']?></div>
                            </div>
                            <div class="form-group">
                                    <input type="hidden" name="division_id" value="<?=$input['division_id']?>">
                                    <label>事業部：</label>
                                    <div class="h5 text-center">
                                        {{$input['division_id']==0 ? '所属なし' : null}}
                                        {{$input['division_id']==10 ? 'コンサルティング' : null}}
                                        {{$input['division_id']==20 ? "システムソリューション":null}}
                                        {{$input['division_id']==30 ? 'クリエイティブ':null }}
                                        {{$input['division_id']==40 ? 'Sharing Kyoto':null}}
                                        {{$input['division_id']==50 ? '経営本部':null }}
                                    </div>
                            </div>
                            <div class="form-group">
                                    <input type="hidden" name="group_id" value="<?=$input['group_id']?>">
                                    <label>グループ：</label>
                                    <div class="h5 text-center">
                                        {{$input['group_id']==0 ? '所属なし': null}}
                                        {{$input['group_id']==1010 ? '第1グループ': null}}
                                        {{$input['group_id']==1020 ? '第2グループ': null}}
                                        {{$input['group_id']==1030 ? '事業企画グループ': null}}
                                        {{$input['group_id']==2010 ? '第1ソリューショングループ': null}}
                                        {{$input['group_id']==2020 ? '第2ソリューショングループ': null}}
                                        {{$input['group_id']==2030 ? '事業運営グループ': null}}
                                        {{$input['group_id']==3010 ? 'クリエイティブグループ': null}}
                                        {{$input['group_id']==4010 ? 'カフェプロデュースグループ': null}}
                                        {{$input['group_id']==4020 ? 'メディア運営・観光サポートグループ': null}}
                                        {{$input['group_id']==4030 ? 'マーケティング支援グループ': null}}
                                        {{$input['group_id']==5010 ? '総務・法務グループ': null}}
                                        {{$input['group_id']==5020 ? '経営企画・情報システムグループ': null}}
                                        {{$input['group_id']==5030 ? '人事・経理グループ': null}}
                                    </div>
                            </div>
                            <div class="form-group mb-5">
                                    <input type="hidden" name="password" value="<?=$input['password']?>">
                                    <label>パスワード：</label>
                                    <div type="password" class="h5 text-center "><?=preg_replace("/./","●",$input['password'])?></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                登録
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

@push('scripts')
    <script>
        $(function(){
            $('#division').change(function() {
                if($('#division').val() === "10") {
                   $('.con').removeAttr('hidden');
                }else{
                    $('.con').attr('hidden',true);

                }

                if($('#division').val() === "20") {
                   $('.ss').removeAttr('hidden');
                }else{
                    $('.ss').attr('hidden',true);

                }

                if($('#division').val() === "30") {
                   $('.cre').removeAttr('hidden');
                }else{
                    $('.cre').attr('hidden',true);

                }

                if($('#division').val() === "40") {
                   $('.sk').removeAttr('hidden');
                }else{
                    $('.sk').attr('hidden',true);

                }

                if($('#division').val() === "50") {
                   $('.mng').removeAttr('hidden');
                }else{
                    $('.mng').attr('hidden',true);

                }
            });

            $('#repeatPassword').change(function() {
                if($(this).val() !== $('#password').val()) {
                   $(this).addClass("alert-danger");
                }else{
                    $(this).removeClass("alert-danger");
                }
            });
        });

    </script>
@endpush
