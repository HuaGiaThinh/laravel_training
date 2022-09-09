@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Search & Filter -->
            @include('admin/elements/filter', ['filterBy' => 'category'])
            <!-- List -->
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">List</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST" name="main-form" id="main-form">
                        <div class="container-fluid">
                            <div class="row align-items-center justify-content-between mb-2">
                                <div>
                                    <!-- BULK ACTION -->
                                    @include('admin/elements/bulk-action')
                                </div>
                                <div>
                                    <a href="{{ route("$routeName.form") }}" class="btn btn-info">
                                        <i class="fas fa-plus"></i> Add New
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- list --}}
                        @include ('admin.templates.notify')
                        @include('admin.pages.post.list')
                    </form>     
                </div>

                <div class="card-footer clearfix">
                    {{-- pagination --}}
                    @if (count($items) > 0)
                        {{ $items->links('pagination.pagination_BE') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
