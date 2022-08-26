@php
use App\Helpers\Template as Template;
@endphp


<li class="dd-item dd3-item" data-id="{{ $item->id }}">
    <div class="dd-handle dd3-handle" style="height: 46px;">Drag</div>
    <div class="dd3-content" style="min-height: 46px;">
        <div class="d-flex" style="justify-content: space-between;flex-wrap: wrap;">
            <div class="" style="font-size: 16px;">{{ $item->name }}</div>

            <div class="d-flex" style="justify-content: space-between">
                <div class="position-relative" style="width:350px">
                    {!! Template::showItemStatus($item, $routeName) !!}
                </div>
                <div class="">{!! Template::showButtonAction($controllerName, $item->id, $routeName) !!}</div>
            </div>
        </div>
    </div>

    @if ($item->children()->count() > 0)
        <ol class="dd-list">
            @foreach ($item->children as $itemChildren)
                @include('admin.pages.category.item', ['item' => $itemChildren])
            @endforeach
        </ol>
    @endif
</li>


{{-- <li class="dd-item dd3-item" data-id="{{ $item->id }}">
    <div class="dd-handle dd3-handle">Drag</div>
    <div class="dd3-content">{{ $item->name }}</div>

    @if ($item->children()->count() > 0)
        <ol class="dd-list">
            @foreach ($item->children as $itemChildren)
                @include('admin.pages.category.item', ['item' => $itemChildren])
            @endforeach
        </ol>
    @endif
</li> --}}
