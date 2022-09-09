@if (session('news_notify'))
    <div class="alert alert-info " role="alert">
        <button style="cursor:pointer" type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">×</span></button>
        <strong>{{ session('news_notify') }}</strong>
    </div>
@elseif (session('news_notify-error'))
    <div class="alert alert-danger " role="alert">
        <button style="cursor:pointer" type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">×</span></button>
        <strong>{{ session('news_notify-error') }}</strong>
    </div>
@endif
