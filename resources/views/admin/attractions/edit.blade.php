@extends('layouts.admin')
@section('content')
    <h1>Update Attraction</h1>
    <div class="row">
        <div class="col-sm-3">
            @if($attraction->photos)
                @foreach($attraction->photos as $photo)
                    <img src="{{ asset('storage/' . $photo->path) }}" class="img-responsive img-rounded" alt="">
                    <hr>
                @endforeach
            @else
                <img src="{{ asset('storage/images/placeholder-300x300.png') }}" class="img-responsive img-rounded" alt="">
            @endif
        </div>
        <div class="col-sm-9">
            {!! Form::model($attraction, ['method' => 'PATCH', 'action' => ['AdminAttractionsController@update', $attraction->id], 'files' => true]) !!}
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
                {!! Form::submit('Update Attraction', ['class' => 'btn btn-primary pull-left']) !!}
            </div>
            {!! Form::close() !!}
            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminAttractionsController@destroy', $attraction->id]]) !!}
                <div class="form-group">
                    {!! Form::submit('Delete Attraction', ['class' => 'btn btn-danger pull-right']) !!}
                </div>
            {!! Form::close() !!}
            <div class="clearfix"></div>
            @include('includes.form_error')
        </div>
    </div>
@stop