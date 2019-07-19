@extends('rental.user.common.user_base')
@section('content')
<!-- Page Heading -->
{{--}}@php(var_dump($user_info))--}}
<!-- DataTales Example -->
<div class="card border-left-primary shadow col-lg-5 mb-4">
    <div class="card-header py-3">
        <h6 class="text-xl-center font-weight-bold text-primary">プロフィール</h6>
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
                <div class="col-lg-12 mb-4">
                    <input type="hidden" name="user_id" value="<?=$user_info['user_id']?>">
                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-1 p-2">ユーザーネーム</div>
                    <input type="text" class="form-control {{$errors->has('name')? 'alert-danger':null}}" name="name" value="<?=$user_info['name']?>" placeholder="氏名">
                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-1 p-2">所属</div>
                    <select name="division_id" id="division" class="form-control mb-2" >
                        <option value="10" {{$user_info['division_id']===10 ? 'selected': null}}>コンサルティング</option>
                        <option value="20" {{$user_info['division_id']===20 ? 'selected': null}}>システムソリューション</option>
                        <option value="30" {{$user_info['division_id']===30 ? 'selected': null}}>クリエイティブ</option>
                        <option value="40" {{$user_info['division_id']===40 ? 'selected': null}}>Sharing Kyoto</option>
                        <option value="50" {{$user_info['division_id']===50 ? 'selected': null}}>経営本部</option>
                        <option value="0" {{$user_info['division_id']===0 ? 'selected': null}}>所属なし</option>
                    </select>
                    <select name="group_id" id="group" class="form-control" >
                        <option value="">グループを選択</option>
                        <option class="con" value="1010" {{$user_info['group_id']==1010 ? 'selected': null}} hidden>第1グループ</option>
                        <option class="con" value="1020" {{$user_info['group_id']===1020 ? 'selected': null}} hidden>第2グループ</option>
                        <option class="con" value="1030" {{$user_info['group_id']===1030 ? 'selected': null}} hidden>事業企画グループ</option>
                        <option class="ss" value="2010" {{$user_info['group_id']===2010 ? 'selected': null}} hidden>第1ソリューショングループ</option>
                        <option class="ss" value="2020" {{$user_info['group_id']===2020 ? 'selected': null}} hidden>第2ソリューショングループ</option>
                        <option class="ss" value="2030" {{$user_info['group_id']===2030 ? 'selected': null}} hidden>事業運営グループ</option>
                        <option class="cre" value="3010" {{$user_info['group_id']===3010 ? 'selected': null}} hidden>クリエイティブグループ</option>
                        <option class="sk" value="4010" {{$user_info['group_id']===4010 ? 'selected': null}} hidden>カフェプロデュースグループ</option>
                        <option class="sk" value="4020" {{$user_info['group_id']===4020 ? 'selected': null}} hidden>メディア運営・観光サポートグループ</option>
                        <option class="sk" value="4030" {{$user_info['group_id']===4030 ? 'selected': null}} hidden>マーケティング支援グループ</option>
                        <option class="mng" value="5010" {{$user_info['group_id']===5010 ? 'selected': null}} hidden>総務・法務グループ</option>
                        <option class="mng" value="5020" {{$user_info['group_id']===5020 ? 'selected': null}} hidden>経営企画・情報システムグループ</option>
                        <option class="mng" value="5030" {{$user_info['group_id']===5030 ? 'selected': null}} hidden>人事・経理グループ</option>
                        <option value="0" {{$user_info['group_id']==0 ? 'selected': null}}>所属なし</option>
                    </select>
                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-1 p-2">メールアドレス</div>
                    <div class="d-block text-center mb-2">
                        <input type="email" name="address" class="form-control {{$errors->has('address')? 'alert-danger':null}}" value="<?=$user_info['address']?>
                            " placeholder="メールアドレス">
                    </div>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-end">
            <a href="/" class="btn btn-secondary btn-user px-4 mx-2">キャンセル</a>
            <button class="btn btn-primary w-50" data-toggle="modal" data-target="#checkModal"s>
                確定
            </button>
        </div>
    </div>
</div>

<!-- Check Modal-->
<div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">変更確認</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">プロフィールを変更しますか？</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
                <a class="btn btn-primary" href="javascript:document.change_profile.submit()">はい</a>
            </div>
        </div>
    </div>
</div>

@endsection
