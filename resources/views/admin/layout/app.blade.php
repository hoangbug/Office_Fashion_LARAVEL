<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- <link rel="icon" href=""> --}}
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('admin_assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{ asset('admin_assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />

    <link href="{{ asset('admin_assets/vendors/DataTables/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/css/toastr.css') }}" rel="stylesheet" />

    {{-- Date Range Picker --}}
    <link href="{{ asset('admin_assets/css/daterangepicker.css') }}" rel="stylesheet" />
    
    @yield('script')

    <!-- THEME STYLES-->
    <link href="{{ asset('admin_assets/css/main.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_assets/css/custom.css') }}" rel="stylesheet" />

    <!-- PAGE LEVEL STYLES-->
    @yield('css')


</head>

<body class="fixed-navbar">
<div class="page-wrapper">
    @include('admin.layout.header')
    @include('admin.layout.nav')

    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            @yield('content')
        </div>

    @include('admin.layout.footer')

    </div>
</div>

{{-- @include('admin.layout.config') --}}

<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS-->
<script src="{{ asset('admin_assets/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/vendors/popper.js/dist/umd/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('admin_assets/vendors/metisMenu/dist/metisMenu.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/vendors/DataTables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/js/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/js/scripts/sweetalert2.js') }}" type="text/javascript"></script>
{{-- Date Range Picker --}}
<script src="{{ asset('admin_assets/js/scripts/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/js/scripts/daterangepicker.min.js') }}" type="text/javascript"></script>

@yield('library-js')

<!-- CORE SCRIPTS-->
<script src="{{ asset('admin_assets/js/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin_assets/js/custom.js') }}" type="text/javascript"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('after-js')
</body>
</html>
