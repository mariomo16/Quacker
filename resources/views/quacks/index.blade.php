<x-layouts.app title="Quacks" {{-- :route="route('quacks.create')" --}}>

    @section('main')
        @if (request()->routeIs('feed'))
            <form method="POST" action="{{ route('quacks.store') }}" class="feed-form">
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
                    <button type="submit">Postear</button>
                </div>
            </form>
        @endif
        @foreach ($quacks as $quack)
            <article class="index">
                <div class="quack-user-avatar select-none">
                    {{ Str::of(strtoupper($quack->user->display_name))->substr(0, 1) }}
                </div>

                <div class="quack-content">
                    <div class="flex gap-1">
                        @if ($quack->user->email_verified_at)
                            <x-icon.verified />
                        @endif
                        <a href="{{ route('user.quacks', $quack->user_id) }}">
                            <strong class="hover:underline">{{ $quack->user->display_name }}</strong>
                            <span class="text-muted">{{ '@' }}{{ $quack->user->username }}</span>
                        </a>
                        <span class="text-muted">
                            · <time>{{ $quack->created_at->diffForHumans(null, true, true, 1) }}</time>
                        </span>
                    </div>

                    <p>{{ $quack->content }}</p>
                    <div class="flex mt-2 text-(--accent) gap-1.5">
                        @foreach ($quack->quashtags as $quashtag)
                            <a class="hover:text-(--accent-hover) hover:underline"
                                href="{{ route('quashtag.quacks', $quashtag->id) }}">#{{ $quashtag->name }}</a>
                        @endforeach
                    </div>

                    <div class="quack-toolbar select-none">
                        <div class="quack-social">
                            <livewire:quav :quackId="$quack->id" />
                            <livewire:requack :quackId="$quack->id" />
                        </div>

                        <div class="quack-actions">
                            @can('manage', $quack)
                                <form method="POST" action="{{ route('quacks.destroy', $quack) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                                <a href="{{ route('quacks.edit', $quack) }}">Editar</a>
                            @endcan
                            <a href="{{ route('quacks.show', $quack) }}">Mostrar más</a>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    @endsection

</x-layouts.app>
