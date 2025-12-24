@extends('layouts.app')

@section('content')
<div class="row">
<!-- Users Table -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-0">Manage Users</h4>
                    <small class="text-muted">Create users, assign roles, and control access.</small>
                </div>

                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-account-plus me-1"></i> Add User
                </a>
            </div>

            <div class="card-body">

                <!-- Search & Filter -->
                <form method="GET" class="row g-3 mb-4">
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="form-control" placeholder="Search Name or Email">
                    </div>

                    <div class="col-md-4">
                        <select name="role" class="form-control">
                            <option value="">Filter by Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ request('role') == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-magnify"></i> Search
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Permissions</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration + $users->firstItem() - 1 }}</td>

                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-dark">{{ $role->name }}</span>
                                    @endforeach
                                </td>

                                <td class="text-wrap " style="">
                                    @php
                                        $permissions = $user->getAllPermissions()->pluck('name')->toArray();
                                    @endphp

                                    @if(count($permissions) > 0)
                                        @foreach($permissions as $permission)
                                            <span class="badge bg-info m-1">{{ $permission }}  </span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No Permissions</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="text-center">

                                    @if(!$user->hasRole('Admin'))
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="btn btn-sm btn-info" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}"
                                              method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')"
                                                    title="Delete">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
