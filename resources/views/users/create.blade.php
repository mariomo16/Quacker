<x-layouts.app title="Crear usuario" :route="route('users.create')">

    @section('main')
        <section class="resource-section">
            <form method="POST" action="{{ route('users.store') }}" class="resource-form select-none">
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
                    <input type="password" id="password" name="password" placeholder=" " required>
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

                <div class="form-actions">
                    <a href="{{ url()->previous(route('users.index')) }}">Cancelar</a>
                    <button type="submit">Crear usuario</button>
                </div>
            </form>
        </section>
    @endsection

</x-layouts.app>
