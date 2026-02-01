<?php

use Livewire\Component;
use App\Models\Quack;

new class extends Component {
    public int $quackId;
    public bool $hasAuthQuaved;
    public int $quavsCount;

    public function mount(int $quackId)
    {
        $this->quackId = $quackId;
        $this->refreshData();
    }

    public function toggleQuav()
    {
        auth()->user()->quavs()->toggle($this->quackId);
        $this->refreshData();
    }

    public function refreshData()
    {
        $quack = Quack::withCount('quavs')
            ->withExists(['quavs as has_quaved' => fn($q) => $q->where('user_id', auth()->id())])
            ->find($this->quackId);
        $this->quavsCount = $quack->quavs_count;
        $this->hasAuthQuaved = $quack->has_quaved;
    }
};
?>

<button wire:click="toggleQuav" class="quack-quav">
    <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $hasAuthQuaved ? 'hsl(332, 93%, 53%)' : 'none' }}" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="{{ $hasAuthQuaved ? 'hsl(332, 93%, 53%)' : 'currentColor' }}" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
    </svg>
    {{ $quavsCount }}
</button>
