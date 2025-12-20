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
        <form method="POST" action="/quashtags/{{ $quashtag->id }}" class="resource-form">
            @csrf
            @method('PATCH')
            <label>
                <span class="text-muted">Quashtag</span>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <input type="text" name="name" placeholder="QuackerEsMejorQueX" value="{{ $quashtag->name }}"
                    required>
            </label>
            <div class="form-actions">
                <a href="/quashtags">Cancelar</a>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </main>
</body>

</html>
