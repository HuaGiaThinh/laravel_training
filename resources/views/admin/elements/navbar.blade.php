<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}" role="button">
                <i class="fas fa-eye"></i> View Site
            </a>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('admin/images/avatar-cat.jpg') }}" class="user-image img-circle elevation-2"
                    alt="User Image">
                <span class="d-none d-md-inline">GiaThinhDev</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <!-- User image -->
                <li class="user-header bg-info">
                    <img src="{{ asset('admin/images/avatar-cat.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">

                    <p>GiaThinhDev <small>thinh.huagia@hdwebsoft.dev</small></p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
