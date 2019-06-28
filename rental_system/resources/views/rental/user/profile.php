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

            <!-- 基礎情報-->
              <div class="card border-left-primary shadow col-lg-5 mb-4">
                <div class="card-header py-3">
                  <h6 class="text-xl-center font-weight-bold text-primary">プロフィール</h6>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-1 p-2">ユーザーネーム</div>
                                    <div class="d-block">
                                        <input class="d-inline form-control col-sm-5" value="<?=$username[0]?>">
                                        <input class="d-inline form-control col-sm-5" value="<?=$username[1]?>">
                                    </div>
                                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-1 p-2">所属</div>
                                    <div class="d-block">
                                        <select class="d-inline col-sm-5 form-control" type="division"  id="division" >
                                            <option value="0">事業部を選択</option>
                                            <option value="1" selected>コンサル</option>
                                            <option value="2">システムソリューション</option>
                                            <option value="3">インバウンド</option>
                                        </select>
                                        <select class="d-inline col-sm-5 form-control" type="group" id="group">
                                            <option value="0">グループを選択</option>
                                            <option value="1">第1グループ</option>
                                            <option value="2" selected>第2グループ</option>
                                            <option value="3">第3グループ</option>
                                        </select>
                                    </div>
                                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-1 p-2">Emailアドレス</div>
                                    <input class="form-control col-sm-5" value="<?=$email?>">
                                    <div class="d-block p-4">
                                        <a href="#" onclick="window.history.back(); return false;" class="btn btn-secondary btn-user ">キャンセル</a>
                                        <input type="submit" class="btn btn-primary btn-user" value="変更">
                                    </div>

                                </div>
                            </div>
                        </form>
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
