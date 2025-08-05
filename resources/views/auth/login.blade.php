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
                <h1>Buat Akun</h1>
                <span>masukkan beberapa data dibawah</span>

                @if ($errors->any())
                    <div class="alert alert-danger" style="color: red;">
                        <ul style="padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required />
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="password" name="password_confirmation" placeholder="Ulang Password" required />
                <button type="submit">Daftar</button>
            </form>
        </div>

        <!-- LOGIN FORM -->
        <div class="form-container sign-in-container">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h1>Masuk</h1>
                <span>menggunakan akun anda</span>

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
                <a href="{{ route('password.request') }}">Lupa password?</a>
                <button type="submit">Masuk</button>
            </form>
        </div>

        <!-- OVERLAY PANEL -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Selamat Datang!</h1>
                    <p>Masuk Jika Anda Sudah Mempunyai Akun Sebelumnya</p>
                    <button class="ghost" id="signIn">Masuk</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Selamat Datang!</h1>
                    <p>Silahkan melakukan Pendaftaran Akun Untuk Mengakses Fitur Pengajuan</p>
                    <button class="ghost" id="signUp">Daftar Sekarang</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>

</body>

</html>
