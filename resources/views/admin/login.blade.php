<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Login | Pak Namak Dashboard</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
</head>
<body>
<div class="auth">
    <div class="auth-card">
        <img src="{{ asset('images/logo.png') }}" alt="Pak Namak" class="logo">
        <h1>Dashboard Login</h1>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="field">
                <label class="check"><input type="checkbox" name="remember" value="1"> Remember me</label>
            </div>
            <button class="btn" type="submit">Log in</button>
        </form>
        <p style="text-align:center;margin:18px 0 0"><a href="{{ route('home') }}">← Back to website</a></p>
    </div>
</div>
</body>
</html>
