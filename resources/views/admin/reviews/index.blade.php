@extends('layouts.admin')
@section('content')
    <h1>Reviews</h1>
    @if($reviews->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Created by</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Attraction</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Show / Hide</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->user->name }}</td>
                        <td><a href="{{ route('admin.reviews.edit', $review->id) }}">{{ $review->content }}</a></td>
                        <td>{{ $review->rating }}</td>
                        <td><a href="{{ route('attractions.show', $review->attraction->id) }}">{{ $review->attraction->name }}</a></td>
                        <td>{{ $review->created_at->diffForHumans() }}</td>
                        <td>{{ $review->updated_at->diffForHumans() }}</td>
                        <td>
                            {!! Form::open(['method' => 'PATCH', 'action' => ['AdminReviewsController@' . ($review->isVisible() ? 'hidden' : 'visible'), $review->id]]) !!}
                                <div class="form-group">
                                    {!! Form::submit(($review->isVisible() ? 'Hide' : 'Show'), ['class' => 'btn btn-primary']) !!}
                                </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{ $reviews->links() }}
            </div>
        </div>
    @else
        <div class="alert alert-warning">No reviews in database.</div>
    @endif
@stop