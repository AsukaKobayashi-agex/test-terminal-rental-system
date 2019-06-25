<!DOCTYPE html>
<html lang="ja">


<!--Header-->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>テスト端末管理システム</title>

    <!-- Custom fonts for this template-->
    <link href="/bootsample/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/bootsample/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/bootsample/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laptop"></i>
            </div>
            <div class="sidebar-brand-text text-lg mx-2">テスト端末<br/>貸出システム</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/">
                <i class="fas fa-fw fa-home"></i>
                <span>ホーム</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">


        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item">
            <a class="nav-link" href="/mylist">
                <i class="fas fa-fw fa-list-alt"></i>
                <span>マイリスト</span>
            </a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">

        <div class="sidebar-heading">
            カテゴリ別
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-mobile"></i>
                <span >モバイル</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <form method="get" name="smartphone" action="/mobile">
                        <input type="hidden" name="type" value="1">
                        <a class="collapse-item text-primary" href="javascript:smartphone.submit()">スマホ</a>
                    </form>
                    <form method="get" name="android" action="/mobile">
                        <input type="hidden" name="type" value="1">
                        <input type="hidden" name="os" value="1">
                        <a class="collapse-item text-center" href="javascript:android.submit()">Android</a>
                    </form>
                    <form method="get" name="ios" action="/mobile">
                        <input type="hidden" name="type" value="1">
                        <input type="hidden" name="os" value="2">
                        <a class="collapse-item text-center" href="javascript:ios.submit()">iOS</a>
                    </form>
                    <form method="get" name="tablet" action="/mobile">
                        <input type="hidden" name="type" value="2">
                        <a class="collapse-item text-primary" href="javascript:tablet.submit()">タブレット</a>
                    </form>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/pc">
                <i class="fas fa-fw fa-laptop"></i>
                <span>PC</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/charger">
                <i class="fas fa-fw fa-charging-station"></i>
                <span>充電器</span>
            </a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">


        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-info-circle"></i>
                <span>ヘルプ</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="Q&A.php">Q&A</a>
                    <a class="collapse-item" href="/help/users-guide">利用マニュアル</a>
                    <!--<a class="collapse-item" href="utilities-other.html">問い合わせ</a>-->
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->

                <ul class="navbar-nav ml-auto">
                    <div class="d-flex align-items-center ">
                        <h4 class="text-lg-left text-primary"><?=date('Y/m/d D H:i')?></h4>
                    </div>

                    <div class="topbar-divider d-none d-sm-block"></div>

                <?php
                $username = ["山根","瑞葵"];
                $userid = "1";
                $div="コンサル";
                $group="第２グループ";
                $email="hogehoge@agex.co.jp";
                ?>
                <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$div?><br/><?=$group?></span>
                            <span class="mr-2 d-none d-lg-inline text-gray-900"><?=$username[0]?>&emsp;<?=$username[1]?></span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="/profile">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                プロフィール
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                ログアウト
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

        <!-- Begin Page Content -->
            <div class="container-fluid">

                @section('content')
                @show

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; agex communications 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- ログアウトポップアップ-->
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ログアウトしますか?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">ログアウトすると現在の進行状況は失われます。</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
                <a class="btn btn-primary" href="/login">ログアウト</a>
            </div>
        </div>
    </div>
</div>

<!-- コアスクリプト-->
<!-- Bootstrap core JavaScript-->
<script src="/bootsample/vendor/jquery/jquery.min.js"></script>
<script src="/bootsample/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/bootsample/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/bootsample/js/sb-admin-2.min.js"></script>

<script type="text/javascript">
    function submitAction(url) {
        $('form').attr('action', url);
        $('form').submit();
    }

    $(function(){
    $('.checkbox').click(function(){
        if($('#dataTable :checked').length !== 0){
            $('.bundle').removeAttr('disabled')
        }else{
            $('.bundle').attr('disabled', true)
        }
        if ($('#dataTable :checked').length === $('#dataTable :input').length){
            $('#check_all').prop('checked', 'checked');
        }else{
            $('#check_all').prop('checked', false);
        }
    });

    //全チェックボタン
    $('#check_all').click(function () {
        $('input:checkbox').prop('checked', this.checked);

        if($('#dataTable :checked').length !== 0){
            $('.bundle').removeAttr('disabled')
        }else{
            $('.bundle').attr('disabled', true)
        }

    });});
</script>



</body>

</html>

