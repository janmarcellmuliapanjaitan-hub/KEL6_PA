<!-- Nama : Jan Marcell Mulia Panjaitan 
     NIM  : 42325040
     Prodi : D3 Teknologi Informasi -->

     
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
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ URL::asset('adminlte/dist/img/logo.jpg') }}" alt="AdminLTELogo" height="60" width="60">
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
