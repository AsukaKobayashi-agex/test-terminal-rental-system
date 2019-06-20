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
    include('user_database.php');
   $username = ["{$userdata[0]['name'][0]}","{$userdata[0]['name'][1]}"];
   $userid = "{$userdata[0]['id']}";
   $div="{$userdata[0]['div']}";
   $group="{$userdata[0]['group']}";
   $email="{$userdata[0]['email']}";
?>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo "{$div}<br/>{$group}"; ?></span>
                <span class="mr-2 d-none d-lg-inline text-gray-900"><?php echo "{$username[0]}","&emsp;","{$username[1]}"; ?></span>
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
