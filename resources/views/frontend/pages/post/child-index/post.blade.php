@php
use App\Helpers\Template as Template;
use App\Helpers\URL;

$name = $item['name'];

$linkCategory = URL::linkCategory($category->id, $category->name);
$linkArticle = URL::linkPost($item->id, $item->name);

if ($lenghtContent == 'full') {
    $content = $item->description;
} else {
    $content = Template::showContent($item->description, $lenghtContent);
}
@endphp

<div class="post_content">
    <div class="post_category cat_technology">
        <a href="{{ $linkCategory }}">{{ $category->name }}</a>
    </div>

    <div class="post_title"><a href="{{ $linkArticle }}">{{ $name }}</a></div>
    <div class="post_info d-flex flex-row align-items-center justify-content-start">
        <div class="post_author d-flex flex-row align-items-center justify-content-start">
            <div>
                <div class="post_author_image"><img src="{{ asset('frontend/images/author_1.jpg') }}" alt="avatar"></div>
            </div>
            <div class="post_author_name"><a href="#">GiaThinh</a></div>
        </div>
        <div class="post_view_counter">
            <p><i class="fa fa-eye"></i> {{ $item->view_count }} views</p>
        </div>
    </div>

    {{-- voucher button --}}
    @include('frontend.pages.post.child-index.voucher-button')

    <div class="post_text mt-4">
        <p>{!! $content !!}</p>
    </div>
</div>
