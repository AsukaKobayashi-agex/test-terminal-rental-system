<!DOCTYPE html>
<html lang="en">

<?php include('common/header.php');?>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block d-flex align-items-baseline">
                <img src="/bootsample/img/laptop.jfif" width=100% height=605px>
            </div>
          <div class="col-lg-6">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">アカウントを作成</h1>
              </div>
              <form class="user">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="姓">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="名">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="E-mail アドレス">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <select class="form-control" type="division"  id="division" >
                  <option value="0"selected>事業部を選択</option>
                  <option value="1">コンサル</option>
                  <option value="2">システムソリューション</option>
                  <option value="3">インバウンド</option>
                </select>
                  </div>
                  <div class="col-sm-6">
                  <select class="form-control" type="group" id="group">
                  <option value="0"selected>グループを選択</option>
                  <option value="1">第1グループ</option>
                  <option value="2">第2グループ</option>
                  <option value="3">第3グループ</option>
                  </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="パスワード">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="パスワードを再入力">
                  </div>
                </div>
                <a href="/login" class="btn btn-primary btn-user btn-block">
                  登録
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="/login">既にアカウントを持っている</a>
              </div>
            </div>
            <?php include('common/footer.php');?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?php include('common/corescript.php');?>


</body>

</html>
