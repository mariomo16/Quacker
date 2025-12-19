<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuario / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        <form method="POST" action="/users" class="resource-form">
            @csrf
            <label>
                <span class="text-muted">Nombre</span>
                @error('display_name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="text" name="display_name" placeholder="Usuario Quacker" value="{{ old('display_name') }}"
                    required>
            </label>
            <label>
                <span class="text-muted">Nombre de usuario</span>
                @error('username')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="text" name="username" placeholder="usuario_quacker" value="{{ old('username') }}"
                    required>
            </label>
            <label>
                <span class="text-muted">Correo electrónico</span>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="email" name="email" placeholder="usuario@quacker.es" value="{{ old('email') }}"
                    required>
            </label>
            <label>
                <span class="text-muted">Contraseña</span>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="password" name="password" placeholder="P@ssw0rd" required>
            </label>
            <div class="resource-actions resource-actions--end">
                <a href="/users" class="btn-cancel">Cancelar</a>
                <button class="btn-save">Crear usuario</button>
            </div>
        </form>
    </main>
</body>

</html>
