<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion {{isset($_COOKIE['sideOpen']) && $_COOKIE['sideOpen'] ? 'toggled':null}}" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/index_all">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">管理者画面</div>
    </a>

    <hr class="sidebar-divider">


    <!-- Nav Item - Tables -->
    <li {!! (Request::is('admin/index_all') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
        <a class="nav-link" href="/admin/index_all">
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
                <form method="get" name="ios" action="/admin/index_sp">
                    <a class="collapse-item text-primary" href="/admin/index_sp">モバイル</a>
                </form>
                <form method="get" name="smartphone" action="/admin/index_sp">
                    <input type="hidden" name="type" value="1">
                    <a class="collapse-item text-center" href="javascript:smartphone.submit()">スマホ</a>
                </form>
                <form method="get" name="tablet" action="/admin/index_sp">
                    <input type="hidden" name="type" value="2">
                    <a class="collapse-item text-center" href="javascript:tablet.submit()">タブレット</a>
                </form>
            </div>
        </div>
    </li>

    <li  {!! (Request::is('admin/index_pc') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
        <a class="nav-link" href="/admin/index_pc">
            <i class="fas fa-fw fa-laptop"></i>
            <span>PC</span>
        </a>
    </li>
    <li  {!! (Request::is('admin/index_charger') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
        <a class="nav-link" href="/admin/index_charger">
            <i class="fas fa-fw fa-charging-station"></i>
            <span>充電器</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li  {!! (Request::is('admin/master') ? 'class="nav-item active"' : 'class="nav-item"') !!}>
        <a class="nav-link" href="/admin/master">
            <i class="fas fa-fw fa-list"></i>
            <span>マスター管理</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
