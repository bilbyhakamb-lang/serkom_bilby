<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SMAN 7 TASIKMALAYA</title>

    <!-- SEO -->
    <meta name="description" content="Login KasFlow Dashboard Administrasi">
    <meta name="author" content="KasFlow Team">

    <!-- Favicon -->
    <link rel="icon" type="images/png"href="{{ asset('assets/images/sma7.png') }}">
    

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>

    <!-- Login Container -->
    <div class="login-wrapper">

        <!-- Background Shapes -->
        <div class="login-bg-shape login-bg-shape-1"></div>
        <div class="login-bg-shape login-bg-shape-2"></div>

        <!-- Login Card -->
        <div class="login-card">

            <!-- Brand -->
            <a href="{{ url('/') }}" class="login-brand text-decoration-none">
                <img src="{{ asset('assets/images/sma7.png') }}" alt="Logo Sekolah" class="logo-sekolah">
                <span>SMAN 7 TASIKMALAYA</span>
            </a>

            <p class="login-subtitle">
                Please sign in to access your dashboar  d
            </p>

            <!-- Login Form -->
            <form
                action="{{ route('login.process') }}"
                method="POST"
                id="loginForm"
                class="needs-validation"
            >
                @csrf

                <!-- Email -->
                <div class="login-form-group">

                    <label for="email" class="login-form-label">
                        Email
                    </label>

                    <div class="login-input-group">
                        <i class="bi bi-envelope input-icon"></i>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="login-input"
                            placeholder="name@company.com"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <!-- Password -->
                <div class="login-form-group">

                    <label for="password" class="login-form-label">
                        Password
                    </label>

                    <div class="login-input-group">

                        <i class="bi bi-shield-lock input-icon"></i>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="login-input login-input-password"
                            placeholder="••••••••"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle-btn"
                            id="toggle-password"
                            aria-label="Show password"
                        >
                            <i class="bi bi-eye"></i>
                        </button>

                    </div>

                    @error('password')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <!-- Options -->

                <!-- Login Button -->
                <button
                    type="submit"
                    class="btn-login"
                    id="btn-submit"
                >
                    <span>Sign In to Dashboard</span>
                    <i class="bi bi-arrow-right"></i>
                </button>

            </form>

           
            <!-- Register -->
            <p class="login-footer-text">
                Don't have an account?
                <a href="#" id="link-register">
                    Register Now
                </a>
            </p>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Authentication JS -->
    <script src="{{ asset('assets/js/auth.js') }}"></script>

</body>

</html>