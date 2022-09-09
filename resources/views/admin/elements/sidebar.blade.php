<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin/images/logo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Admin Control Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/images/avatar-cat.jpg') }}" class="img-circle elevation-2"
                    alt="User Image" />
            </div>
            <div class="info">
                <a href="#"
                    class="d-block">GiaThinhDev</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview"
                role="menu" data-accordion="false">

                <li class="nav-item mb-1">
                    <a href="#" class="nav-link user">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Users<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users') }}"
                                class="nav-link user-index">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.form') }}"
                                class="nav-link user-form">
                                <i class="fas fa-edit nav-icon"></i>
                                <p>Form</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mb-1">
                    <a href="#" class="nav-link category">
                        <i class="nav-icon fa fa-stream"></i>
                        <p>Categories<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories') }}"
                                class="nav-link category-index">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.form') }}"
                                class="nav-link category-form">
                                <i class="fas fa-edit nav-icon"></i>
                                <p>Form</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mb-1">
                    <a href="#" class="nav-link book">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Posts<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('posts') }}"
                                class="nav-link book-index">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.form') }}"
                                class="nav-link book-form">
                                <i class="fas fa-edit nav-icon"></i>
                                <p>Form</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>