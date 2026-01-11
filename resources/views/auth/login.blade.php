<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Auth CSS -->
    <link rel="stylesheet" href="{{ asset('CSS/login.css') }}">
</head>
<body>

    <!-- Background -->
    <div class="page-background"></div>

    <div class="container">
        <div class="auth-card">

            <!-- Illustration -->
            <!-- <div class="illustration">
                <img src="https://mgx-backend-cdn.metadl.com/generate/images/701466/2026-01-04/54f3ae53-81f4-4561-82bd-15edf4218f6d.png"
                     alt="Login Illustration">
            </div> -->

            <h1>Welcome Back</h1>
            <!-- <p class="subtitle">Please login to your account</p> -->

            <!-- Status message -->
            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="auth-form" novalidate>
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        autofocus
                        class="@error('email') error @enderror"
                    >
                    <span class="error-message">
                        @error('email') {{ $message }} @enderror
                    </span>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                        class="@error('password') error @enderror"
                    >
                    <span class="error-message">
                        @error('password') {{ $message }} @enderror
                    </span>
                </div>

                <!-- Remember / Forgot -->
                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>

                    <!-- Forgot password (disabled) -->
                    <a href="#" class="link" onclick="return false;">Forgot password?</a>

                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary btn-full">
                    Login
                </button>

                <!-- Footer -->
                <p class="form-footer">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="link">Register here</a>
                </p>

            </form>
        </div>
    </div>

</body>
</html>
