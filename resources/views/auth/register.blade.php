<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('CSS/login.css') }}">
</head>
<body>
    <div class="page-background"></div>

    <div class="container">
        <div class="auth-card">
            <!-- <div class="illustration">
                <img src="https://mgx-backend-cdn.metadl.com/generate/images/701466/2026-01-04/1a52216a-a4b0-46d8-bf33-62511ef679f8.png" alt="Register Illustration">
            </div> -->

            <h1>Create Account</h1>
            <p class="subtitle">Sign up to get started</p>

            <form method="POST" action="{{ route('register') }}" class="auth-form" novalidate>
                @csrf

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your full name"
                        required
                        autofocus
                        class="@error('name') error @enderror"
                    >
                    <span class="error-message">
                        @error('name') {{ $message }} @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        class="@error('email') error @enderror"
                    >
                    <span class="error-message">
                        @error('email') {{ $message }} @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create a password"
                        required
                        class="@error('password') error @enderror"
                    >
                    <span class="error-message">
                        @error('password') {{ $message }} @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirm your password"
                        required
                        class="@error('password_confirmation') error @enderror"
                    >
                    <span class="error-message">
                        @error('password_confirmation') {{ $message }} @enderror
                    </span>
                </div>

                {{-- إذا تبغى خانة الشروط (UI فقط) --}}
                <div class="form-options" style="justify-content:flex-start;">
                    <label class="checkbox-label">
                        <input type="checkbox" required>
                        <span>I agree to the <a href="#" class="link">Terms & Conditions</a></span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Create Account</button>

                <p class="form-footer">
                    Already have an account?
                    <a href="{{ route('login') }}" class="link">Login here</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
