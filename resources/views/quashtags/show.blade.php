<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🦆{{ $quashtag->name }} / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        <article class="show">
            <p>🦆{{ $quashtag->name }} <span class="text-muted">ID: {{ $quashtag->id }}</span></p>
            <p><span class="text-muted">Creado en {{ $quashtag->created_at->isoFormat('MMMM') }} de
                    {{ $quashtag->created_at->isoFormat('YYYY') }}</span></p>
            <div class="resource-actions">
                <a href="{{ route('quashtags.index') }}">Volver</a>
                <a href="{{ route('quashtags.edit', $quashtag) }}">Editar</a>
                <form method="POST" action="{{ route('quashtags.destroy', $quashtag) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete">Eliminar</button>
                </form>
            </div>
        </article>
    </main>
</body>

</html>
