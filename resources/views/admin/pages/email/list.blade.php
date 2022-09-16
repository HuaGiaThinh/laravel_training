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
                    <th>ID</th>
                    <th width="25%">Email</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td><input type="checkbox" name="cid[]" value="{{ $item->id }}"></td>
                        <td>{{ $item->id }}</td>
                        <td class="text-left">{{ $item->email }}</td>
                        <td>{!! Template::showEmailStatus($item->status) !!}</td>
                        <td>{!! Template::showItemHistory($item->updated_by, $item->created_at) !!}</td>
                        <td>{!! Template::showItemHistory($item->updated_by, $item->updated_at) !!}</td>
                        <td>{!! Template::showButtonAction($controllerName, $item->id, $routeName) !!}</td>
                    </tr>
                @endforeach

            </tbody>
        @else
            <h4 class="text-center">Dữ liệu đang được cập nhật...</h4>
        @endif
    </table>
</div>
