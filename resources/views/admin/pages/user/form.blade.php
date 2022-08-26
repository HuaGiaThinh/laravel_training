@extends('admin.main')
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;

$classInput = config('myConfig.template.classInput');
$statusValue = ['active' => 'Active', 'inactive' => 'Inactive'];
$levelValue = ['user' => 'User', 'admin' => 'Admin'];

$elements = [
    'name' => [
        'label' => Form::label('name', 'Name'),
        'element' => Form::text('name', @$item->name, $classInput),
    ],
    'email' => [
        'label' => Form::label('email', 'Email'),
        'element' => Form::text('email', @$item->email, $classInput),
    ],
    'password' => [
        'label' => Form::label('password', 'Password'),
        'element' => Form::password('password', $classInput),
    ],
    'status' => [
        'label' => Form::label('status', 'Status'),
        'element' => Form::select('status', $statusValue, @$item->status, $classInput),
    ],
    'level' => [
        'label' => Form::label('level', 'Level'),
        'element' => Form::select('level', $levelValue, @$item->level, $classInput),
    ],
];

if (isset($item->id)) {
    unset($elements['password']);
    $elements['email']['element'] = '<p style="background-color:#d6dadd" class="form-control" name="email">' . $item->email . '</p>';
}
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
