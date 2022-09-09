@php
use App\Models\MenusModel as MenusModel;
use App\Models\CategoriesModel as CategoriesModel;
use App\Helpers\URL;

$menusModel = new MenusModel();
$categoriesModel = new CategoriesModel();

$itemsMenu = $menusModel->listItems(null, ['task' => 'news-list-items']);
$itemsCategory = $categoriesModel->listItems(null, ['task' => 'news-list-items']);

$xhtmlMenu = '';
$xhtmlMenuMobile = '';

if (count($itemsMenu) > 0) {
    $xhtmlMenu = '<nav class="main_nav">
    <ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">';

    $xhtmlCategory = '';
    foreach ($itemsCategory as $category) {
        $linkCate = URL::linkCategory($category['id'], $category['name']);
        $xhtmlCategory .= sprintf('<a class="dropdown-item" href="%s">%s</a>', $linkCate, $category['name']);
    }

    $categoryIdCurrent = Route::input('category_id');
    foreach ($itemsMenu as $menu) {
        $link = '#';
        if ($menu['type'] == 'link') {
            $link = $menu['link'];
        }

        if ($menu['type'] == 'category_article') {
            $xhtmlMenu .= sprintf(
                '
                <li id="dropdownMenuLink" aria-expanded="false">
                    <a class="dropdown-toggle" href="#">%s</a>
                    <div class="dropdown-menu">%s</div>
                </li>',
                $menu['name'],
                $xhtmlCategory,
            );
        } else {
            $xhtmlMenu .= sprintf('<li><a target="%s" href="%s">%s</a></li>', $menu['type_open'], $link, $menu['name']);
        }
    }

    if (session('userInfo')) {
        $xhtmlMenuUser = sprintf('<li><a href="%s">%s</a></li>', route('auth/logout'), 'Logout');
    } else {
        $xhtmlMenuUser = sprintf('<li><a href="%s">%s</a></li>', route('auth/login'), 'Login');
    }

    $xhtmlMenu .=
        $xhtmlMenuUser .
        '
    </ul>
</nav>';
}
@endphp

<header class="header">

    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="{!! route('home') !!}">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>
                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                            <a href="#">
                                <div class="background_image"
                                    style="background-image:url({{ asset('news/images/zendvn-online.png') }});background-size: contain">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">

                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>ZEND</span>VN</div>
                            </a>
                        </div>

                        <!-- Navigation -->
                        {!! $xhtmlMenu !!}

                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm"
                                aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


{{-- Menu mobile --}}
<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container">
        <div class="menu_close">
            <div></div>
            <div></div>
        </div>
    </div>
    {!! $xhtmlMenuMobile !!}
</div>
