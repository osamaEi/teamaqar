<!DOCTYPE html>
<html lang="ar">

@include('admin.body.header')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('user.body.top_nav')
        <!-- /.navbar -->

        @include('user.body.side_nav')

        <!-- Main Sidebar Container -->

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        @yield('content')
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('admin.body.footer')
    </div>
</body>

</html>
