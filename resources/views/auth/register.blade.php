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
        <form method="POST" action="/register" class="resource-form login">
            @csrf
            <label>
                <span class="text-muted">Nombre</span>
                @error('display_name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="text" name="display_name" placeholder="Usuario Quacker" required>
            </label>
            <label>
                <span class="text-muted">Nombre de usuario</span>
                @error('username')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="text" name="username" placeholder="usuario_quacker" required>
            </label>
            <label>
                <span class="text-muted">Correo electrónico</span>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="email" name="email" placeholder="usuario@quacker.es" required>
            </label>
            <label>
                <span class="text-muted">Contraseña</span>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="password" name="password" placeholder="P@ssw0rd" required>
            </label>
            <label>
                <span class="text-muted">Repite la contraseña</span>
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="password" name="password_confirmation" placeholder="P@ssw0rd" required>
            </label>
            <button type="submit" class="btn-login">Registrarse</button>
            <p class="auth-text">¿Ya tienes cuenta? <a href="/login">Inicia sesión</a></p>
        </form>
    </main>
</body>

</html>
