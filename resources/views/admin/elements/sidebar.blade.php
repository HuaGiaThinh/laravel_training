<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Admin Control Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/images/avatar-cat.jpg') }}" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block">GiaThinhDev</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                @php
                    $arrNavigations = config('myConfig.template.sidebar');
                @endphp

                @foreach ($arrNavigations as $nav)
                    <li class="nav-item mb-1">
                        <a href="#" class="nav-link {{ $nav['class'] }}">
                            <i class="nav-icon {{ $nav['icon'] }}"></i>
                            <p>{{ ucfirst($nav['name']) }}<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route($nav['name']) }}" class="nav-link">
                                    <i class="fas fa-list-ul nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route($nav['name'] . '.form') }}" class="nav-link">
                                    <i class="fas fa-edit nav-icon"></i>
                                    <p>Form</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</aside>

@push('script-sidebar')
    <script>
        let arr = window.location.pathname.split('/');
        arr.shift()

        let navCurrent = $('.nav-link.' + arr[1]);
        navCurrent.parent().addClass('menu-is-opening menu-open');
        navCurrent.addClass('active');

        if (arr.includes('form')) {
            navCurrent.siblings('ul').children().last().children().addClass('active');
        } else {
            navCurrent.siblings('ul').children().first().children().addClass('active');
        }
    </script>
@endpush
