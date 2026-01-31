<?php

namespace App\Http\Controllers;

use App\Models\Quack;

class FeedController extends Controller
{
    public function feed()
    {
        $userId = auth()->user()->id;

        return view('quacks.index', [
            'quacks' => Quack::with(['user', 'requacks'])
                ->withCount(['quavs', 'requacks'])
                ->where('user_id', $userId)
                ->orWhereHas('requacks', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->orWhereHas('user.followers', function ($query) use ($userId) {
                    $query->where('follower_id', $userId);
                })
                ->orWhereHas('requacks', function ($query) use ($userId) {
                    $query->whereHas('followers', function ($query) use ($userId) {
                        $query->where('follower_id', $userId);
                    });
                })
                ->latest()
                ->get()
        ]);
    }
}
