<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAKAD Sederhana</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-login {
            width: 100%;
            padding: 0.7rem;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .error-text {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 0.2rem;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            padding: 0.7rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h2>SIAKAD Login</h2>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda">
                @error('email')
                <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda">
                @error('password')
                <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>
    </div>

</body>

</html>