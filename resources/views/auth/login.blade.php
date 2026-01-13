<x-layouts.app title="Iniciar sesión">

    @section('main')
        <section class="auth-section">
            <form method="POST" action="{{ route('login') }}" class="auth-form unselectable">
                @csrf
                <div class="input-group">
                    <input type="email" id="email" name="email" autocomplete="email" placeholder=" " required>
                    <label for="email">
                        <span class="text-muted">Correo electrónico</span>
                    </label>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder=" " required>
                    <label for="password">
                        <span class="text-muted">
                            Contraseña</span>
                    </label>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    <div class="show-hide-password">
                        <x-icon.eye />
                    </div>
                </div>
                <button type="submit">Iniciar sesión</button>
                <p class="auth-redirect">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
                </p>

                <div class="divider">
                    <p>Usuario de prueba</p>
                </div>

                <div class="auth-credentials">
                    <p><span class="text-muted">Correo electrónico: </span><b><span
                                class="selectable">admin@quacker.es</span></b>
                    </p>
                    <p><span class="text-muted">Contraseña: </span><b><span class="selectable">Admin123</span></b></p>
                </div>
            </form>
        </section>
    @endsection

</x-layouts.app>
