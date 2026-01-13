<x-layouts.app title="Crear quashtag" :route="route('quashtags.create')">

    @section('main')
        <section class="resource-section">
            <form method="POST" action="{{ route('quashtags.store') }}" class="resource-form">
                @csrf
                <div class="input-group">
                    <span class="quashtag-quack"></span>
                    <input type="text" class="quashtag-input" id="name" name="name" value="{{ old('name') }}"
                        placeholder=" " required>
                    <label for="name">
                        <span class="text-muted">Quashtag</span>
                    </label>
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-actions">
                    <a href="{{ route('quashtags.index') }}">Cancelar</a>
                    <button type="submit">Crear quashtag</button>
                </div>
            </form>
        </section>
    @endsection

</x-layouts.app>
