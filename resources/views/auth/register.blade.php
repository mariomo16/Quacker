<form method="POST" action="/register">
    @csrf

    <input type="text" name="display_name" placeholder="Nombre visible" required>
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="email" name="email" placeholder="Email" required>

    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="password" name="password_confirmation" placeholder="Repite contraseña" required>

    <button type="submit">Registrarse</button>
</form>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
</form>
