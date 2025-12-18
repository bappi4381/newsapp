@extends('layouts.app')
@section('content')
<div class="row">
    <!-- Dashboard Cards -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <h2>{{ $users->total() }}</h2>
            </div>
            <div class="card-footer">
                <i class="mdi mdi-account-multiple"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <h5 class="card-title">Admins</h5>
                <h2>{{ \App\Models\User::role('Admin')->count() }}</h2>
            </div>
            <div class="card-footer">
                <i class="mdi mdi-account-key"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-warning h-100">
            <div class="card-body">
                <h5 class="card-title">Editors</h5>
                <h2>{{ \App\Models\User::role('Editor')->count() }}</h2>
            </div>
            <div class="card-footer">
                <i class="mdi mdi-pencil-box-outline"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card text-white bg-danger h-100">
            <div class="card-body">
                <h5 class="card-title">Authors</h5>
                <h2>{{ \App\Models\User::role('Author')->count() }}</h2>
            </div>
            <div class="card-footer">
                <i class="mdi mdi-account-edit"></i>
            </div>
        </div>
    </div>
</div>

<!-- Users Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Manage Users</h4>
                <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="mdi mdi-account-plus"></i> Add User</a>
            </div>
            <div class="card-body">
                <!-- Search & Filter -->
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search Name or Email">
                    </div>
                    <div class="col-md-4">
                        <select name="role" class="form-control">
                            <option value="">Filter by Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i> Search</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($user->permissions as $permission)
                                        <span class="badge bg-warning text-dark">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"><i class="mdi mdi-pencil"></i></a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="mdi mdi-delete"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
