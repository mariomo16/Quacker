<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quashtag Creacion</title>
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
        <form action="/quashtags" method="POST">
            <h1>CREA TU QUASHTAG!!!</h1>
            <textarea name="name" placeholder="No olvides tu #" rows="3" cols="30"></textarea><br>
            <button type="submit">Mu malo</button>
            @csrf
        </form>
    </main>
</body>

</html>
