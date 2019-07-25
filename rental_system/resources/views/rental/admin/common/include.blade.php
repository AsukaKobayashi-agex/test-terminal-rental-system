<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')[管理者]テスト端末貸出システム</title>


    <!-- Custom fonts for this template -->
    <link href="/bootsample/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/bootsample/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/css/admin/admin_base.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/bootsample/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



</head>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_all">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">管理者画面</div>
        </a>

        <hr class="sidebar-divider">


        <!-- Nav Item - Tables -->
        <li {!! (Request::is('admin/index_all') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
            <a class="nav-link" href="index_all">
                <i class="fas fa-fw fa-table"></i>
                <span>端末一覧</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">



        <div class="sidebar-heading">
            カテゴリ別
        </div>

        <li  {!! (Request::is('admin/index_sp') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-mobile"></i>
                <span >モバイル</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <form method="get" name="ios" action="index_sp">
                        <a class="collapse-item text-primary" href="index_sp">モバイル</a>
                    </form>
                    <form method="get" name="smartphone" action="index_sp">
                        <input type="hidden" name="type" value="1">
                        <a class="collapse-item text-center" href="javascript:smartphone.submit()">スマホ</a>
                    </form>
                    <form method="get" name="tablet" action="index_sp">
                        <input type="hidden" name="type" value="2">
                        <a class="collapse-item text-center" href="javascript:tablet.submit()">タブレット</a>
                    </form>
                </div>
            </div>
        </li>

        <li  {!! (Request::is('admin/index_pc') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
            <a class="nav-link" href="index_pc">
                <i class="fas fa-fw fa-laptop"></i>
                <span>PC</span>
            </a>
        </li>
        <li  {!! (Request::is('admin/index_charger') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
            <a class="nav-link" href="index_charger">
                <i class="fas fa-fw fa-charging-station"></i>
                <span>充電器</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <!--<div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>-->

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

                <h5 class="text-primary" id="RealtimeClockArea2"></h5>
                <script>
                    function set2fig(num){
                        var ret;
                        if( num < 10 ){ ret = "0" + num; }
                        else { ret = num; }
                        return ret;
                    }
                    function showClock2() {
                        var nowTime = new Date();
                        var nowYear = set2fig( nowTime.getFullYear() );
                        var nowMonth = set2fig( nowTime.getMonth() );
                        var nowDate = set2fig( nowTime.getDate() );
                        var nowHour = set2fig( nowTime.getHours() );
                        var nowMin = set2fig( nowTime.getMinutes() );
                        var msg = nowYear + "年" + nowMonth + "月" + nowDate + "日" + nowHour + "時" + nowMin + "分";
                        document.getElementById("RealtimeClockArea2").innerHTML = msg;
                    }
                    setInterval('showClock2()',1000);
                </script>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">





                    <!-- Nav Item - User Information -->
                    @if(\Auth::guard('admin')->check())
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 text-gray-900">{{$admin_info['name']}}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    ログアウト
                                </a>
                            </div>
                        </li>
                    @else
                        <a class="nav-link" href="/login">
                            <span class="mr-2 text-gray-900">ログイン</span>
                        </a>
                    @endif

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
                    <span>Copyright &copy; Your Website 2019</span>
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


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ログアウトしようとしています</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">このままログアウトしますか？</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">いいえ</button>
                <a class="btn btn-primary" href="/admin/logout">はい</a>
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

@stack('scripts')

</body>

</html>

