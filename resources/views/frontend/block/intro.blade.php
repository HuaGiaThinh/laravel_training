<div class="intro">
    <div class="container">
        <div class="row">
            <div class="col-md-4 intro_col">
                <div class="intro_item">
                    <img src="{{ asset('frontend/images/intro_1.jpg') }}" alt="" data-pagespeed-url-hash="3576712055" />
                    <div class="intro_content trans_200">
                        <a href="{{ route('categories.index', [
                                'id' => 3,
                                'name' => 'may-tinh-laptop',
                            ]) }}">Laptop</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 intro_col">
                <div class="intro_item">
                    <img src="{{ asset('frontend/images/intro_2.jpg') }}" alt="" data-pagespeed-url-hash="3871211976" />
                    <div class="intro_content trans_200">
                        <a href="{{ route('categories.index', [
                                'id' => 4,
                                'name' => 'dien-thoai',
                            ]) }}">Điện
                            thoại</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 intro_col">
                <div class="intro_item">
                    <img src="{{ asset('frontend/images/intro_3.jpg') }}" alt="" data-pagespeed-url-hash="4165711897" />
                    <div class="intro_content trans_200">
                        <a href="{{ route('categories.index', ['id' => 9, 'name' => 'phu-kien']) }}">
                            Phụ kiện
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>