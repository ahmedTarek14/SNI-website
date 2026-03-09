<html lang="en">

@include('layouts.head')

<body>
    @include('layouts.modals')
    <!-- Side Menu
        ==========================================-->
    @include('layouts.sidebar')
    <!--End side-menu-->
    <!-- Main
        ==========================================-->
    <div class="main">

        <!-- Top Header
            ==========================================-->
        @include('layouts.header')
        <!-- Page content
            ==========================================-->
        @yield('content')

    </div><!--End Main-->
    <div class="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
    @include('layouts.scripts')
</body>

</html>
