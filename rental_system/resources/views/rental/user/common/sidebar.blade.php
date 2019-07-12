<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center p-2" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laptop"></i>
        </div>
        <div class="sidebar-brand-text text-lg mx-2">テスト端末<br/>貸出システム</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li {!! (Request::is('/') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-home"></i>
            <span>ホーム</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->

    <li {!! (Request::is('mylist') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
        <a class="nav-link" href="/mylist">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>マイリスト</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        カテゴリ別
    </div>

    <li  {!! (Request::is('mobile') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
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

    <li  {!! (Request::is('pc') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
        <a class="nav-link" href="/pc">
            <i class="fas fa-fw fa-laptop"></i>
            <span>PC</span>
        </a>
    </li>
    <li  {!! (Request::is('charger') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
        <a class="nav-link" href="/charger">
            <i class="fas fa-fw fa-charging-station"></i>
            <span>充電器</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">


    <!-- Nav Item - Utilities Collapse Menu -->
    <li  {!! (Request::is('help') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>ヘルプ</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!--<a class="collapse-item" href="Q&A.php">Q&A</a>-->
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
