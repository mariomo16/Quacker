<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Iniciar Sesión</h2>

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<form action="/login" method="POST">
    @csrf

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Entrar</button>
</form>

<br>
<a href="{{ route('register') }}">Crear cuenta</a>


</body>
</html>