@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $attraction->name }}</div>
                    <div class="panel-body">
                        {{ $attraction->body }}
                        @if($attraction->photos)
                            <hr>
                            <div id="links">
                                @foreach($attraction->photos as $photo)
                                    <a href="{{ asset('storage/' . $photo->path) }}" class="col-sm-2" title="">
                                        <img src="{{ asset('storage/' . $photo->path) }}" class="img-thumbnail img-rounded img-responsive" alt="">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- Add / Modify review form --}}
        @if(Auth::check() && Auth::user()->isActive())
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $userReview ? 'Edit Review' : 'Add Review' }}</div>
                    <div class="panel-body">
                        @if(Session::has('toastMessage'))
                            <div class="alert alert-success alert-dismissable fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> {{ session('toastMessage') }}
                            </div>
                        @endif
                        @if($userReview)
                            {!! Form::model($userReview, ['method' => 'PATCH', 'action' => ['ReviewsController@update', $attraction->id, $userReview->id], 'class' => 'form-horizontal']) !!}
                        @else
                            {!! Form::open(['method' => 'POST', 'action' => ['ReviewsController@store', $attraction->id], 'class' => 'form-horizontal']) !!}
                        @endif
                            <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                                {!! Form::label('rating', 'Rate:', ['class' => 'control-label col-sm-1']) !!}
                                <div class="col-sm-11">
                                    {!! Form::select('rating', $rates, null, ['class' => 'form-control']) !!}
                                    @if ($errors->has('rating'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('rate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                {!! Form::label('content', 'Review:', ['class' => 'control-label col-sm-1']) !!}
                                <div class="col-sm-11">
                                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <div class="col-sm-12">
                                    {!! Form::submit($userReview ? 'Edit Review' : 'Add Review', ['class' => 'btn btn-primary']) !!}
                                </div>
                             </div>
                         {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{-- List of reviews --}}
        @if($reviews->count() > 0)
            @foreach($reviews as $review)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <button type="button" class="close pull-left" aria-label="Hide">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ $review->user->name }}
                                <div class="lead text-info pull-right">
                                    <strong>{{ $review->rating }}</strong>
                                </div>
                            </div>
                            <div class="panel-body">
                                <p>{{ $review->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Reviews</div>
                        <div class="panel-body">
                            No reviews to show.
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop
@section('footer')
    @if($attraction->photos)
        <script src="{{ asset('js/blueimp.js') }}"></script>
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>
        <script>
            document.getElementById('links').onclick = function (event) {
                event = event || window.event;
                var target = event.target || event.srcElement,
                    link = target.src ? target.parentNode : target,
                    options = {index: link, event: event},
                    links = this.getElementsByTagName('a');
                blueimp.Gallery(links, options);
            };
        </script>
    @endif
@stop