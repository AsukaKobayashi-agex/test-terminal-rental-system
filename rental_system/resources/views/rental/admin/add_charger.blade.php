

@extends('rental.admin.common.include')

@section('content')

    <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- basic modal -->
                <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">中断</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>情報の登録を中断しますか？<br></h4>
                                <p>（内容は保存されません）</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                                <a href="edit.blade.php" button type="button" class="btn btn-primary">はい</button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- basic modal -->
                <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">保存</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>記入した情報を登録しますか？<br></h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
                                <a href="edit.blade.php" button type="button" class="btn btn-primary">はい</button></a>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">充電器を登録する</h1>
                    <p class="mb-4"></p>

                    <p class="mb-4">
                        登録する充電器の情報を記入してください。

                    <div class="m-0 font-weight-bold text-primary">

                        <form method="post" action="action/charger.blade.php">
                            <div class="form-group">
                                <label>充電器名</label>
                                <input type="text" class="form-control" name="charger_name">
                            </div>

                            <div class="form-group">
                                <label>充電器タイプ</label>
                                <input type="text" class="form-control" name="charger_type">
                            </div>

                        </form>
                    </div>
                </div>
                <div class="row center-block text-center">
                    <div class="col-1">
                    </div>
                    <div class="col-5">
                        <button type="button" data-toggle="modal" data-target="#basicModal" class="btn btn-outline-secondary btn-block">中断</button>
                    </div>
                    <div class="col-5">
                        <button type="button" data-toggle="modal" data-target="#saveModal" class="btn btn-outline-primary btn-block">保存</button>
                    </div>
                </div>
            </div>







            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>



            <!-- Page level custom scripts -->
            <script src="/bootsample/js/demo/datatables-demo.js"></script>

    </body>
@endsection
