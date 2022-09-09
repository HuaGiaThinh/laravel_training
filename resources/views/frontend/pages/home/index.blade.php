@extends('frontend.main')
@section('title')
    Laravel Training
@endsection
@section('content')
    @include ('frontend.block.slider')
    <!-- Content Container -->
    <div class="content_container">
        <div class="container">
            <div class="row">

                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                        <!-- Featured -->
                        {{-- @include('frontend.block.featured', ['items' => $itemsFeatured]) --}}

                        <!-- CATEGORY -->
                        @include('frontend.pages.home.child-index.category_list')
                    </div>
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
@endsection
