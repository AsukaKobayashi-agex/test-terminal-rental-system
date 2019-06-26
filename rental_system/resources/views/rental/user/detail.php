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

        <?php include('common/topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

<?php include('common/database.php'); ?>
<?php foreach($data_list as $value):?>
<?php if($value['id']===$_GET['id']){
  $detail=$value;
    }else{
    $detail = "";
    }
?>
<?php endforeach;?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">端末詳細</h1>
            <!-- 基礎情報-->
              <div class="card border-left-primary shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">基本情報</h6>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col-sm-4 mr-1">
                      <div class="text font-weight-bold text-primary text-uppercase mb-1">端末名</div>
                      <div class="h5 mb-4 font-weight-bold text-gray-800"><?=$detail['name']?></div>
                    </div>
                    <div class="col-sm mr-1">
                      <div class="text font-weight-bold text-primary text-uppercase mb-1">カテゴリ</div>
                      <div class="h5 mb-4 font-weight-bold text-gray-800"><?=$detail['device']?></div>
                    </div>
                    <div class="col-sm mr-1">
                      <div class="text font-weight-bold text-primary text-uppercase mb-1">OS</div>
                      <div class="h5 mb-4 font-weight-bold text-gray-800"><?=$detail['os']?></div>
                    </div>
                    <div class="col-sm mr-1">
                      <div class="text font-weight-bold text-primary text-uppercase mb-1">通信回線</div>
                      <div class="h5 mb-4 font-weight-bold text-gray-800">
                              <?php if($detail['lte']===0):?>
                                  <i class="fas fa-fw fa-mobile-alt"></i>
                              <?php else:?>
                                  <i class="fas fa-fw"></i>
                              <?php endif;?>
                              <?php if($detail['wifi']===0):?>
                                  <i class="fas fa-fw fa-wifi"></i>
                              <?php endif;?>
                      </div>
                    </div>
                    <div class="col-sm mr-1">
                      <div class="text font-weight-bold text-primary text-uppercase mb-1">現在ステータス</div>
<?php       if($detail['status']==1){
         if($userid===$detail['who']){
             $button="<a href=\"/return?id=$detail[id]\" class=\"btn btn-danger btn-user btn-block\">返却可</a>";
              }else{
             $button="<a href=\"/rent-user\" class=\"btn btn-outline-dark btn-user btn-block\">{$userdata["{$value['who']}"]['name'][0]}{$userdata["{$value['who']}"]['name'][1]}<br>({$value['when']})</a>";
              }

       }else{

              $button="<a href=\"/rental?id=$detail[id]\" class=\"btn btn-primary btn-user btn-block\">貸出可</a>";
}?>

                      <div class="h5 mb-4 font-weight-bold text-gray-800"><?=$button?></div>
                    </div>
                  </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-sm-6 mr-1">
                            <div class="text font-weight-bold text-primary text-uppercase mb-1">端末画像</div>
                            <img class="img-profile d-block" src="/bootsample/img/1g.jpg" width=300px height=300px>
                        </div>
                    </div>

                </div>
              </div>
              <div class="card border-left-success shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-success">詳細情報</h6>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col-sm-2 mr-1">
                      <div class="text font-weight-bold text-success text-uppercase mb-1">電話番号</div>
                      <div class="h5 mb-4 font-weight-bold text-gray-800"><?=$detail['電話番号']?></div>
                    </div>
                    <div class="col-sm-4 mr-1">
                      <div class="text font-weight-bold text-success text-uppercase mb-1">メールアドレス</div>
                      <div class="h5 mb-4 font-weight-bold text-gray-800"><?=$detail['mail']?></div>
                    </div>
                    <div class="col-sm-2 mr-1">
                      <div class="text font-weight-bold text-success text-uppercase mb-1">解像度</div>
                      <div class="h5 mb-4 font-weight-bold text-gray-800"><?=$detail['解像度']?>ドット</div>
                    </div>
                    <div class="col-sm-2 mr-1">
                      <div class="text font-weight-bold text-success text-uppercase mb-1">画面サイズ</div>
                      <div class="h5 mb-4 font-weight-bold text-gray-800"><?=$detail['画面サイズ']?>インチ</div>
                    </div>
                    <div class="col-sm-1 mr-1">
                      <div class="text font-weight-bold text-success text-uppercase mb-1">キャリア</div>
                      <div class="h5 mb-4 font-weight-bold text-gray-800"><?=$detail['キャリア']?></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card border-left-warning shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-warning">インストール済みアプリ</h6>
                </div>
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col-sm mr-1">
                      <div class="row h5 font-weight-bold text-gray-800">
                        <div class="col-sm-6 align-items-center" >
<?php
    echo str_replace(',','</div><div class="col-sm-6 align-items-center" >',$detail['アプリ']);
?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
              <a href="#" onclick="window.history.back(); return false;" class="btn btn-secondary btn-user btn-block">戻る</a>
              </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php include('common/footer.php'); ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <?php include('common/scrollto.php'); ?>

  <?php include('common/logout.php'); ?>

  <?php include('common/corescript.php'); ?>

</body>

</html>
