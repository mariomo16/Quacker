<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear quashtag / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <main>
        <form method="POST" action="/quashtags" class="resource-form">
            @csrf
            <label>
                <span class="text-muted">Quashtag</span>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="text" name="name" placeholder="QuackerEsMejorQueX" value="{{ old('name') }}"
                    required>
            </label>
            <div class="form-actions">
                <a href="/quashtags">Cancelar</a>
                <button type="submit">Crear quashtag</button>
            </div>
        </form>
    </main>
</body>

</html>
