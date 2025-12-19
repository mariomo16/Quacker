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
            cursor: pointer;
        }

        
        div.quackea,
        div.quashea,
        div.quasheados {
            position: fixed;
            left: 20px;
            transition: all 0.2s ease;
        }

        div.quackea { top: 20px; }
        div.quashea { top: 100px; }
        div.quasheados { top: 200px; }

        div.quackea:hover,
        div.quashea:hover,
        div.quasheados:hover {
            transform: scale(1.1);
        }

        div.quackea p,
        div.quashea p,
        div.quasheados p {
            font-size: 2rem;
            background-color: lightblue;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            margin: 0;
        }

        div.quackea a,
        div.quashea a,
        div.quasheados a {
            text-decoration: none;
        }

        
        .user-box {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border-radius: 10px;
            padding: 10px 12px;
            box-shadow: 5px 5px 5px rgb(0, 0, 0, 0.2);
            text-align: right;
        }

        .user-box p {
            margin: 0 0 8px 0;
            font-weight: bold;
        }

        .user-box small {
            font-weight: normal;
            opacity: 0.7;
        }

        .welcome {
            position: fixed;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 10px 16px;
            border-radius: 12px;
            box-shadow: 5px 5px 5px rgb(0, 0, 0, 0.2);
            display: flex;
            gap: 10px;
            align-items: center;
            z-index: 9999;
        }

        .welcome-user {
            opacity: 0.7;
            font-size: 0.9rem;
        }

        .logout-form {
            margin: 0;
        }

    </style>
</head>

<body>
@auth
    <div class="welcome">
        Bienvenido <strong>{{ auth()->user()->display_name }}</strong>
        <span class="welcome-user">&commat;{{ auth()->user()->username }}</span>

        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </div>
@endauth


    <main>
        @foreach ($quacks as $quack)
            <article>
                <h3>{{ $quack->display_name }} ({{ $quack->created_at }})</h3>
                <p>{{ $quack->content }}</p>
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
    <div class="quashea">
        <p><a href="/quashtags/create">new #</a></p>
    </div>
    <div class="quasheados">
        <p><a href="/quashtags">#??</a></p>
    </div>

</body>
</html>
