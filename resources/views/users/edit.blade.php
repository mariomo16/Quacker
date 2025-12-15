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
                <span class="text-muted">Nombre</span><input type="text" name="display_name"
                    placeholder="Usuario Quacker" value="{{ $user->display_name }}" required>
            </label>
            <label>
                <span class="text-muted">Nombre de usuario</span>
                <input type="text" name="username" placeholder="usuario_quacker" value="{{ $user->username }}"
                    required>
            </label>
            <label>
                <span class="text-muted">Correo electrónico</span>
                <input type="text" name="email" placeholder="usuario@quacker.es" value="{{ $user->email }}"
                    required>
            </label>
            <div class="resource-actions resource-actions--end">
                <a href="/users" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Guardar</button>
            </div>
        </form>
    </main>
</body>

</html>
