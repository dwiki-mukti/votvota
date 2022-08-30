<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- icon -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}

    <!-- basic style -->
    <link rel="stylesheet" href="{{ asset('adminlte/custom/default.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @yield('style')
</head>
{{-- sidebar-mini layout-fixed --}}

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        @include('layouts.components.navbar')
        {{-- @include('layouts.components.sidebar') --}}

        <div class="content-wrapper pb-4">
            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="text-right">
                &copy;<script>
                    document.write(new Date().getFullYear());
                </script> by Wongedanyongkru
            </div>
        </footer>
    </div>







    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
    {{-- <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script> --}}
    @yield('script')
</body>

</html>