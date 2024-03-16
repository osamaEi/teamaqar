<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@include('admin.body.header')
<body class="hold-transition sidebar-mini">



 




    <div class="wrapper">
        <!-- Navbar -->
      @include('admin.body.top_nav')
        <!-- /.navbar -->

        @include('admin.body.side_nav')

        <!-- Main Sidebar Container -->


        <div class="content-wrapper">
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
               
                      @yield('admin')
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
     
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('admin.body.footer')
</body>