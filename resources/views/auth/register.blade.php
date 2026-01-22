<x-layouts.app title="Registrarse">

    @section('main')
        <section class="auth-section">
            <form method="POST" action="{{ route('register') }}" class="auth-form select-none">
                @csrf
                <div class="input-group">
                    <input type="text" id="display_name" name="display_name" value="{{ old('display_name') }}"
                        placeholder=" " maxlength="50" required>
                    <label for="display_name">
                        <span class="text-muted">Nombre</span>
                    </label>
                    @error('display_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <span class="username-arroba"></span>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder=" "
                        maxlength="15" required>
                    <label for="username">
                        <span class="text-muted">Nombre de usuario</span>
                    </label>
                    @error('username')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder=" "
                        required>
                    <label for="email">
                        <span class="text-muted">Correo electrónico</span>
                    </label>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder=" " minlength="6" required>
                    <label for="password">
                        <span class="text-muted">Contraseña</span>
                    </label>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    <div class="show-hide-password">
                        <x-icon.eye />
                    </div>
                </div>

                <div class="input-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder=" "
                        minlength="6" required>
                    <label for="password_confirmation">
                        <span class="text-muted">Repite la contraseña</span>
                    </label>
                    @error('password_confirmation')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit">Registrarse</button>
                <p class="auth-redirect">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
            </form>
        </section>
    @endsection

</x-layouts.app>
