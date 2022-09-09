@extends('frontend.main')
@section('title')
    Không đủ quyền truy cập
@endsection
@section('content')
    <div class="content_container">
        <div class="container">
            <div class="row">

                <!-- Main Content -->
                <div class="col-lg-12">
                    <div class="main_content text-center mt-auto">
                        <h2>Bạn không đủ quyền truy cập vào chức năng này!!! </h2>
                        <div class="mt-5 mb-4">
                            <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">Quay về trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <!-- Advertisement -->
                    @include ('frontend.block.advertisement', ['itemsAdvertisement' => []])
                </div>

                <div class="col-lg-5">
                    <!-- MostViewed -->
                    @include ('frontend.block.most_viewed', ['itemsMostViewed' => []])
                </div>

                <div class="col-lg-3">
                    <!-- Tags -->
                    @include ('frontend.block.tags', ['itemsTags' => []])
                </div>
            </div>
        </div>
    </div>
@endsection
