@php
use App\Helpers\URL;

$name = $item['name'];
$thumb = asset('images/posts/' . $item['thumb']);

$linkPost = URL::linkPost($item->id, $item->name);
@endphp
<div class="post_image">
    @if (!empty($type) && $type == 'single')
        <img src="{{ $thumb }}" alt="{{ $name }}" class="img-fluid">
    @else
        <a href="{{ $linkPost }}"><img src="{{ $thumb }}" alt="{{ $name }}"></a>
    @endif
</div>
