@if (Auth::user())
    @if ($item->voucher_enabled)
        <div class="mt-2 text-center">
            <a href="{{ route('posts.generateVoucherCode', ['id' => $item->id]) }}"
                class="btn btn-danger ajax-generate-voucher-code" data-toggle="modal" data-target="#modal-voucher">
                Get your voucher code
            </a>
        </div>
    @endif
@else
    <div class="mt-2 text-center">
        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
            Đăng nhập ngay để nhận voucher
        </a>
    </div>
@endif

{{-- modal --}}
<div class="modal fade" id="modal-voucher" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Your voucher code:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" style="background-color:rgb(255, 255, 90);">
                <h3 class="loading" style="color:red">
                    <img src="{{ asset('frontend/images/spinner.gif') }}">
                    <span style="color:#6c757d">Loading...</span>
                </h3>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
