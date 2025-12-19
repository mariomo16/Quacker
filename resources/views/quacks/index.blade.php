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

        div.quackea {
            position: fixed;
            top: 20px;
            left: 20px;
            transition: all 0.2s ease;
        }

        div.quackea:hover {
            transform: scale(1.1);
        }

        div.quackea p {
            font-size: 2rem;
            background-color: lightblue;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
        }

        div.quackea a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <main>
        @foreach ($quacks as $quack)
            <article>
                <h3>{{ $quack->nickname }} ({{ $quack->created_at }})</h3>
                <p>{{ $quack->contenido }}</p>
                <p><a href="/quacks/{{ $quack->id }}">Ver más detalles</a></p>
                <form action="/quacks/{{ $quack->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Eliminar</button>
                </form>
                <p><a href="/quacks/{{ $quack->id }}/edit">Editar</a></p>
            </article>
        @endforeach
    </main>
    <div class="quackea">
        <p><a href="/quacks/create">🦆</a></p>
    </div>
</body>

</html>
