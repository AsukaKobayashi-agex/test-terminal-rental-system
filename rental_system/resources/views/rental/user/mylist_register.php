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
          <h1 class="h3 mb-4 text-gray-800">マイリスト登録</h1>
          <!-- Basic Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">登録端末一覧</h6>
            </div>
            <div class="card-body">
              <div >

              <!--登録端末テーブル-->
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="table-layout:fixed;">
                  <?php $cate='rental';
                  include('common/database.php'); ?>
                  <thead>
                    <tr>
                        <th width="40px"></th>
                        <th>端末名/OS</th>
                        <th width="7%">削除</th>
                    </tr>
                  </thead>
                  <tbody>
<?php foreach($data_list as $device):?>
<?php if(isset($_POST['action'])):?>
<?php
    $list_num=array_unique($_POST['action']);
    $button='<button class="btn btn-primary btn-user btn-block js_deleteButton">削除</button>';
?>
<?php foreach($list_num as $id):?>
<?php if($id===$device['id']):?>
  <?php $num=0; $num ++;?>
                    <tr class="layer">
                    <td><?=$num?></td>
                  <td><a class="text-lg" href="/detail?rental_device_id=<?=$device['id']?>" ><?=$device['name']?></a>
                    <?php if($device['lte']===0):?>
                                <i class="fas fa-fw fa-mobile-alt"></i>
                    <?php else:?>
                                <i class="fas fa-fw"></i>
                    <?php endif;?>
                    <?php if($device['wifi']===0):?>
                                <i class="fas fa-fw fa-wifi"></i>
                    <?php endif;?>
                  <br><?=$device['os']?>
                  </td><td><?=$button?></td>
                    </tr>
<?php endif;?>
<?php endforeach;?>
<?php endif;?>
<?php endforeach;?>
                  </tbody>
                </table>


              </div>
                <h6 class="m-0 font-weight-bold text-secondary">登録するマイリストを選択</h6>
                  <form class="user">
                    <div class="form-group row">
                      <form action="#">
                          <input type="text"  class="col-sm-3 form-control mb-3 mb-sm-0" name="a" placeholder="新規マイリスト" autocomplete="off">
                          <select class="col-sm-3 form-control mb-3 mb-sm-0">
                              <option value="1">マイリスト１</option>
                              <option value="2">マイリスト２</option>
                              <option value="3">マイリスト３</option>
                          </select>
                          </form>
                      <div class="col-sm-3 mb-3 mb-sm-0">
                        <a href="#" onclick="window.history.back(); return false;" class="btn btn-secondary btn-block">キャンセル</a>
                      </div>
                      <div class="col-sm-3 mb-3 mb-sm-0">
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#checkModal" Id="fix">
                        確定
                      </button>
                      </div>
                    </div>
                  </form>
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

        <!-- 確認ポップアップ-->
    <?php $check='rental'; include('common/check.php'); ?>

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <?php include('common/scrollto.php'); ?>

  <!-- ログアウトポップアップ-->
  <?php include('common/logout.php'); ?>

  <!-- コアスクリプト-->
  <?php include('common/corescript.php'); ?>



<script type="text/javascript">
  $(".js_deleteButton").click(function(){
    $(this).parents('tr').remove();
    if(!$('.layer').length){
      $("#fix").attr('disabled','disabled')
    }
  });
</script>

</body>

</html>
