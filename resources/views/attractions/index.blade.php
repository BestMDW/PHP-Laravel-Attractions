@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Attractions</div>
                    <div class="panel-body">
                        @if($attractions)
                            @foreach($attractions as $attraction)
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="{{ route('attractions.show', $attraction->id) }}">
                                            <img src="{{ $attraction->photos ? asset('storage/' . $attraction->photos->first()->path) : Photo::PLACEHOLDER }}" alt="" class="img-responsive img-rounded img-thumbnail">
                                        </a>
                                    </div>
                                    <div class="col-sm-10">
                                        <h2 style="margin-top: 0">
                                            <a href="{{ route('attractions.show', $attraction->id) }}">{{ $attraction->name }}</a>
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