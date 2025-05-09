<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container" id="container">
    <!-- REGISTER FORM -->
    <div class="form-container sign-up-container">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h1>Create Account</h1>
            <span>or use your email for registration</span>

            @if ($errors->any())
                <div class="alert alert-danger" style="color: red;">
                    <ul style="padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required />
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
            <button type="submit">Sign Up</button>
        </form>
    </div>

    <!-- LOGIN FORM -->
    <div class="form-container sign-in-container">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <h1>Sign in</h1>
            <span>or use your account</span>

            @if ($errors->any())
                <div class="alert alert-danger" style="color: red;">
                    <ul style="padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <a href="#">Forgot your password?</a>
            <button type="submit">Sign In</button>
        </form>
    </div>

    <!-- OVERLAY PANEL -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/auth.js') }}"></script>

</body>
</html>
