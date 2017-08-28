@extends('layouts.admin')
@section('content')
    <h1>Create Attraction</h1>
    {!! Form::open(['method' => 'POST', 'action' => 'AdminAttractionsController@store', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Attraction Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('body', 'Content:') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo[]', 'Photos:') !!}
        {!! Form::file('photo[]', ['class' => 'form-control', 'multiple' => 'multiple']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create Attraction', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    @include('includes.form_error')
@stop