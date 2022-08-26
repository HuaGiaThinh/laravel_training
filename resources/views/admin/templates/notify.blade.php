@if (session('notify'))
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Message!</strong> {{ session('notify') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
            </div>
        </div>
    </div>
@endif