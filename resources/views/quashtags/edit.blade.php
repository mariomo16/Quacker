<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu cuenta / Quacker</title>
    <style>
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
        <form action="/quashtags/{{ $quashtag->id }}" method="POST">
            <label>
                Editar quashtag: <input type="text" name="name" placeholder="quashtag" value="{{ $quashtag->name }}">
            </label><br>
            <button>Guardar</button>
            @csrf
            @method('PATCH')
        </form>
    </main>
</body>

</html>
