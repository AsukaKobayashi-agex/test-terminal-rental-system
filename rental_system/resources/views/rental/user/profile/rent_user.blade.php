@extends('rental.user.common.user_base')
@section('content')
<!-- Page Heading -->
{{--}}@php(var_dump($rent_user_info))--}}
<!-- DataTales Example -->
<div class="card border-left-primary shadow col-lg-6 mb-4 px-0">
    <div class="card-header py-3">
        <h6 class="text-xl-canter font-weight-bold text-primary">プロフィール</h6>
    </div>
    @if(count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="card-body">
        <form method="post" name="change_profile" id="change_profile" action="/profile/change-profile">
            @csrf
            <div class="row">
                <div class="mx-auto w-75 mb-4">
                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-3 p-2">ユーザーネーム</div>
                    <div class="text-left w-75 mx-auto mb-3"><?=$rent_user_info['name']?></div>
                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-3 p-2">所属</div>
                    {{--division--}}
                    <div class="text-left w-75 mx-auto mb-3">
                        {{$rent_user_info['division_id']===0 ? '所属なし' : null}}
                        {{$rent_user_info['division_id']===10 ? 'コンサルティング' : null}}
                        {{$rent_user_info['division_id']===20 ? "システムソリューション":null}}
                        {{$rent_user_info['division_id']===30 ? 'クリエイティブ':null }}
                        {{$rent_user_info['division_id']===40 ? 'Sharing Kyoto':null}}
                        {{$rent_user_info['division_id']===50 ? '経営本部':null }}
                        事業部
                    </div>
                    {{--group--}}
                    <div class="text-left w-75 mx-auto mb-3">
                        {{$rent_user_info['group_id']===0 ? '所属なし': null}}
                        {{$rent_user_info['group_id']===1010 ? '第1グループ': null}}
                        {{$rent_user_info['group_id']===1020 ? '第2グループ': null}}
                        {{$rent_user_info['group_id']===1030 ? '事業企画グループ': null}}
                        {{$rent_user_info['group_id']===2010 ? '第1ソリューショングループ': null}}
                        {{$rent_user_info['group_id']===2020 ? '第2ソリューショングループ': null}}
                        {{$rent_user_info['group_id']===2030 ? '事業運営グループ': null}}
                        {{$rent_user_info['group_id']===3010 ? 'クリエイティブグループ': null}}
                        {{$rent_user_info['group_id']===4010 ? 'カフェプロデュースグループ': null}}
                        {{$rent_user_info['group_id']===4020 ? 'メディア運営・観光サポートグループ': null}}
                        {{$rent_user_info['group_id']===4030 ? 'マーケティング支援グループ': null}}
                        {{$rent_user_info['group_id']===5010 ? '総務・法務グループ': null}}
                        {{$rent_user_info['group_id']===5020 ? '経営企画・情報システムグループ': null}}
                        {{$rent_user_info['group_id']===5030 ? '人事・経理グループ': null}}
                    </div>
                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-3 p-2">メールアドレス</div>
                    <div class="d-block text-left w-75 mx-auto mb-3"><?=$rent_user_info['address']?></div>
                </div>
            </div>
        </form>
    </div>
</div>

<div >
    <a href="#" onclick="window.close(); return false;" class="btn btn-secondary btn-user btn-block col-lg-6">閉じる</a>
</div>

@endsection
