<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BankSampahKu</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/tools/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @if (Request::is('user/*'))

        <!-- Custom styles for this page -->
        <link href="{{ asset('/tools/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endif

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        @include('componen.sidebar')

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('componen.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                @yield('content')

                <!-- /.container-fluid -->


                <!-- Footer -->
                @include('componen.footer')
                <!-- End of Footer -->
            </div>
            <!-- End of Main Content -->
        </div>

        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    @include('componen.componenBottom')

    <script src="{{ asset('/tools/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/tools/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/tools/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('/tools/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('/tools/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/tools/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('/js/demo/datatables-demo.js') }}Z"></script>
    <script src="{{ asset('/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('/js/demo/chart-pie-demo.js') }}"></script>

    <script>
            $('#dataTable').DataTable();
    </script>

</body>

</html>
