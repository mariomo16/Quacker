<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu cuenta / Quacker</title>
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
        <form action="/users/{{ $user->id }}" method="POST">
            <label>
                Nombre: <input type="text" name="display_name" placeholder="Nombre" value="{{ $user->display_name }}">
            </label><br>
            <label>
                Nombre de usuario: <input type="text" name="username" placeholder="Nombre"
                    value="{{ $user->username }}">
            </label><br>
            <label>
                Correo electrónico: <input type="text" name="email" placeholder="Nombre" value="{{ $user->email }}">
            </label><br>
            <button>Guardar</button>
            @csrf
            @method('PATCH')
        </form>
    </main>
</body>

</html>
