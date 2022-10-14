@php
use App\Helpers\Template as Template;
use App\Helpers\URL;


if ($showCategory) {
    $linkCategory = URL::linkCategory($category->id, $category->name);
}

$linkArticle = URL::linkPost($item->id, $item->name);
if ($lengthContent == 'full') {
    $content = $item->description;
} else {
    $content = Template::showContent($item->description, $lengthContent);
}

if ($lengthTitle == 'full') {
    $name = $item->name;
} else {
    $name = Template::showContent($item->name, $lengthTitle);
}
@endphp

<div class="post_content">
    @if ($showCategory)
        <div class="post_category cat_technology">
            <a href="{{ $linkCategory }}">{{ $category->name }}</a>
        </div>
    @endif

    <div class="post_title"><a href="{{ $linkArticle }}">{{ $name }}</a></div>
    <div class="post_info d-flex flex-row align-items-center justify-content-start">
        <div class="post_author d-flex flex-row align-items-center justify-content-start">
            <div>
                <div class="post_author_image"><img src="{{ asset('frontend/images/author_1.jpg') }}" alt="avatar"></div>
            </div>
            <div class="post_author_name"><a href="#">GiaThinh</a></div>
        </div>
        <div class="post_date"><a href="#">{{ $item->created_at->format('d-m-Y') }}</a></div>
    </div>

    <div class="post_text mt-4">
        <p>{!! $content !!}</p>
    </div>
</div>
