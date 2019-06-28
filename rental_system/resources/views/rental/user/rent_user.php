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
                                <div class="col-lg-12 pb-lg-5">
                                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-1 p-2">ユーザーネーム</div>
                                    <div class="d-block text-center">
                                        <?=$username[0]?>&emsp;&emsp;
                                        <?=$username[1]?>
                                    </div>
                                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-1 p-2">所属</div>
                                    <div class="d-block text-center">
                                            コンサルティング &emsp; 第2グループ
                                    </div>
                                    <div class="d-block text font-weight-bold text-primary text-uppercase mb-1 p-2">Emailアドレス</div>
                                    <div class="d-block text-center">
                                        <?=$email?>
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
