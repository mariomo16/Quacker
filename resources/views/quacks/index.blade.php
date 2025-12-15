<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quacks / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        @foreach ($quacks as $quack)
            <article>
                <p><b>{{ $quack->display_name }}</b> <span
                        class="text-muted">{{ '@' }}{{ $quack->display_name }}
                        ·
                        {{ $quack->created_at->diffForHumans(null, true, true, 1) }}</span></p>
                <p>{{ $quack->content }}</p>
                <div class="resource-actions">
                    <a href="/quacks/{{ $quack->id }}">Mostrar más</a>
                    <a href="/quacks/{{ $quack->id }}/edit">Editar</a>
                    <form method="POST" action="/quacks/{{ $quack->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </div>
            </article>
        @endforeach
    </main>
    <nav class="nav-menu">
        <a href="/quacks/create">➕</a>
        <a href="/users">👤</a>
        <a href="/quashtags">#️⃣</a>
    </nav>
</body>

</html>
