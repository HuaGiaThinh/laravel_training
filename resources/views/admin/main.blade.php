<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.elements.head')
</head>

<body class="hold-transition sidebar-mini"> 
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.elements.navbar')

        <!-- Main Sidebar Container -->
        @include('admin.elements.sidebar')

        <!-- Main content -->
        

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('admin.elements.page-header')
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>
        </div>
        <!-- End main content -->

        <!-- Main Footer -->
        @include('admin.elements.footer')
    </div>

    @include('admin.elements.script')
</body>

</html>
