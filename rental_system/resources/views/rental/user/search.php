<!DOCTYPE html>
<html lang="ja">
<!-- header -->
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
          <h1 class="h3 mb-2 text-gray-800">テスト端末</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">検索結果</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <form method="post" id="check">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">


                    <thead>
                      <tr>
                      <th width=40px><input type="checkbox" id="checkAll"></th>
                      <th>端末名/OS</th>
                      <th width=40%>ステータス</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th width=40px><input type="checkbox" id="checkAll"></th>
                      <th>端末名/OS</th>
                      <th width=40%>ステータス</th>
                      </tr>
                    </tfoot>
                    <?php include('common/database.php'); ?>
                      <?php include('common/search_bar.php'); ?>
                      <?php include('common/bundle_bar.php'); ?>
                      <tbody>
                      <tr>
<?php foreach($data_list as $value):?>
<?php

if(preg_match("/{$_POST['id']}/i",$value['id'])
          and preg_match("/{$_POST['name']}/i",$value['name'])
          and preg_match("/{$_POST['os']}/i",$value['os'])
          and preg_match("/{$_POST['lte']}/i",$value['lte'])
          and preg_match("/{$_POST['wifi']}/i",$value['wifi'])
):?>
<?php       if($value['status']==1):?>
        <?php         if($userid===$value['who']){
            $button="<a href=\"/return?id=$value['id']\" class=\"btn btn-danger btn-user btn-block\">返却</a>";
        }else{
            $button="<a href=\"/rent-user\" class=\"btn btn-outline-dark btn-user btn-block\">{$userdata["{$value['who']}"]['name'][0]}{$userdata["{$value['who']}"]['name'][1]}<br>({$value['when']})</a>";
        }
        ?>
<?php       else:?>
<?php
              $button="<a href=\"/rental?id=$value['id']\" class=\"btn btn-primary btn-user btn-block\">貸出</a>";
?>
<?php       endif;?>
                              <td><input type="checkbox" class="js_checkButton" name="check[]" onclick="checkValue(this)" value="<?=$value['id']?>"></td>
                                        <td><a class="text-lg" href="/detail?id=<?=$value['id']?>" ><?=$value['name']?></a>
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
                              </tr>
<?php       endif;?>
<?php endforeach;?>
                    </tbody>
                  </table>

              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

        <!-- Footer -->
      <?php include('common/footer.php'); ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <?php include('common/scrollto.php'); ?>

  <!-- ログアウトポップアップ-->
  <?php include('common/logout.php'); ?>

  <!-- コアスクリプト-->
  <?php include('common/corescript.php'); ?>



</body>

</html>
