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
                                    <a href="{{ asset('storage/' . $photo->path) }}" class="col-sm-2" title="asd">
                                        <img src="{{ asset('storage/' . $photo->path) }}" class="img-thumbnail img-rounded img-responsive" alt="asd">
                                    </a>
                                @endforeach
                            </div>
                            <script>
                                blueimp.Gallery(
                                    document.getElementById('links').getElementsByTagName('a'),
                                    {
                                        container: '#blueimp-gallery-carousel',
                                        carousel: true
                                    }
                                );
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    @if($attraction->photos)
        <!-- The Gallery as inline carousel, can be positioned anywhere on the page -->
        <div id="blueimp-gallery-carousel" class="blueimp-gallery blueimp-gallery-carousel">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div>
    @endif
@stop