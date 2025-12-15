<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quack {{ $quack->id }} / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        <form method="POST" action="/quacks/{{ $quack->id }}" class="resource-form">
            @csrf
            @method('PATCH')
            <label>
                <span class="text-muted">Quack, quack, ¿qué pasa?</span>
            </label>
            <textarea name="content" required>{{ $quack->content }}</textarea>
            <div class="resource-actions resource-actions--end">
                <a href="/quacks" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Guardar</button>
            </div>
        </form>
    </main>
</body>

</html>
