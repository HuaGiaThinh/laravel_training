@extends('admin.main')
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;
use App\Models\CategoryModel;

$classInput = config('myConfig.template.classInput');
$statusValue = ['active' => 'Active', 'inactive' => 'Inactive'];

$elements = [
    'name' => [
        'label' => Form::label('name', 'Name'),
        'element' => Form::text('name', @$item->name, $classInput),
    ],
    'status' => [
        'label' => Form::label('status', 'Status'),
        'element' => Form::select('status', $statusValue, @$item->status, $classInput),
    ],
    'parent' => [
        'label' => Form::label('parent', 'Parent'),
        'element' => Form::select('parent_id', $categories, @$itemParent->id, $classInput),
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
                        'class' => 'form-horizontal form-label-left main-form',
                        'id' => 'main-form-info',
                    ]) }}
                    {!! FormTemplate::show($elements) !!}

                    {{ Form::hidden('id', @$item->id) }}
                    <input class="mt-2 btn btn-success" type="submit" value="Save">
                    <a href="{{ route($routeName) }}" class="mt-2 btn btn-danger">Cancel</a>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
