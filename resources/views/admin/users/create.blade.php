@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-xl-6 col-lg-8 col-md-10">
        <div class="card shadow-lg rounded-3 border-0">
            <div class="card-header bg-gradient-primary text-white d-flex align-items-center justify-content-between">
                <h4 class="mb-0"><i class="mdi mdi-account-plus me-2"></i> Add New User</h4>
            </div>
            <div class="card-body p-4">

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="John Doe" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="john@example.com" required>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="********" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="********" required>
                        </div>
                    </div>

                    {{-- Roles Selection --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Assign Roles</label>
                        <div class="d-flex flex-wrap">
                            @foreach($roles as $role)
                                <div class="form-check me-2 mb-2">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="role-{{ $role->id }}" class="form-check-input d-none">
                                    <button type="button" class="btn btn-outline-primary role-button" data-id="{{ $role->id }}">
                                        {{ $role->name }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted">Select one or more roles</small>
                    </div>

                    {{-- Permissions Selection --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Assign Permissions</label>
                        <div class="d-flex flex-column gap-2">
                            @foreach($permissions as $permission)
                                <div class="form-check p-2 border rounded">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission-{{ $permission->id }}" class="form-check-input me-2">
                                    <label class="form-check-label fw-medium" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted">Select one or more permissions</small>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Back to Users
                        </a>
                        <button type="submit" class="btn btn-gradient-primary btn-lg">
                            <i class="mdi mdi-content-save me-1"></i> Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Roles toggle script --}}
<script>
    document.querySelectorAll('.role-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const checkbox = document.getElementById('role-' + id);
            checkbox.checked = !checkbox.checked; // Toggle checkbox
            this.classList.toggle('active', checkbox.checked);
        });
    });
</script>

{{-- Professional styling --}}
<style>
    .role-button {
        border-radius: 5px;
        margin-right: 10px;
        margin-bottom: 10px;
        transition: all 0.2s ease;
    }
    .role-button.active {
        background: linear-gradient(135deg, #0062E6, #33AEFF);
        color: #fff;
        border-color: #0062E6;
    }
    .role-button:hover {
        background: #0056b3;
        color: #fff;
    }
</style>
@endsection
