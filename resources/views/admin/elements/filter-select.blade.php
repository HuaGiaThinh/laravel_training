@php

if ($filterBy == 'category') {
    $arrFilter = $categories;
} else {
    $arrFilter = config('myConfig.filters.' . $filterBy);
}

$currentFilter = $params['filter'][$filterBy];

@endphp

<form action="" method="GET" name="filter-form" id="filter-form">
    <select class="form-control custom-select filter-element" name="{{ $filterBy }}">
        <option value="default">- Filter by {{ $filterBy }} -</option>
        @foreach ($arrFilter as $key => $filter)
            @if ($currentFilter == $key)
                <option value="{{ $key }}" selected>{{ $filter }}</option>
            @else
                <option value="{{ $key }}">{{ $filter }}</option>
            @endif
        @endforeach
    </select>
</form>
