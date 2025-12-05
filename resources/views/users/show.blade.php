<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quacks</title>
</head>

<body>
    <main>
        <article>
            <h3>{{ $user->nickname }} ({{ $user->created_at }})</h3>
            <p>{{ $user->email }}</p>
            <p><a href="/users">Volver</a></p>
        </article>
    </main>
</body>

</html>
