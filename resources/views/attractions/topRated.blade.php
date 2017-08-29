@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Top 5 Attractions</strong>
                    </div>
                    <div class="panel-body">
                        @if($attractions->count() > 0)
                            @foreach($attractions as $attraction)
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="{{ route('attractions.show', $attraction->id) }}">
                                            <img src="{{ $attraction->photos->count() > 0 ? asset('storage/' . $attraction->photos->first()->path) : $placeholder }}" alt="" class="img-responsive img-rounded img-thumbnail">
                                        </a>
                                    </div>
                                    <div class="col-sm-10">
                                        <h2 style="margin-top: 0">
                                            <a href="{{ route('attractions.show', $attraction->id) }}" class="col-sm-11" style="padding-left: 0;">{{ $attraction->name }}</a>
                                            <div class="col-sm-1">{{ $attraction->reviews->count() > 0 ? round($attraction->reviews->avg('rating')) : '-' }}</div>
                                            <div class="clearfix"></div>
                                        </h2>
                                        <p>{{ str_limit($attraction->body, 300) }}</p>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @else
                            <p>No attractions to show.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop