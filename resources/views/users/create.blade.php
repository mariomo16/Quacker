<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regístrate en Quacker / Quacker</title>
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
        <form action="/users" method="POST">
            <label>
                Nombre: <input type="text" name="display_name" placeholder="Nombre">
            </label><br>
            <label>
                Nombre de usuario: <input type="text" name="username" placeholder="Nombre de usuario">
            </label><br>
            <label>
                Correo electrónico: <input type="email" name="email" placeholder="Correo electrónico">
            </label><br>
            <label>
                Contraseña: <input type="password" name="password" placeholder="Contraseña">
            </label><br>
            <button>Completar registro</button>
            @csrf
        </form>
    </main>
</body>

</html>