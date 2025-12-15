<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quashtags / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        @foreach ($quashtags as $quashtag)
            <article>
                <p>🦆{{ $quashtag->name }} <span class="text-muted">ID: {{ $quashtag->id }}</span></p>
                <div class="resource-actions">
                    <a href="/quashtags/{{ $quashtag->id }}">Mostrar más</a>
                    <a href="/quashtags/{{ $quashtag->id }}/edit">Editar</a>
                    <form method="POST" action="/quashtags/{{ $quashtag->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </div>
            </article>
        @endforeach
    </main>
    <nav class="nav-menu">
        <a href="/quashtags/create">➕</a>
        <a href="/users">👤</a>
        <a href="/quacks">🦆</a>
    </nav>
</body>

</html>
