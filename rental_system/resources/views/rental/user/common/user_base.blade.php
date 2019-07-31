<!DOCTYPE html>
<html lang="ja">


@component('rental.user.common.header')
    @slot('title')
        テスト端末貸出システム｜@yield('subTitle')
    @endslot
@endcomponent


<body id="page-top" class="{{$_COOKIE['sideOpen'] ? 'sidebar-toggled':null}}">

<!-- Page Wrapper -->
<div id="wrapper">

    @component('rental.user.common.sidebar')
    @endcomponent

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
        @component('rental.user.common.topbar')
            @if(\Auth::guard('user')->check())
                @slot('name')
                    <?=$user_info['name'];?>
                @endslot
                @slot('division')
                    {{--division--}}
                    {{$user_info['division_id']===10 ? 'コンサルティング' : null}}
                    {{$user_info['division_id']===20 ? "システムソリューション":null}}
                    {{$user_info['division_id']===30 ? 'クリエイティブ':null }}
                    {{$user_info['division_id']===40 ? 'Sharing Kyoto':null}}
                    {{$user_info['division_id']===50 ? '経営本部':null }}
                @endslot
                @slot('group')
                        {{--group--}}
                        {{$user_info['group_id']===1010 ? '第1グループ': null}}
                        {{$user_info['group_id']===1020 ? '第2グループ': null}}
                        {{$user_info['group_id']===1030 ? '事業企画グループ': null}}
                        {{$user_info['group_id']===2010 ? '第1ソリューショングループ': null}}
                        {{$user_info['group_id']===2020 ? '第2ソリューショングループ': null}}
                        {{$user_info['group_id']===2030 ? '事業運営グループ': null}}
                        {{$user_info['group_id']===3010 ? 'クリエイティブグループ': null}}
                        {{$user_info['group_id']===4010 ? 'カフェプロデュースグループ': null}}
                        {{$user_info['group_id']===4020 ? 'メディア運営・観光サポートグループ': null}}
                        {{$user_info['group_id']===4030 ? 'マーケティング支援グループ': null}}
                        {{$user_info['group_id']===5010 ? '総務・法務グループ': null}}
                        {{$user_info['group_id']===5020 ? '経営企画・情報システムグループ': null}}
                        {{$user_info['group_id']===5030 ? '人事・経理グループ': null}}
                @endslot
            @endif
        @endcomponent

        <!-- Begin Page Content -->
            <div class="container-fluid">
                @if (session('flash_message'))
                    <div class="alert alert-success text-center">
                        {{ session('flash_message') }}
                    </div>
                @endif


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

@stack('fixed_button')

@component('rental.user.common.logout_modal')
@endcomponent

@component('rental.user.common.corescript')
@endcomponent

@stack('scripts')

</body>

</html>

