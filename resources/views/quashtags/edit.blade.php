<x-layouts.app :title="'🦆' . $quashtag->name" :route="route('quashtags.create')">

    @section('main')
        <section class="resource-section">
            <form method="POST" action="{{ route('quashtags.update', $quashtag) }}" class="resource-form">
                @csrf
                @method('PATCH')
                <div class="input-group">
                    <span class="quashtag-quack"></span>
                    <input type="text" class="quashtag-input" id="name" name="name" value="{{ $quashtag->name }}"
                        placeholder=" " required>
                    <label>
                        <span class="text-muted select-none">Quashtag</span>
                    </label>
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions select-none">
                    <a href="{{ route('quashtags.index') }}">Cancelar</a>
                    <button type="submit">Guardar</button>
                </div>
            </form>
        </section>
    @endsection

</x-layouts.app>
