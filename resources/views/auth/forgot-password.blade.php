<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
    </div>
    @if (session('status'))
        <div class="alert alert-success mt-3">{{ session('status') }}</div>
    @endif
    <button type="submit" class="btn btn-primary">Kirim Link Reset Password</button>
</form>
