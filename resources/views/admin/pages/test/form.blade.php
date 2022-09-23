@extends('admin.main')
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;

$classInput = config('myConfig.template.classInput');

$elements = [
    'name' => [
        'label' => Form::label('name', 'Name'),
        'element' => Form::text('name', @$item->name, $classInput),
    ],
];

@endphp

@section('content')
    {{-- @include ('admin.templates.error') --}}
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-info">
                <div class="card-body">
                    {{ Form::open([
                        'method' => 'POST',
                        'url' => route("$routeName.save"),
                        'accept-charset' => 'UTF-8',
                        'enctype' => 'multipart/form-data',
                        'class' => 'form-horizontal form-label-left main-form',
                        'id' => 'main-form-info',
                    ]) }}
                    {!! FormTemplate::show($elements) !!}

                    {{ Form::hidden('id', @$item->id) }}
                    @if (isset($item))
                        <input data-api="http://laravel_base.test/api/events/{{ $item->id }}/editable/release" class="mt-2 btn btn-success btn-release" type="submit" value="Save">
                        <a href="{{ route($routeName) }}"
                        data-api="http://laravel_base.test/api/events/{{ $item->id }}/editable/release"
                        class="mt-2 btn btn-danger btn-release">Cancel</a>
                    @else
                        <input class="mt-2 btn btn-success" type="submit" value="Save">
                        <a href="{{ route($routeName) }}" class="mt-2 btn btn-danger">Cancel</a>
                    @endif
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.btn-release').click(function(e) {
                $.ajax({
                    type: "GET",
                    url: $(this).data('api'),
                    data: "data",
                    dataType: "json",
                    success: function (response) {
                    }
                });
            });
        });
    </script>
@endpush
