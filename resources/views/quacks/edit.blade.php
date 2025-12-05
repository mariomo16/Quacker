<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quacks</title>
    <style>
        main {
            width: 80%;
            margin: 0 auto;
        }

        button {
            border-radius: 10px;
            padding: 5px 10px;
            border: none;
            background-color: lightblue;
        }
    </style>
</head>

<body>
    <main>
        <form action="/quacks/{{ $quack->id }}" method="POST">
            <label>
                Nick: <input type="text" name="display_name" placeholder="Nombre" value="{{ $quack->display_name }}">
            </label><br>
            <textarea name="content" placeholder="Escribe tu Quack" rows="3"
                cols="30">{{ $quack->content }}</textarea><br>
            <button>¡Quackea o muere!</button>
            @csrf
            @method('PATCH')
        </form>
    </main>
</body>

</html>