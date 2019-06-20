@extends('rental.user.top.common.parent')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">テスト端末</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">端末一覧</h6>
    </div>
    <?php
    preDump($all_device_list);
    ?>
    <div class="card-body">
        <div class="table-responsive">
            <form method="post" id="check">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                    <thead>
                    <tr>
                        <th width=40px><input type="checkbox" id="checkAll"></th>
                        <th>端末名/OS</th>
                        <th width=20%>ボタン</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th width=40px><input type="checkbox" id="checkAll"></th>
                        <th>端末名/OS</th>
                        <th width=20%>ボタン</th>
                    </tr>
                    </tfoot>

                    @include('rental.user.top.common.database')
                    @include('rental.user.top.common.user_database')
                    @include('rental.user.top.common.search_bar')
                    @include('rental.user.top.common.bundle_bar')
                    <?php
                    $username = ["山根","瑞葵"];
                    $userid = "1";
                    $div="コンサル";
                    $group="第２グループ";
                    $email="hogehoge@agex.co.jp";
                    ?>

                    <tbody>
                    <?php foreach($all_device_list as $value):?>
                        <?php       if($value['status']===1):?>
                            <?php         if($userid==$value['user_id']){
                                $button="<a href=\"/return?id=000{$value['test_device_id']}\" class=\"btn btn-danger btn-user btn-block\">返却</a>";
                            }else{
                                $button="<a href=\"/rent-user\" class=\"btn btn-outline-dark btn-user btn-block\">山根瑞葵<br>({$value['rental_datetime']})</a>";
                            }
                            ?>
                        <?php       else:?>
                            <?php
                            $button="<a href=\"/rental?id=000{$value['test_device_id']}\" class=\"btn btn-primary btn-user btn-block\">貸出</a>";
                            ?>
                        <?php       endif;?>
                        <tr>
                            <td><input type="checkbox" class="js_checkButton" name="check[]" onclick="checkValue(this)" value="<?=$value['rental_device_id']?>"></td>
                            <td><a href="/detail?id=000<?=$value['test_device_id']?>" ><?=$value['device_name']?></a>
                                <?php //if($value['lte']===0):?>
                                <i class="fas fa-fw fa-mobile-alt"></i>
                                <?php //else:?>
                                <!--  <i class="fas fa-fw"></i>-->
                                <?php //endif;?>
                                <?php //if($value['wifi']===0):?>
                                <i class="fas fa-fw fa-wifi"></i>
                                <?php //endif;?>
                                <br><?=$value['os']?>,<?=$value['os_version']?>
                            </td>
                            <td><?=$button?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

@endsection
