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
        <article class="show">
            <p>{{ $user->display_name }}</p>
            <p><span class="text-muted">{{ '@' }}{{ $user->username }}</span></p>
            <p class="user-content"><span class="text-muted">Correo electrónico: {{ $user->email }}</span></p>
            <p class="user-content"><span class="text-muted">Se unió en {{ $user->created_at->isoFormat('MMMM') }} de
                    {{ $user->created_at->isoFormat('YYYY') }}</span></p>

            <div class="resource-actions">
                <a href="/users">Volver</a>
                <a href="/users/{{ $user->id }}/edit">Editar</a>
                <form method="POST" action="/users/{{ $user->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete">Eliminar</button>
                </form>
            </div>
        </article>
    </main>
</body>

</html>
