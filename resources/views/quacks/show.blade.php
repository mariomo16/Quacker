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
    </style>
</head>

<body>
    <main>
        <article>
            <h3>{{ $quack->display_name }} ({{ $quack->created_at }})</h3>
            <p>{{ $quack->content }}</p>
            <p><a href="/quacks">Volver</a></p>
        </article>
    </main>
</body>

</html>