@extends('layouts.admin')
@section('content')
    <h1>Attractions</h1>
    @if($attractions->count() > 0)
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>User</th>
            <th>Name</th>
            <th>Body</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attractions as $attraction)
            <tr>
                <td>{{ $attraction->id }}</td>
                <td class="text-center"><img src="{{ asset('storage/' . $attraction->photos->first()->path) }}" style="width: 50px" class="img-responsive img-rounded" alt=""></td>
                <td>{{ $attraction->user->name }}</td>
                <td><a href="{{ route('admin.attractions.edit', $attraction->id) }}">{{ $attraction->name }}</a></td>
                <td>{{ str_limit($attraction->body, 100) }}</td>
                <td>{{ $attraction->created_at->diffForHumans() }}</td>
                <td>{{ $attraction->updated_at->diffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <div class="alert alert-warning">No attractions in database.</div>
    @endif
@endsection