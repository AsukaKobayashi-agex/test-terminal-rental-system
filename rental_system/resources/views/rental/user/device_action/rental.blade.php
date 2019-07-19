@extends('rental.user.common.user_base')
@section('content')
<!-- Page Heading -->
@php
    //preDump($_POST['search_word']);
@endphp

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">デバイス貸出</h6>
    </div>
    <div class="card-body">
        @if(count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div>
            <form method="post" name="rental_device" id="rental_device" action="/rental/rental">
                @csrf
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                <thead>
                    <tr>
                        <th width=40px class="align-middle text-center">
                        </th>
                        <th>端末名</th>
                        <th width=40%></th>
                    </tr>
                </thead>

                <tbody>
                <tr class="font-weight-bold" id="noDevice" hidden>
                    <td class="align-middle"></td>
                    <td class="align-middle">貸出可能な端末はありません</td>
                    <td class="align-middle"></td>
                </tr>

                @foreach($rental_device_list as $device)
                    <tr  class="font-weight-bold {{$device['status']!==0 ? 'table-active':null}}">
                        <td class="text-center align-middle px-1">
                            <div class="text-lg-center font-weight-bold">
                                @if(!isset($i))
                                @php($i = 1)
                                @else
                                @php($i++)
                                @endif
                                <?=$i?>
                            </div>
                            @if($device['status']===0)
                                <input type="hidden" form="rental_device" name="rental_device_id[]" value="<?=$device['rental_device_id']?>">
                            @endif
                        </td>
                        <td class="align-middle">
                        @if($device['device_category']===1)
                            @if($device['test_device_category']===1)
                                    <a class="text-lg text-primary" target="_blank" href="/detail-mobile?rental_device_id=<?=$device['rental_device_id']?>" >
                                        <?=$device['device_name']?>
                                    </a>
                            @elseif($device['test_device_category']===2)
                                    <a class="text-lg text-success" target="_blank" href="/detail-pc?rental_device_id=<?=$device['rental_device_id']?>" >
                                        <?=$device['device_name']?>
                                    </a>
                            @endif
                        @elseif($device['device_category']===2)
                                <a class="text-lg text-warning" target="_blank" href="/detail-charger?rental_device_id=<?=$device['rental_device_id']?>" >
                                    <?=$device['charger_name']?>
                                </a>
                        @endif
                            @if($device['status']!==0)
                                <span class="text-danger">※貸出できません</span>
                            @endif
                        </td>
                        <td class="align-middle">
                            <button class="btn btn-primary btn-user btn-block deleteButton">削除</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </form>
        </div>
        <div class="d-flex d-inline justify-content-end">
            <div class="col-sm-3 mb-3 mb-sm-0">
                <a href="#" onclick="window.history.back(); return false;" class="btn btn-secondary btn-block">キャンセル</a>
            </div>
            <div class="col-sm-3 mb-3 mb-sm-0">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#checkModal" Id="agree">
                    確定
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Check Modal-->
<div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">貸出確認</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">選択したデバイスの貸出を確定しますか？</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
                <a class="btn btn-primary" href="javascript:document.rental_device.submit()">はい</a>
            </div>
        </div>
    </div>
</div>


@endsection
