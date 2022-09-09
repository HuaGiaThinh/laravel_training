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
                    <th class="text-left">User Info</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th>Last Login</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td><input type="checkbox" name="cid[]" value="{{ $item->id }}"></td>
                        <td>{{ $item->id }}</td>
                        <td class="text-left">
                            <p class="mb-0">Name: <b>{{ $item->name }}</b></p>
                            <p class="mb-0">Email: <b>{{ $item->email }}</b></p>
                        </td>
                        <td class="position-relative">{{ $item->level }}</td>
                        <td class="position-relative">
                            {!! Template::showItemStatus($item, $routeName) !!}
                        </td>
                        <td>{!! Template::showItemHistory($item->updated_by, $item->updated_at) !!}</td>
                        <td>{!! Template::showItemHistory(null, $item->last_login) !!}</td>
                        <td>{!! Template::showButtonAction($controllerName, $item->id, $routeName) !!}</td>
                    </tr>
                @endforeach

            </tbody>
        @else
            <h4 class="text-center">Dữ liệu đang được cập nhật...</h4>
        @endif
    </table>
</div>
