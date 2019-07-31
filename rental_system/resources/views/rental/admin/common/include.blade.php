<!DOCTYPE html>
<html lang="ja">

@include('rental.admin.common.header')

<body id="page-top" class="{{$_COOKIE['sideOpen'] ? 'sidebar-toggled':null}}">

<!-- Page Wrapper -->
<div id="wrapper">

    @include('rental.admin.common.sidebar')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            @include('rental.admin.common.topbar')

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

            @section('content')
                @show
            </div>

            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        @include('rental.admin.common.footer')
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

@include('rental.admin.common.core_script')

</body>

</html>

