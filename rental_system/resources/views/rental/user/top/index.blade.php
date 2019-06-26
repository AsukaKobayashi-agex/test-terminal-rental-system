@extends('rental.user.common.user_base')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">レンタル品一覧</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                    <thead>
                    <tr>
                        <th width=40px><input type="checkbox" id="check_all"></th>
                        <th>端末名/OS</th>
                        <th width=20%></th>
                    </tr>
                    </thead>

                    <div id="search_bar">
                        @if(count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <form id='search' method="post" action="#">
                                @csrf
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <input type="search" name="search_word" class="form-control form-control-user" value="" placeholder="端末名を入力" >
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-fw fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @component('rental.user.common.bundle_bar')
                    @endcomponent

                    <?php
                    //preDump($all_device_list);
                    $userid = "1";
                    ?>

                    <tbody>
                    @foreach($all_device_list as $value)
                        <tr>
                            <td><input type="checkbox" form="action" class="checkbox" name="action[]" value="<?=$value['rental_device_id']?>"></td>
                            <td>
                                <a href="/detail?id=<?=$value['rental_device_id']?>" >
                                    @if($value['device_category']==1)
                                        <?=$value['device_name']?>
                                    @elseif($value['device_category']== 2)
                                        <?=$value['charger_name']?>
                                    @endif
                                </a>
                            </td>
                            <td>
                            @if($value['status']===1)
                                @if($userid==$value['user_id'])
                                    <form name='return' method="post" action="/return">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-block" name="action[]"  value="<?=$value['rental_device_id']?>">返却</button>
                                    </form>
                                @else
                                    <form name='rent-user' method="post" action="/rent-user">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-dark btn-block" name="user_id"  value="<?=$value['user_id']?>"><?=$value['name']?><br>(<?=$value['rental_datetime']?>)</button>
                                    </form>
                                @endif

                            @else
                                <form name='rental' method="post" action="/rental">
                                    @csrf
                                    <button type="submit" form="action" class="btn btn-primary btn-block" name="action[]"  value="<?=$value['rental_device_id']?>">貸出</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection
