<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios / Quacker</title>
    <style>
        main {
            width: 80%;
            margin: 0 auto;
        }

        article {
            background-color: lightcyan;
            padding: 10px;
            margin: 20px 0;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 5px 5px 5px rgb(0, 0, 0, 0.5);
        }

        article:hover {
            transform: scale(1.05);
            box-shadow: 10px 10px 10px rgb(0, 0, 0, 0.5);
        }

        button {
            border-radius: 10px;
            padding: 5px 10px;
            border: none;
            background-color: lightblue;
        }

        div.create-user {
            position: fixed;
            top: 20px;
            left: 20px;
            transition: all 0.2s ease;
        }

        div.create-user:hover {
            transform: scale(1.1);
        }

        div.create-user p {
            font-size: 2rem;
            background-color: lightblue;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
        }

        div.create-user a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <main>
        @foreach ($users as $user)
            <article>
                <h3>{{ $user->display_name }} {{ '@' }}{{ $user->username }}</h3>
                <p>{{ $user->email }}</p>
                <p><a href="/users/{{ $user->id }}">Perfil</a></p>
                <p><a href="/users/{{ $user->id }}/edit">Editar perfil</a></p>
                <form action="/users/{{ $user->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Eliminar</button>
                </form>
            </article>
        @endforeach
    </main>
    <div class="create-user">
        <p><a href="/users/create">🦆</a></p>
    </div>
</body>

</html>