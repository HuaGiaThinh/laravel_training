@extends('admin.main')
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;

$classInput = config('myConfig.template.classInput');
$statusValue = ['active' => 'Active', 'inactive' => 'Inactive'];
$selectVoucherEnabled = [0 => 'No', 1 => 'Yes'];

$elements = [
    'name' => [
        'label' => Form::label('name', 'Name'),
        'element' => Form::text('name', @$item->name, $classInput),
    ],
    'description' => [
        'label' => Form::label('description', 'Description'),
        'element' => Form::textArea('description', @$item->description, ['class' => [$classInput['class'], 'ckeditor']]),
    ],
    'status' => [
        'label' => Form::label('status', 'Status'),
        'element' => Form::select('status', $statusValue, @$item->status, $classInput),
    ],
    'category' => [
        'label' => Form::label('category_id', 'Category'),
        'element' => Form::select('category_id', $categories, @$item->category_id, $classInput),
    ],
    'voucher_enabled' => [
        'label'     => Form::label('voucher_enabled', 'Voucher Enable'),
        'element'   => Form::select('voucher_enabled', $selectVoucherEnabled, @$item->voucher_enabled, $classInput),
    ],
    'voucher_quantity' => [
        'label'     => Form::label('voucher_quantity', 'Voucher Quantity'),
        'element'   => Form::number('voucher_quantity', @$item->voucher_quantity, $classInput),
    ],
    [
        'label' => Form::label('thumb', 'Thumb'),
        'element' => Form::file('thumb', $classInput),
        'thumb' => !empty(@$item->id) ? Template::showItemThumb($routeName, @$item->thumb, @$item->name) : null,
        'type' => 'thumb'
    ],
];

@endphp

@section('content')
    @include ('admin.templates.error')
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
                    {{ Form::hidden('thumb_current', @$item->thumb) }}
                    <input class="mt-2 btn btn-success" type="submit" value="Save">
                    <a href="{{ route($routeName) }}" class="mt-2 btn btn-danger">Cancel</a>
                    
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
@endpush
