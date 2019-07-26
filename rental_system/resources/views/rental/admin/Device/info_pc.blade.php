
@extends('rental.admin.common.include')

@section('content')


        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">PC情報
            <a href="/admin/edit_pc?rental_device_id=<?=$detail['rental_device_id']?>" class="btn btn-info btn-icon-split m-4">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                <span class="text">情報を編集する</span>
            </a></h1>

        <div class="m-0 font-weight-bold text-gray-800">


            <div class="row">
            <div class="col-sm-6 float-left mb-3">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                    <label>端末名</label>
                    </div>
                        <div class="card-body text-center">
                            <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['device_name']?></div>
                        </div>
                    </div>
                </div>


        <div class="col-sm-6 float-left mb-3">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <label>OS</label>
                </div>
            <div class="card-body text-center">
                <div class="h4 mb-2 font-weight-bold text-primary">
                    @if($detail['os']==3)
                        Windows
                    @elseif($detail['os']==4)
                        Mac OS
                    @else
                        その他
                    @endif
                    <?=$detail['os_version']?></div>
                    </div>
                </div>
            </div>
            </div>


            <div class="row">
        <div class="col-sm-6 float-left mb-3">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <label>PCアカウント名</label>
                </div>
            <div class="card-body text-center">
                <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['pc_account_name']?></div>
                </div>
                </div>
            </div>


            <div class="col-sm-6 float-left mb-3">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                    <label>メールアドレス</label>
                    </div>
                        <div class="card-body text-center">
                            <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['mail_address']?></div>
                </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4 w-100">
                <div class="card-header py-2">
                    <label>ソフトウェア</label>
                </div>
                    <div class="card-body text-center">
                        @foreach($installed_software as $software)
                            <ul>
                                <li class="h5 font-weight-bold text-primary d-inline-block" ><?=$software['software_name']?></li>
                                <li class="h6 list-inline-item font-weight-bold text-gray-800 d-inline-block">(<?=date('Y年m月d日',strtotime($software['add_date']))?>)</li>
                            </ul>
                        @endforeach
                    </div>
                </div>

            <div class="card shadow mb-4 w-100">
                <div class="card-header py-2">
                    <label>備考(ユーザー向け)</label>
                </div>
                            <div class="card-body text-center">
                                <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['memo']?></div>
                </div>
                    </div>


            <div class="card shadow mb-4 w-100">
                <div class="card-header py-2">
                    <label>備考(管理者向け)</label>
                </div>
                            <div class="card-body text-center">
                                <div class="h4 mb-2 font-weight-bold text-primary"><?=$detail['admin_memo']?></div>
                </div>
                    </div>

            <label>端末画像</label>
            <div class="card-body">
                @if($detail['device_img']===1)
                    <img class="rounded w-50 h-50" src="bootsample/img/device_image_{{$detail['rental_device_id']}}.jpg" alt="device_image">
                @else
                    <img class="rounded w-50 h-50" src="/bootsample/img/noImage.png" alt="no_image">
                @endif
            </div>
        </div>




    <div class="col-sm-12">
        <a href="#" onclick="window.close(); return false;" class="btn btn-secondary btn-user btn-block">閉じる</a>
    </div>

@endsection
