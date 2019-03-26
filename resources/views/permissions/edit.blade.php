@extends('layouts.app')

@section('title', '| Edit Permission')

@section('content')

<div class='col-lg-4 offset-lg-4'>

    {{-- @include ('errors.list') --}}

    <h1><span class="oi oi-key"></span> Edit {{$permission->name}}</h1>
    <br>
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection