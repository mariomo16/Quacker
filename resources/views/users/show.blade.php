<x-layouts.app :title="'@' . $user->username" {{-- :route="route('users.create')" --}}>

    @section('main')
        <article class="user-show">
            <div class="user-user-avatar select-none">
                {{ Str::of(strtoupper($user->display_name))->substr(0, 1) }}
            </div>

            <div class="user-card">
                <div class="user-info">
                    <p>
                    <div class="user-popularity select-none">
                        <div class="user-quack">
                            <x-icon.quack />
                            {{ $user->quacks_count }}
                        </div>
                        <div class="user-quav">
                            <x-icon.quav />
                            {{ $user->quavs_count }}
                        </div>
                        <div class="user-requack">
                            <x-icon.requack />
                            {{ $user->requacks_count }}
                        </div>
                    </div>
                    <div class="user-name">
                        @if ($user->email_verified_at)
                            <x-icon.verified />
                        @endif
                        <strong>{{ $user->display_name }}</strong>
                        <span class="text-muted">{{ '@' }}{{ $user->username }}</span>
                    </div>
                    </p>
                    <p>
                        <span class="text-muted">Correo electrónico: {{ $user->email }}</span>
                    </p>
                    <p>
                        <span class="text-muted">Se unió en {{ $user->created_at->isoFormat('MMMM') }} de
                            {{ $user->created_at->isoFormat('YYYY') }}
                        </span>
                    </p>
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
                        <a href="{{ route('users.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </article>
    @endsection

</x-layouts.app>
