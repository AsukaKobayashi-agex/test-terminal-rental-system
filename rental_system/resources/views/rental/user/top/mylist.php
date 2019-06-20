<!DOCTYPE html>
<html lang="ja">

<?php include('common/header.php'); ?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include('common/sidebar.php'); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Top Bar -->
        <?php include('common/topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">マイリスト一覧</h1>
          <!-- Basic Card Example -->

            <div id="bundle_bar">
                <div class="form-group row">
                    <div class="col-sm-8 mb-3 mb-sm-0">
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                        <button type="button" class="btn btn-primary btn-user btn-block bundle" form="check" disabled="disabled" onclick="submitAction('bundle_rental.php')">一括貸出</button>
                    </div>
                    <div class="col-sm-2 mb-3 mb-sm-0">
                        <button type="button" class="btn btn-danger btn-user btn-block bundle" form="check" disabled="disabled" onclick="submitAction('bundle_return.php')">一括返却</button>
                    </div>
                </div>
            </div>

            <form method="post" id="check">
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">プロジェクト①</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <!--登録端末テーブル-->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                  <?php include('common/database.php'); ?>
                  <thead>
                    <tr>
                     <th width="40px"><input type="checkbox" id="checkAll1"></th>
                    <th>端末名/OS</th>
                    <th width="20%">ステータス</th>
                    <th width="7%">削除</th>
                    </tr>
                  </thead>
                  <tbody>
<?php foreach($data_list as $value):?>
<?php $list_num=['0001','0005','0009','1001'];?>
<?php       if($value['status']==1):?>
        <?php         if($userid===$value['who']){
            $button="<a href=\"/return?id=$value[id]\" class=\"btn btn-danger btn-user btn-block\">返却</a>";
        }else{
            $button="<a href=\"/rent-user\" class=\"btn btn-outline-dark btn-user btn-block\">{$userdata["{$value['who']}"]['name'][0]}{$userdata["{$value['who']}"]['name'][1]}<br>({$value['when']})</a>";
        }
        ?>
<?php       else:?>
    <?php
    $button="<a href=\"/rental?id=$value[id]\" class=\"btn btn-primary btn-user btn-block\">貸出</a>";
    ?>
<?php       endif;?>
<?php foreach($list_num as $id):?>
<?php if($id===$value['id']):?>
                    <tr class="layer">
                    <td><input type="checkbox" class="check1" name="check[]" onclick="checkValue(this)" value="<?=$value['id']?>"></td>
                              <td><a href="/detail?id=<?=$value['id']?>" ><?=$value['name']?></a>
                                <?php if($value['lte']===0):?>
                                            <i class="fas fa-fw fa-mobile-alt"></i>
                                <?php else:?>
                                            <i class="fas fa-fw"></i>
                                <?php endif;?>
                                <?php if($value['wifi']===0):?>
                                            <i class="fas fa-fw fa-wifi"></i>
                                <?php endif;?>
                              <br><?=$value['os']?>
                              </td><td><?=$button?></td>
                    <td><button class="btn btn-primary btn-user btn-block js_deleteButton">削除</button></td>
                    </tr>
<?php endif;?>
<?php endforeach;?>
<?php endforeach;?>
                  </tbody>
                </table>


          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">プロジェクト②</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <!--登録端末テーブル-->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                  <?php include('common/database.php'); ?>
                  <thead>
                    <tr>
                     <th width="40px"><input type="checkbox" id="checkAll2"></th>
                    <th>端末名/OS</th>
                    <th width="20%">ステータス</th>
                    <th width="7%">削除</th>
                    </tr>
                  </thead>
                  <tbody>
<?php foreach($data_list as $value):?>
<?php $list_num=['0001','0005','0009','1001'];?>
<?php       if($value['status']==1):?>
        <?php         if($userid===$value['who']){
            $button="<a href=\"/return?id=$value[id]\" class=\"btn btn-danger btn-user btn-block\">返却</a>";
        }else{
            $button="<a href=\"/rent-user\" class=\"btn btn-outline-dark btn-user btn-block\">{$userdata["{$value['who']}"]['name'][0]}{$userdata["{$value['who']}"]['name'][1]}<br>({$value['when']})</a>";
        }
        ?>
<?php       else:?>
    <?php
    $button="<a href=\"/rental?id=$value[id]\" class=\"btn btn-primary btn-user btn-block\">貸出</a>";
    ?>
<?php       endif;?>
<?php foreach($list_num as $id):?>
<?php if($id===$value['id']):?>
                    <tr class="layer">
                    <td><input type="checkbox" class="check2" name="check[]" onclick="checkValue(this)" value="<?=$value['id']?>"></td>
                              <td><a href="/detail?id=<?=$value['id']?>" ><?=$value['name']?></a>
                                <?php if($value['lte']===0):?>
                                            <i class="fas fa-fw fa-mobile-alt"></i>
                                <?php else:?>
                                            <i class="fas fa-fw"></i>
                                <?php endif;?>
                                <?php if($value['wifi']===0):?>
                                            <i class="fas fa-fw fa-wifi"></i>
                                <?php endif;?>
                              <br><?=$value['os']?>
                              </td><td><?=$button?></td>
                    <td><button class="btn btn-primary btn-user btn-block js_deleteButton">削除</button></td>
                    </tr>
<?php endif;?>
<?php endforeach;?>
<?php endforeach;?>
                  </tbody>
                </table>


          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">プロジェクト③</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <!--登録端末テーブル-->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                  <?php include('common/database.php'); ?>
                  <thead>
                    <tr>
                     <th width="40px"><input type="checkbox" id="checkAll3"></th>
                    <th>端末名/OS</th>
                    <th width="20%">ステータス</th>
                    <th width="7%">削除</th>
                    </tr>
                  </thead>
                  <tbody>
<?php foreach($data_list as $value):?>
<?php $list_num=['0001','0005','0009','1001'];?>
<?php       if($value['status']==1):?>
        <?php         if($userid===$value['who']){
            $button="<a href=\"/return?id=$value[id]\" class=\"btn btn-danger btn-user btn-block\">返却</a>";
        }else{
            $button="<a href=\"/rent-user\" class=\"btn btn-outline-dark btn-user btn-block\">{$userdata["{$value['who']}"]['name'][0]}{$userdata["{$value['who']}"]['name'][1]}<br>({$value['when']})</a>";
        }
        ?>
<?php       else:?>
    <?php
    $button="<a href=\"/rental?id=$value[id]\" class=\"btn btn-primary btn-user btn-block\">貸出</a>";
    ?>
<?php       endif;?>
<?php foreach($list_num as $id):?>
<?php if($id===$value['id']):?>
                    <tr class="layer">
                    <td><input type="checkbox" class="check3" name="check[]" onclick="checkValue(this)" value="<?=$value['id']?>"></td>
                              <td><a href="/detail?id=<?=$value['id']?>" ><?=$value['name']?></a>
                                <?php if($value['lte']===0):?>
                                            <i class="fas fa-fw fa-mobile-alt"></i>
                                <?php else:?>
                                            <i class="fas fa-fw"></i>
                                <?php endif;?>
                                <?php if($value['wifi']===0):?>
                                            <i class="fas fa-fw fa-wifi"></i>
                                <?php endif;?>
                              <br><?=$value['os']?>
                              </td><td><?=$button?></td>
                    <td><button class="btn btn-primary btn-user btn-block js_deleteButton">削除</button></td>
                    </tr>
<?php endif;?>
<?php endforeach;?>
<?php endforeach;?>
                  </tbody>
                </table>


          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
            </form>
      <!-- End of Main Content -->

        <!-- Footer -->
      <?php include('common/footer.php'); ?>

    </div>
    <!-- End of Content Wrapper -->

        <!-- 確認ポップアップ-->
    <?php $check='rental'; include('common/check.php'); ?>

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <?php include('common/scrollto.php'); ?>

  <!-- ログアウトポップアップ-->
  <?php include('common/logout.php'); ?>

  <!-- コアスクリプト-->
  <?php include('common/Corescript.php'); ?>



<script type="text/javascript">
  $(".js_deleteButton").click(function(){
    $(this).parents('tr').remove();
    if(!$('.layer').length){
      $("#fix").attr('disabled','disabled')
    }
  });
  $('#checkAll1').click(function () {
      $('input.check1').prop('checked', this.checked);
      $('.bundle').removeAttr('disabled')

  });
  $('#checkAll2').click(function () {
      $('input.check2').prop('checked', this.checked);
      $('.bundle').removeAttr('disabled')

  });
  $('#checkAll3').click(function () {
      $('input.check3').prop('checked', this.checked);
      $('.bundle').removeAttr('disabled')

  });

</script>

</body>

</html>
