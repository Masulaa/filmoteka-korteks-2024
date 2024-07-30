@extends('adminlte::page')

@section('title', 'Edit Password')

@section('content_header')
    <h1>Edit Password</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.updatepassword', $userToEdit->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Dodaj @method('PUT') -->

                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
        </div>
    </div>
@stop
