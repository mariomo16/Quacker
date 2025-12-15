<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        @foreach ($users as $user)
            <article>
                <p><b>{{ $user->display_name }}</b> <span
                        class="text-muted">{{ '@' }}{{ $user->username }}</span>
                </p>
                <div class="resource-actions">
                    <a href="/users/{{ $user->id }}">Mostrar más</a>
                    <a href="/users/{{ $user->id }}/edit">Editar</a>
                    <form method="POST" action="/users/{{ $user->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </div>
            </article>
        @endforeach
    </main>
    <nav class="nav-menu">
        <a href="/users/create">➕</a>
        <a href="/quacks">🦆</a>
        <a href="/quashtags">#️⃣</a>
    </nav>
</body>

</html>
