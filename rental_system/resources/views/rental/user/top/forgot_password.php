<!DOCTYPE html>
<html lang="en">

<?php include('common/header.php'); ?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
            <div class="col-lg-6 d-none d-lg-block dflex align-items-baseline">
                <img src="//bootsample/img/surprise.jfif" width=100% height=500>
            </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">パスワードを再発行</h1>
                    <p class="mb-4">入力されたE-emailアドレスに<br/>新しいパスワードを送信します。</p>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="E-emailアドレスを入力">
                    </div>
                    <a href="login.php" class="btn btn-primary btn-user btn-block">
                      パスワードをリセット
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="sign_up.php">アカウントを作成</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="login.php">既にアカウントを持っている</a>
                  </div>
                </div>
                <?php include('common/footer.php'); ?>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <?php include('common/corescript.php'); ?>

</body>

</html>
