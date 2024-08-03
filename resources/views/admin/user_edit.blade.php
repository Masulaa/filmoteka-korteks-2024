@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $userToEdit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
            
            <form action="{{ route('admin.users.setadmin', $userToEdit->id) }}" method="POST" style="margin-top: 10px;">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm"
                    @if ($userToEdit->is_admin) disabled @endif>Set to Admin</button>
            </form>
            <form action="{{ route('admin.users.removeadmin', $userToEdit->id) }}" method="POST" style="margin-top: 10px;">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm"
                    @unless ($userToEdit->is_admin) disabled @endunless>Remove Admin</button>
            </form>
            <form action="{{ route('admin.users.destroy', $userToEdit->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="margin-top: 10px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>
@stop
