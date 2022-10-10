@php
use App\Helpers\Template as Template;

$filterStatus = Template::showButtonFilter($routeName, $itemsStatusCount, $params['filter']['status']);
@endphp
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Search & Filter</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="area-filter-status mb-2">
                    {{-- Filter by status --}}
                    {!! $filterStatus !!}
                </div>
                <div class="area-filter-attribute mb-2">
                    @isset($filterBy)
                        @include('admin.elements.filter-select')
                    @endisset
                </div>
                <div class="area-search mb-2">
                    <form action="" method="GET" name="search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search"
                                placeholder="Enter search keyword..." aria-label="Enter search keyword" value="">

                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info">Search</button>
                                <a href="{{ route($routeName) }}" class="btn btn-danger">Clear</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
