@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h4 class="fw-bold text-uppercase mb-0" style="letter-spacing:2px;color:#0056b3;">
                <i class="bi bi-person-plus-fill me-2"></i>
                Add New User
            </h4>
            <a href="{{ route('users.index') }}" class="btn btn-brown px-4 shadow-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Back to Users
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- User Form --}}
        <form action="{{ route('users.store') }}" method="POST" class="mx-auto bg-white p-4 rounded-4 shadow-sm" >
            @csrf

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Name --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="name" class="form-control form-control-lg shadow-sm" placeholder="John Doe" required>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Email Address</label>
                <input type="email" name="email" class="form-control form-control-lg shadow-sm" placeholder="john@example.com" required>
            </div>

            {{-- Password --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg shadow-sm" placeholder="********" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-lg shadow-sm" placeholder="********" required>
                </div>
            </div>

            {{-- Roles --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Assign Roles</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="role-{{ $role->id }}" class="form-check-input d-none">
                            <button type="button" class="btn btn-outline-primary role-button px-3 py-2" data-id="{{ $role->id }}">
                                {{ $role->name }}
                            </button>
                        </div>
                    @endforeach
                </div>
                <small class="text-muted">Select one or more roles</small>
            </div>

            {{-- Actions --}}
            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-x-circle me-1"></i> Cancel
                </a>
                <button type="submit" class="btn btn-brown px-5">
                    <i class="bi bi-check2-circle me-1"></i> Create User
                </button>
            </div>
        </form>

    </div>
</div>
{{-- JS for role buttons --}}
<script>
document.querySelectorAll('.role-button').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const checkbox = document.getElementById('role-' + id);
        checkbox.checked = !checkbox.checked;
        this.classList.toggle('active', checkbox.checked);
    });
});
</script>

{{-- Professional Theme --}}
<style>
body {
    background: #f7f8fa;
}

.btn-brown{
    background:#0056b3;
    color:#fff;
    transition: all 0.2s ease;
    border-radius: 8px;
}
.btn-brown:hover{
    background:#003d80;
    color:#fff;
}

.role-button {
    border-radius: 8px;
    transition: all 0.2s ease;
    min-width: 100px;
    text-align: center;
}
.role-button.active {
    background: linear-gradient(135deg, #0062E6, #33AEFF);
    color: #fff;
    border-color: #0062E6;
}
.role-button:hover {
    background:#0056b3;
    color:#fff;
}

.form-control:focus {
    box-shadow: 0 0 8px rgba(0, 86, 179, 0.3);
    border-color: #0056b3;
}

.alert {
    font-size: 0.95rem;
}
</style>

@endsection
