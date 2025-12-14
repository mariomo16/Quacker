<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quashtags / Quacker</title>
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

        div.btn {
            position: fixed;
            left: 20px;
            transition: all 0.2 ease;
        }

        div.btn:hover {
            transform: scale(1.1);
        }

        div.btn p {
            font-size: 2rem;
            background-color: lightblue;
            margin: 0;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
        }

        div.btn a {
            text-decoration: none;
        }

        div.create-quashtag {
            top: 20px;
        }

        div.users {
            top: 100px;
        }

        div.quacks {
            top: 180px;
        }
    </style>
</head>

<body>
    <main>
        @foreach ($quashtags as $quashtag)
            <article>
                <h3>{{ $quashtag->name }} ({{ $quashtag->created_at }})</h3>
                <a href="/quashtags/{{ $quashtag->id }}">Mostrar más</a>
                <a href="/quashtags/{{ $quashtag->id }}/edit">Editar</a>
                <form action="/quashtags/{{ $quashtag->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Eliminar</button>
                </form>
            </article>
        @endforeach
    </main>
    <div class="btn create-quashtag">
        <p><a href="/quashtags/create">➕</a></p>
    </div>
    <div class="btn users">
        <p><a href="/users">👤</a></p>
    </div>
    <div class="btn quacks">
        <p><a href="/quacks">🦆</a></p>
    </div>
</body>

</html>
