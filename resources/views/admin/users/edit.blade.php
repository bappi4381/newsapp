@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4>Edit User</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Roles</label>
                        <select name="roles[]" class="form-control" multiple required>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Use Ctrl/Command to select multiple roles</small>
                    </div>

                    <div class="mb-3">
                        <label>Permissions</label>
                        <select name="permissions[]" class="form-control" multiple>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->name }}" {{ $user->hasPermissionTo($permission->name) ? 'selected' : '' }}>{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Optional. Use Ctrl/Command to select multiple permissions</small>
                    </div>

                    <button class="btn btn-primary" type="submit">Update User</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
