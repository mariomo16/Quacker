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
                <span class="text-muted">Nombre</span>
                <input type="text" name="display_name" placeholder="usuario_quacker" value="{{ old('display_name') }}"
                    required>
            </label>
            <label>
                <span class="text-muted">Quack, quack, ¿qué pasa?</span>
            </label>
            <textarea name="content" required>{{ old('content') }}</textarea>
            <div class="resource-actions resource-actions--end">
                <a href="/quacks" class="btn-cancel">Cancelar</a>
                <button class="btn-save">Crear quack</button>
            </div>
        </form>
    </main>
</body>

</html>
