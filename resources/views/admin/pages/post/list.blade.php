@php
use App\Helpers\Template as Template;
@endphp
<div class="table-responsive">
    <table class="table align-middle text-center table-bordered">
        {{-- title --}}
        @if (count($items) > 0)
            <thead>
                <tr>
                    <th><input type="checkbox" name="checkall-toggle"></th>
                    <th width="3%">ID</th>
                    <th width="40%" class="text-left">Post Info</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td><input type="checkbox" name="cid[]" value="{{ $item->id }}"></td>
                        <td>{{ $item->id }}</td>
                        <td class="text-left">
                            <p class="mb-0"><b>Name:</b> {{ $item->name }}</p>
                            <p class="mb-0"><b>Description:</b> {{ $item->description }}</p>
                        </td> 
                        <td class="position-relative">
                            {!! Template::showItemStatus($item, $routeName) !!}
                        </td>
                        <td class="position-relative">{!! Template::showCategoriesInSelectBox($categories, $item, $routeName) !!}</td>
                        <td>{!! Template::showButtonAction($controllerName, $item->id, $routeName) !!}</td>
                    </tr>
                @endforeach

            </tbody>
        @else
            <h4 class="text-center">Dữ liệu đang được cập nhật...</h4>
        @endif
    </table>
</div>
