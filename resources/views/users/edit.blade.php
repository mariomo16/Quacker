<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quacks</title>
</head>

<body>
    <main>
        <form action="/users/{{ $quack->id }}" method="POST">
            <label>
                Nick: <input type="text" name="nickname" placeholder="Nombre de usuario" value="{{ $quack->nickname }}">
            </label><br>
            <textarea name="contenido" placeholder="Escribe tu Quack"rows="3" cols="30">{{ $quack->contenido }}</textarea><br>
            <button>¡Quackea o muere!</button>
            @csrf
            @method('PATCH')
        </form>
    </main>
</body>

</html>
