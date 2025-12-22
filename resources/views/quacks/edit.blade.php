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
                @error('content')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </label>
            <textarea name="content" maxlength="280" required>{{ $quack->content }}</textarea>
            <div class="form-actions">
                <a href="/quacks">Cancelar</a>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </main>
</body>

</html>
