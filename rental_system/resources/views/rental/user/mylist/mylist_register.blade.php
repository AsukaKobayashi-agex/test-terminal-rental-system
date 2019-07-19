@extends('rental.user.common.user_base')
@section('content')
<!-- Page Heading -->
@php
    //preDump($_POST['search_word']);

@endphp

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">マイリスト登録</h6>
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
                    <td class="align-middle">選択されている端末はありません</td>
                    <td class="align-middle"></td>
                </tr>

                @foreach($register_device_list as $device)
                    <tr  class="font-weight-bold">
                        <td class="text-center align-middle px-1">
                            <div class="text-lg-center text-dark font-weight-bold">
                                @if(!isset($i))
                                @php($i = 1)
                                @else
                                @php($i++)
                                @endif
                                <?=$i?>
                            </div>
                            <input type="hidden" form="register_device" name="rental_device_id[]" value="<?=$device['rental_device_id']?>">
                        </td>
                        @if($device['device_category']===1)
                            @if($device['test_device_category']===1)
                                <td class="align-middle">
                                    <a class="text-lg text-primary" target="_blank" href="/detail-mobile?rental_device_id=<?=$device['rental_device_id']?>" >
                                        <?=$device['device_name']?>
                                    </a>
                                </td>
                            @elseif($device['test_device_category']===2)
                                <td class="align-middle">
                                    <a class="text-lg text-success" target="_blank" href="/detail-pc?rental_device_id=<?=$device['rental_device_id']?>" >
                                        <?=$device['device_name']?>
                                    </a>
                                </td>
                            @endif
                        @elseif($device['device_category']===2)
                            <td class="align-middle">
                                <a class="text-lg text-warning" target="_blank" href="/detail-charger?rental_device_id=<?=$device['rental_device_id']?>" >
                                    <?=$device['charger_name']?>
                                </a>
                            </td>
                        @endif
                        <td class="align-middle">
                            <button class="btn btn-primary btn-user btn-block deleteButton">削除</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <h6 class="m-0 font-weight-bold text-secondary">登録するマイリストを選択</h6>
        <div class="d-flex d-inline">
            <form class="col-sm-6 d-flex d-inline" method="post" name="register_device" id="register_device" action="/mylist-register/register" onsubmit="return false;">
                @csrf
                <div class="form-group col-sm-6">
                    <select class="form-control mb-3 mb-sm-0" id="mylist" name="mylist_id" >
                        @foreach($all_mylist as $mylist)
                            <option value="<?=$mylist['mylist_id']?>" {{old('mylist_id')===$mylist['mylist_id'] ? 'selected' : null}}><?=$mylist['mylist_name']?></option>
                        @endforeach
                            <option value="new" {{old('mylist_id')==="new" ? 'selected' : null}}>新規作成</option>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" id="newMylist"  class="form-control mb-3 mb-sm-0 {{$errors->has('mylist_name')? 'alert-danger':null}}" name="mylist_name" value="{{ old('mylist_name') }}" placeholder="新規マイリスト名" autocomplete="off" disabled="disabled" required>
                </div>
            </form>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <a href="#" onclick="window.history.back(); return false;" class="btn btn-secondary btn-block">キャンセル</a>
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <button type="submit" class="btn btn-success btn-block" data-toggle="modal" data-target="#checkModal" Id="agree">
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
                <h5 class="modal-title" id="exampleModalLabel">マイリストに登録</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">選択したデバイスをマイリストに登録します。</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
                <a class="btn btn-success" href="javascript:document.register_device.submit()">はい</a>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
    <script>
        $(".deleteButton").click(function(){
            $(this).parents('tr').remove();
            if($('tbody tr').length === 1) {
                $("#noDevice").removeAttr('hidden');
                $("#agree").attr('disabled', 'disabled')
            }
        });


        $('#newMylist').ready(function(){
                var mylist = $('#mylist').val();
                if(mylist === "new"){
                    $('#newMylist').removeAttr("disabled");
                }
        });

       $(function(){
            var selectMylist = $('#mylist');
            var inputName = $('#newMylist');


            $(selectMylist).change(function(){
                var mylist = $(this).val();
                if(mylist === "new"){
                    $(inputName).removeAttr("disabled");
                }else{
                    $(inputName).attr("disabled","disabled").val("");
                }
            });
        });

        $("#agree").ready(function(){
            if($('tbody input').length === 0) {
                $("#noDevice").removeAttr('hidden');
                $("#agree").attr('disabled', 'disabled')
            }
        });

    </script>
@endpush
