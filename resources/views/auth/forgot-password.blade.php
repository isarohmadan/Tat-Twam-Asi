<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <!-- Menautkan CSS untuk Forgot Password -->
    <link href="{{ asset('css/forgot-password.css') }}" rel="stylesheet" />

</head>

<body>

    <div class="container" id="container">
        <!-- FORGOT PASSWORD FORM -->
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <h1>Lupa Password?</h1>
                <span>Masukkan Untuk Membuat Password Baru</span>

                @if ($errors->any())
                    <div class="alert alert-danger" style="color: red;">
                        <ul style="padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />

                @if (session('status'))
                    <div class="alert alert-success mt-3">{{ session('status') }}</div>
                @endif

                <button type="submit">Kirim Link Ke Email</button>
            </form>
        </div>

</body>

</html>
