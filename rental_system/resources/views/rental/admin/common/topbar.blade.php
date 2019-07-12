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
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">小林 明日香</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    プロフィール
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    設定
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    アクティビティログ
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

