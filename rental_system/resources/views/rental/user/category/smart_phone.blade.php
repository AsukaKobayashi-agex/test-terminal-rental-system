@extends('rental.user.common.parent')
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">端末一覧</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="post" id="action">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                    <thead>
                    <tr>
                        <th width=40px><input type="checkbox" id="checkAll"></th>
                        <th>端末名/OS</th>
                        <th width=20%></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th width=40px><input type="checkbox" id="checkAll"></th>
                        <th>端末名/OS</th>
                        <th width=20%></th>
                    </tr>
                    </tfoot>

                    <div name="search_bar">
                        <div class="form-group row">
                            @csrf
                            <form id='search' method="post" action="/">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" name="name" class="form-control form-control-user" value="" placeholder="端末名を入力" >
                                </div>
                                @component('rental.user.common.search_button')
                                @endcomponent
                            </form>
                        </div>
                    </div>
                    @component('rental.user.common.bundle_bar')
                    @endcomponent

                    <?php
                    preDump($all_device_list);
                    $userid = "1";
                    ?>

                    <tbody>
                    @foreach($all_device_list as $value)
                        <tr>
                            <td><input type="checkbox" class="js_checkButton" name="action[]" onclick="checkValue(this)" value="<?=$value['rental_device_id']?>"></td>
                            <td><a href="/detail?id=000<?=$value['test_device_id']?>" ><?=$value['device_name']?></a>
                            </td>
                            <td>
                            @if($value['status']===1)
                                @if($userid==$value['user_id'])
                                    <button type="submit" class="btn btn-danger btn-block" name="action[]" onclick="submitAction('/return')" value="<?=$value['rental_device_id']?>">返却</button>
                                @else
                                        <button type="submit" class="btn btn-outline-dark btn-block" name="user" onclick="submitAction('/rent-user')"><?=$value['name']?><br>(<?=$value['rental_datetime']?>)</button>
                                    @endif

                            @else
                                    <button type="submit" class="btn btn-primary btn-block" name="action[]" onclick="submitAction('/rental')" value="<?=$value['rental_device_id']?>">貸出</button>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

@endsection
