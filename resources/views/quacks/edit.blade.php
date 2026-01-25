<x-layouts.app :title="'Quack ' . $quack->id" :route="route('quacks.create')">

    @section('main')
        <section class="resource-section">
            <form method="POST" action="{{ route('quacks.update', $quack) }}" class="resource-form">
                @csrf
                @method('PATCH')
                <div class="input-group">
                    <textarea name="content" placeholder=" " maxlength="280" required>{{ $quack->content }}</textarea>
                    <label class="textarea-label select-none">
                        <span class="text-muted">Quack, quack, ¿qué pasa?</span>
                    </label>
                    @error('content')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions select-none">
                    <a href="{{ route('quacks.index') }}">Cancelar</a>
                    <button type="submit">Guardar</button>
                </div>
            </form>
        </section>
    @endsection

</x-layouts.app>
