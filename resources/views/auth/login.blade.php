<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <label>
                <span class="text-muted">Correo electrónico</span>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="email" name="email" required>
            </label>
            <label>
                <span class="text-muted">Contraseña</span>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="password" name="password" required>
            </label>
            <button type="submit">Iniciar sesión</button>
            <p class="auth-redirect">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
        </form>
    </main>
    <footer>
        <p><span class="text-muted">Correo electrónico: </span>admin@quacker.es</p>
        <p><span class="text-muted">Contraseña: </span> Admin123</p>
    </footer>
</body>

</html>
