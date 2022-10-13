<div class="posts">
    <div class="col-lg-12">
        <div class="row">
            @foreach ($item->posts as $post)
                @if ($post->status == 'active')
                    <div class="col-lg-4">
                        <div class="post_item post_v_med d-flex flex-column align-items-start justify-content-start">
                            @include('frontend.partials.posts.image', ['item' => $post])
                            @include('frontend.partials.posts.content', [
                                'item' => $post,
                                'lengthTitle' => 50,
                                'lengthContent' => 200,
                                'showCategory' => false,
                                'category' => $item,
                            ])
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
