@extends('layouts.admin')
@section('content')
    <h1>Edit User</h1>
    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id]]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'E-Mail Address:') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirm Password:') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', ['' => 'Choose Role'] + $roles, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('active', 'Account Status:') !!}
            {!! Form::select('active', ['' => 'Choose Option'] + $activeStates, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Edit User', ['class' => 'btn btn-primary col-sm-3 pull-left']) !!}
        </div>
    {!! Form::close() !!}
    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!}
        <div class="form-group">
            {!! Form::submit('Delete User', ['class' => 'btn btn-danger col-sm-3 pull-right']) !!}
        </div>
    {!! Form::close() !!}
    <div class="clearfix"></div>
    @include('includes.form_error')
@stop