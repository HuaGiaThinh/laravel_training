@php
use App\Models\Category;
use App\Helpers\URL;

$itemCategories = Category::withDepth()
    ->having('depth', '>', 0)
    ->defaultOrder()
    ->get()
    ->toTree();
$xhtmlCategory = '';
renderCategories($itemCategories, $xhtmlCategory);
function renderCategories($categories, &$xhtmlCategory)
{
    foreach ($categories as $category) {
        $linkCate = URL::linkCategory($category['id'], $category['name']);

        $categoryName = count($category->children) > 0 ? $category['name'] . ' »' : $category['name'];
        $xhtmlCategory .= sprintf('<li><a class="dropdown-item" href="%s">%s</a>', $linkCate, $categoryName);

        if (count($category->children) > 0) {
            $xhtmlCategory .= '<ul class="submenu submenu-left dropdown-menu">';
            renderCategories($category->children, $xhtmlCategory);
            $xhtmlCategory .= '</ul>';
        }
        $xhtmlCategory .= '</li>';
    }
}
@endphp

<header class="header">
    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container mt-0">
                            <a href="{{ route('home') }}">
                                <div class="logo">Logo here</div>
                            </a>
                        </div>

                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start"
                            style="height:100px">
                            <nav class="main_nav">
                                <ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">
                                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                                    <li class="dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Danh
                                            mục</a>
                                        <ul class="main-menu dropdown-menu">{!! $xhtmlCategory !!}</ul>
                                    </li>

                                    @if (Auth::user())
                                        <li><a href="{{ route('logout') }}">logout</a></li>
                                    @else
                                        <li><a href="{{ route('login') }}">login</a></li>
                                    @endif
                                </ul>
                                <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars trans_200 menu_mm"
                                        aria-hidden="true"></i></div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
