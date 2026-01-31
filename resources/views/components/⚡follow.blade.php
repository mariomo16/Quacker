<?php

use Livewire\Component;
use App\Models\User;

new class extends Component {
    public int $userId;
    public bool $authIsFollower;
    public int $followersCount;

    public function mount(int $userId)
    {
        $this->userId = $userId;
        $this->refreshData();
    }

    public function follow()
    {
        User::find($this->userId)
            ->followers()
            ->toggle(auth()->id());
        $this->refreshData();
    }

    public function refreshData()
    {
        $user = User::withCount('followers')
            ->withExists(['followers as has_followed' => fn($q) => $q->where('follower_id', auth()->id())])
            ->find($this->userId);
        $this->followersCount = $user->followers_count;
        $this->authIsFollower = $user->has_followed;
    }
};
?>

<button wire:click="follow" class="user-follow">
    @if ($authIsFollower)
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="hsl(204, 88%, 53%)" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
        </svg>
    @else
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
        </svg>
    @endif
    {{ $followersCount }}
</button>
