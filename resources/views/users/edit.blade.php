<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ '@' }}{{ $user->username }} / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        <form method="POST" action="/users/{{ $user->id }}" class="resource-form">
            @csrf
            @method('PATCH')
            <label>
                <span class="text-muted">Nombre</span>
                @error('display_name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="text" name="display_name" placeholder="Usuario Quacker" value="{{ $user->display_name }}"
                    maxlength="50" required>
            </label>
            <label>
                <span class="text-muted">Nombre de usuario</span>
                @error('username')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="text" name="username" placeholder="usuario_quacker" value="{{ $user->username }}"
                    maxlength="15" required>
            </label>
            <label>
                <span class="text-muted">Correo electrónico</span>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="email" name="email" placeholder="usuario@quacker.es" value="{{ $user->email }}"
                    required>
            </label>
            <label>
                <span class="text-muted">Contraseña</span>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="password" name="password" placeholder="P@ssw0rd" required>
            </label>
            <div class="form-actions">
                <a href="/users">Cancelar</a>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </main>
</body>

</html>
