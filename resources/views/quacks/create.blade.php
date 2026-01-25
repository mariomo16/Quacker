<x-layouts.app title="Crear quack" :route="route('quacks.create')">

    @section('main')
        <section class="resource-section">
            <form method="POST" action="{{ route('quacks.store') }}" class="resource-form">
                @csrf
                <div class="input-group">
                    <textarea name="content" maxlength="280" placeholder=" " required>{{ old('content') }}</textarea>
                    <label class="textarea-label select-none">
                        <span class="text-muted">Quack, quack, ¿qué pasa?</span>
                    </label>
                    @error('content')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions select-none">
                    <a href="{{ url()->previous(route('quacks.index')) }}">Cancelar</a>
                    <button type="submit">Crear quack</button>
                </div>
            </form>
        </section>
    @endsection

</x-layouts.app>
