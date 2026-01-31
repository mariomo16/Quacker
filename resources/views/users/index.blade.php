<x-layouts.app title="Usuarios" {{-- :route="route('users.create')" --}}>

    @section('main')
        @foreach ($users as $user)
            <article class="index">
                <div class="quack-user-avatar select-none">
                    {{ Str::of(strtoupper($user->display_name))->substr(0, 1) }}
                </div>

                <div class="user-card">
                    <div class="user-info">
                        <div>
                            <div class="user-popularity select-none">
                                <div class="user-quack">
                                    <x-icon.quack />
                                    {{ $user->quacks_count }}
                                </div>
                                <div class="user-quav">
                                    <x-icon.quav />
                                    {{ $user->quavs_count? : '0' }}
                                </div>
                                <div class="user-requack">
                                    <x-icon.requack />
                                    {{ $user->requacks_count? : '0' }}
                                </div>
                            </div>
                            <div class="user-name">
                                @if ($user->email_verified_at)
                                    <x-icon.verified />
                                @endif
                                <strong>{{ $user->display_name }}</strong>
                                <span class="text-muted">{{ '@' }}{{ $user->username }}</span>
                            </div>
                        </div>
                        <span class="text-muted">{{ $user->email }}</span>
                    </div>

                    <div class="user-toolbar select-none">
                        <div class="user-social">
                            <span class="text-muted">Seguidos: {{ $user->following_count }}</span>
                            @if ($user->id !== auth()->id())
                                <livewire:follow :userId="$user->id" />
                            @endif
                        </div>

                        <div class="user-actions">
                            @if ($user->id === auth()->user()->id)
                                <a href="{{ route('editMe') }}">Editar</a>
                            @endif
                            <a href="{{ route('users.show', $user) }}">Mostrar más</a>
                        </div>
                    </div>
                </div>

            </article>
        @endforeach
    @endsection

</x-layouts.app>
