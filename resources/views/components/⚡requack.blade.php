<?php

use Livewire\Component;
use App\Models\Quack;

new class extends Component {
    public int $quackId;
    public bool $authHasRequacked;
    public int $requackCount;

    public function mount(int $quackId)
    {
        $this->quackId = $quackId;
        $this->refreshData();
    }

    public function requack()
    {
        Quack::find($this->quackId)
            ->requacks()
            ->toggle(auth()->id());
        $this->refreshData();
    }

    public function refreshData()
    {
        $quack = Quack::withCount('requacks')
            ->withExists(['requacks as has_requacked' => fn($q) => $q->where('user_id', auth()->id())])
            ->find($this->quackId);
        $this->requackCount = $quack->requacks_count;
        $this->authHasRequacked = $quack->has_requacked;
    }
};
?>

<button wire:click="requack" class="quack-requack">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="{{ $authHasRequacked ? 'hsl(160, 100%, 36%)' : 'currentColor' }}" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
    </svg>
    {{ $requackCount }}
</button>
