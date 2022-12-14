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
                    <th width="10%">Image</th>
                    <th width="10%">Status</th>
                    <th width="10%">Voucher enabled</th>
                    <th width="10%">Voucher quantity</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td><input type="checkbox" name="cid[]" value="{{ $item->id }}"></td>
                        <td>{{ $item->id }}</td>
                        <td class="text-left">
                            <p class="mb-0"><b>Name:</b>
                                {{ Template::showContent($item->name, 50) }}
                            </p>
                            <p class="mb-0"><b>Description:</b>
                                {!! Template::showContent($item->description, 200) !!}
                            </p>
                        </td>
                        <td>{!! Template::showItemThumb($routeName, $item['thumb'], $item['name']) !!}</td>
                        <td class="position-relative">
                            {!! Template::showItemStatus($item, $routeName) !!}
                        </td>
                        <td class="position-relative">{!! Template::showItemVoucherEnabled($item, $routeName) !!}</td>
                        <td class="position-relative">{!! Template::showItemVoucherQuantity($item, $routeName) !!}</td>
                        <td>{!! Template::showButtonAction($controllerName, $item->id, $routeName) !!}</td>
                    </tr>
                @endforeach

            </tbody>
        @else
            <div class="text-center" style="margin:auto">
                <h5 style="margin-bottom: 0">D??? li???u ??ang ???????c c???p nh???t...</h5>
                <img width="150px" src="{{ asset('admin/images/nyan-cat.gif') }}" alt="Loading...">
            </div>

        @endif
    </table>
</div>
