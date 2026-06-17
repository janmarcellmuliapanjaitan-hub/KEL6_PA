<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Janji Martahan | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/ionicons/css/ionicons.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    
    <style>
        :root {
            --cream : #f9f5f0;
            --sand  : #ece5d8;
            --brown : #2b1a0e;
            --mid   : #6b4a28;
            --gold  : #c07930;
            --muted : #9a8270;
            --line  : rgba(43,26,14,.10);
        }

        /* Body & Content Wrapper Background */
        body, .content-wrapper {
            background-color: var(--cream) !important;
            color: var(--brown);
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        /* Sidebar Custom Styling */
        .main-sidebar, .sidebar-dark-primary, .brand-link {
            background-color: var(--brown) !important;
            border-right: 1px solid var(--line);
        }

        .brand-link, .brand-link .brand-text {
            color: var(--cream) !important;
            border-bottom: 1px solid rgba(249, 245, 240, 0.1) !important;
        }

        .user-panel {
            border-bottom: 1px solid rgba(249, 245, 240, 0.1) !important;
        }

        .user-panel a, .user-panel .info a {
            color: var(--sand) !important;
        }

        /* Sidebar Navigation Links */
        .nav-sidebar .nav-item .nav-link {
            color: rgba(249, 245, 240, 0.75) !important;
            transition: all 0.2s ease;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            color: var(--cream) !important;
            background-color: rgba(232, 201, 138, 0.12) !important;
        }

        .nav-sidebar .nav-item .nav-link.active {
            background-color: var(--gold) !important;
            color: white !important;
            box-shadow: 0 4px 10px rgba(192, 121, 48, 0.25) !important;
        }

        /* Navbar Custom Styling */
        .main-header.navbar {
            background-color: white !important;
            border-bottom: 1px solid var(--line) !important;
        }

        .main-header.navbar .nav-link {
            color: var(--brown) !important;
        }

        /* AdminLTE Card Styling */
        .card:not([class*="bg-"]) {
            background-color: white !important;
            border: 1px solid var(--line) !important;
            box-shadow: 0 2px 8px rgba(43, 26, 14, 0.02) !important;
        }

        .card-header {
            border-bottom: 1px solid var(--line) !important;
            background-color: transparent !important;
            color: var(--brown) !important;
        }

        .card-primary:not(.card-outline) > .card-header {
            background-color: var(--brown) !important;
            color: white !important;
        }

        .card-primary:not(.card-outline) > .card-header .card-title {
            color: white !important;
        }

        .card-title {
            color: var(--brown) !important;
            font-weight: 600 !important;
        }

        /* Custom Tabs Styling */
        .nav-tabs {
            border-bottom: 2px solid var(--line) !important;
        }

        .nav-tabs .nav-link {
            color: var(--muted) !important;
            border: none !important;
            font-weight: 500;
            padding: 10px 20px;
            transition: all 0.2s ease;
            background: transparent !important;
        }

        .nav-tabs .nav-link:hover {
            color: var(--brown) !important;
        }

        .nav-tabs .nav-link.active {
            color: var(--gold) !important;
            background-color: transparent !important;
            border-bottom: 3px solid var(--gold) !important;
            font-weight: 600;
        }

        /* Theme Text Primary */
        .text-primary {
            color: var(--gold) !important;
        }

        /* Primary Buttons */
        .btn-primary {
            background-color: var(--gold) !important;
            border-color: var(--gold) !important;
            color: white !important;
            transition: all 0.2s ease;
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: var(--mid) !important;
            border-color: var(--mid) !important;
            color: white !important;
        }

        /* Preloader */
        .preloader {
            background-color: var(--cream) !important;
        }

        /* Info boxes & Stat Cards */
        .info-box {
            background-color: white !important;
            border: 1px solid var(--line) !important;
            box-shadow: 0 2px 8px rgba(43, 26, 14, 0.02) !important;
        }

        .info-box-icon {
            background-color: var(--sand) !important;
            color: var(--brown) !important;
        }

        /* Tables styling */
        .table thead th {
            border-bottom: 2px solid var(--line) !important;
            color: var(--brown) !important;
            font-weight: 600 !important;
        }

        .table td, .table th {
            border-top: 1px solid var(--line) !important;
        }

        /* Footer styling */
        .main-footer {
            background-color: transparent !important;
            border-top: 1px solid var(--line) !important;
            color: var(--muted) !important;
        }

        /* Sidebar headers (if any) */
        .nav-header {
            color: var(--muted) !important;
            font-size: 0.75rem !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ URL::asset('adminlte/dist/img/logo.jpeg') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('layout.navbar')
    <!-- End Navbar -->

    <!-- Main Sidebar Container -->
    @include('layout.sidebar')
    <!-- End Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        @include('layout.content_header')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

</div>
</body>
</html>
    <!-- Footer -->
    @include('layout.footer')
    <!-- End Footer -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ URL::asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="{{ URL::asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ URL::asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ URL::asset('adminlte/plugins/sparklines/sparkline.js') }}"></script>

<!-- JQVMap -->
<script src="{{ URL::asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

<!-- jQuery Knob Chart -->
<script src="{{ URL::asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- daterangepicker -->
<script src="{{ URL::asset('adminlte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ URL::asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Summernote -->
<script src="{{ URL::asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- overlayScrollbars -->
<script src="{{ URL::asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ URL::asset('adminlte/dist/js/adminlte.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('adminlte/dist/js/demo.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::asset('adminlte/dist/js/pages/dashboard.js') }}"></script>

</body>
</html>
