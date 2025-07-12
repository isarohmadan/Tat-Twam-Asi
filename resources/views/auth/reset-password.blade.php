<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <!-- Menautkan CSS untuk Reset Password -->
    <link href="{{ asset('css/reset-password.css') }}" rel="stylesheet" />
</head>

<body>

    <div class="container" id="container">
        <!-- RESET PASSWORD FORM -->
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <h1>Perbarui Password</h1>
                <span>Masukkan Email dan Password Baru</span>

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

                <input type="password" name="password" placeholder="Password Baru" required />

                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" required />

                <button type="submit">Perbarui Password</button>
            </form>
        </div>
    </div>

</body>

</html>
