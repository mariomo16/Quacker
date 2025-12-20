<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear quack / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        <form method="POST" action="/quacks" class="resource-form">
            @csrf
            <label>
                <span class="text-muted">Quack, quack, ¿qué pasa?</span>
                @error('content')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </label>
            <textarea name="content" required>{{ old('content') }}</textarea>
            <div class="form-actions">
                <a href="/quacks">Cancelar</a>
                <button type="submit">Crear quack</button>
            </div>
        </form>
    </main>
</body>

</html>
