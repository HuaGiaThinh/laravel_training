@foreach ($items as $item)
    @php
        if ($item->posts->count() == 0) {
            continue;
        }
    @endphp

    <div class="technology">
        <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
            <div>
                <div class="section_title">{{ $item->name }}</div>
            </div>
            <div class="section_bar"></div>
        </div>
        <div class="technology_content">
            @foreach ($item->posts as $posts)
                @if ($posts->status == 'active')
                    <div class="post_item post_h_large">
                        <div class="row">
                            <div class="col-lg-4">
                                @include('frontend.partials.posts.image', ['item' => $posts])
                            </div>
                            <div class="col-lg-8">
                                @include('frontend.partials.posts.content', [
                                    'item' => $posts,
                                    'category' => $item,
                                    'lengthTitle' => 100,
                                    'lengthContent' => 420,
                                    'showCategory' => true,
                                ])
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endforeach
