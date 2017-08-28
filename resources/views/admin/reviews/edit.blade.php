@extends('layouts.admin')
@section('content')
    <h1>Edit Review</h1>
    <div class="row">
        {!! Form::model($review, ['method' => 'PATCH', 'action' => ['AdminReviewsController@update', $review->id]]) !!}
            <div class="form-group">
                {!! Form::label('rating', 'Rating:') !!}
                {!! Form::select('rating', $rates, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('content', 'Review:') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Edit Review', ['class' => 'btn btn-primary col-sm-3 pull-left']) !!}
            </div>
        {!! Form::close() !!}
        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminReviewsController@destroy', $review->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete Review', ['class' => 'btn btn-danger col-sm-3 pull-right']) !!}
            </div>
        {!! Form::close() !!}
        <div class="clearfix"></div>
    </div>
    @include('includes.form_error')
@stop