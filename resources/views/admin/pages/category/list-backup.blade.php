@php
use App\Helpers\Template as Template;
@endphp
<div class="table-responsive">
    <table class="table align-middle text-center table-bordered">
        {{-- title --}}
        <thead>
            <tr>
                <th><input type="checkbox" name="checkall-toggle"></th>
                <th>ID</th>
                <th class="text-left">Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td><input type="checkbox" name="cid[]" value="{{ $item->id }}"></td>
                    <td>{{ $item->id }}</td>
                    <td class="text-left">{{ $item->name }}</td>
                    <td class="position-relative">
                        {!! Template::showItemStatus($item, $routeName) !!}
                    </td>
                    <td>{!! Template::showButtonAction($controllerName, $item->id, $routeName) !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
