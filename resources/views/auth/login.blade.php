<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News Portal Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            min-height: 100vh;
        }
        .login-card {
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,.3);
        }
        .logo svg {
            width: 90px;
            height: 90px;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5 col-lg-4">

        <div class="card login-card p-4">
            <div class="text-center mb-4 logo">

                <!-- NEWS PORTAL SVG LOGO -->
                <svg viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
                    <rect x="20" y="20" width="260" height="260" rx="40" fill="#2563EB"/>
                    <rect x="80" y="80" width="140" height="140" rx="16" fill="#F8FAFC"/>
                    <rect x="95" y="95" width="110" height="12" rx="6" fill="#0F172A"/>
                    <rect x="95" y="120" width="90" height="8" rx="4" fill="#475569"/>
                    <rect x="95" y="138" width="110" height="8" rx="4" fill="#475569"/>
                    <circle cx="150" cy="185" r="16" fill="#2563EB"/>
                </svg>

                <h4 class="mt-3 fw-bold">News Portal</h4>
                <p class="text-muted mb-0">Login to your account</p>
            </div>

            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" placeholder="Enter email" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter password" required>
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>

                <!-- Button -->
                <div class="d-grid">
                    <button class="btn btn-primary btn-lg">Log In</button>
                </div>

                <!-- Forgot -->
                {{-- <div class="text-center mt-3">
                    <a href="#" class="text-decoration-none text-muted">
                        Forgot your password?
                    </a>
                </div> --}}
            </form>

        </div>
    </div>
</div>

</body>
</html>
