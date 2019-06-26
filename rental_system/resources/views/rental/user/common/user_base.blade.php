<!DOCTYPE html>
<html lang="ja">


@component('rental.user.common.header')
@endcomponent


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    @component('rental.user.common.sidebar')
    @endcomponent

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

        @component('rental.user.common.topbar')
        @endcomponent

        <!-- Begin Page Content -->
            <div class="container-fluid">

                @section('content')
                @show

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    @component('rental.user.common.footer')
    @endcomponent

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

@component('rental.user.common.scroll_to_top')
@endcomponent

@component('rental.user.common.logout_modal')
@endcomponent

@component('rental.user.common.corescript')
@endcomponent



</body>

</html>

