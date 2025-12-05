<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quashtags Disponibles</title>
</head>

<body>
    <main>
        @foreach ($quashtags as $quashtag)
            <article>
                <h3>{{ $quashtag->name }} ({{ $quashtag->created_at }})</h3>
                <form action="/quashtags/{{ $quashtag->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Eliminar</button>
                </form>
                
            </article>
        @endforeach
        <p><a href="/quacks">Volver</a></p>
    </main>
</body>

</html>
