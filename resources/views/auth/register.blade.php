<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        <form method="POST" action="/register" class="auth-form">
            @csrf
            <label>
                <span class="text-muted">Nombre</span>
                @error('display_name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="text" name="display_name" value="{{ old('display_name') }}" placeholder="Usuario Quacker"
                    maxlength="50" required>
            </label>
            <label>
                <span class="text-muted">Nombre de usuario</span>
                @error('username')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="text" name="username" value="{{ old('username') }}" placeholder="usuario_quacker"
                    maxlength="15" required>
            </label>
            <label>
                <span class="text-muted">Correo electrónico</span>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="email" name="email" value="{{ old('email') }}" placeholder="usuario@quacker.es"
                    required>
            </label>
            <label>
                <span class="text-muted">Contraseña</span>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="password" name="password" placeholder="P@ssw0rd" minlength="6" required>
            </label>
            <label>
                <span class="text-muted">Repite la contraseña</span>
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="password" name="password_confirmation" placeholder="P@ssw0rd" minlength="6" required>
            </label>
            <button type="submit">Registrarse</button>
            <p class="auth-redirect">¿Ya tienes cuenta? <a href="/login">Inicia sesión</a></p>
        </form>
    </main>
</body>

</html>
