@extends('frontend.main')
@section('title')
    {{ $item->name }}
@endsection
@section('content')
<div class="section-category">
    @include('frontend.block.breadcrumb', ['item' => $item])
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-9">
                        @if ($item->posts->count() > 0)
                            @include('frontend.pages.category.child-index.category', ['item' => $item]) 
                        @else
                            <div><h3>Danh mục này đang được cập nhật...</h3></div>
                        @endif
                    </div>
                    <!-- Sidebar -->
                    <div class="col-lg-3">
                        <div class="sidebar">
                            <!-- Latest Posts -->
                            {{-- @include ('frontend.block.latest_posts', ['items' => $itemsLatest]) --}}
    
                            <!-- Advertisement -->
                            @include ('frontend.block.advertisement', ['itemsAdvertisement' => []])
    
                            <!-- MostViewed -->
                            @include ('frontend.block.most_viewed', ['itemsMostViewed' => []])
    
                            <!-- Tags -->
                            @include ('frontend.block.tags', ['itemsTags' => []])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection