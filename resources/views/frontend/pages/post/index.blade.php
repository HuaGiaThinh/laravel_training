@extends('frontend.main')
@section('title')
    {{ $itemPost->name }}
@endsection
@section('content')
    <div class="section-category">

        @include('frontend.block.breadcrumb_post', ['item' => $itemPost])

        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-9">
                            <div class="single_post">
                                {{-- detail post --}}
                                @include('frontend.partials.posts.image', ['item' => $itemPost,'type' => 'single'])
                                @include('frontend.pages.post.child-index.post', [
                                    'item' => $itemPost,
                                    'lenghtContent' => 'full',
                                    'showCategory' => false,
                                    'category' => $itemPost->categories->pluck('name', 'id'),
                                ])
                            </div>
                        </div>
                        <!-- Sidebar -->
                        <div class="col-lg-3">
                            <div class="sidebar">
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
