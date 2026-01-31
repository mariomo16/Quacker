<?php

namespace App\Http\Controllers;

use App\Models\Quack;
use Carbon\Carbon;

class FeedController extends Controller
{
    public function feed()
    {
        $userId = auth()->user()->id;

        $quacks = Quack::query()->select([
            'quacks.id',
            'quacks.user_id',
            'quacks.created_at as feed_date',
            'quack as feed_type',
            'NULL as requack_user_id'
        ])
            ->where(function ($q) use ($userId) {
                $q->where('quacks.user_id', $userId)
                    ->orWhereHas('user.followers', function ($q) use ($userId) {
                        $q->where('follower_id', $userId);
                    });
            });

        $requacks = \DB::table('requacks')->join(
            'quacks',
            'requacks.quack_id',
            '=',
            'quacks.id',
        )->select('quacks.id', 'quacks.user_id', 'requacks.created_at as feed_date', 'requack', 'requacks.user_id')
            ->where(function ($q) use ($userId) {
                $q->where('requacks.user_id', $userId)
                    ->orWhereIn('requacks.user_id', function ($q) use ($userId) {
                        $q->select('following_id')->from('follows')->where('follower_id', $userId);
                    });
            });

        $feed = \DB::query()->fromSub($quacks->unionAll($requacks), 'feed')->orderByDesc('feed_date')->get();

        $quackModels = Quack::with(['user', 'requacks'])
            ->withCount(['quavs', 'requacks'])
            ->whereIn('id', $feed->pluck('id'))
            ->get()
            ->keyBy('id');

        $feed = $feed->map(function ($item) use ($quackModels) {
            return $quackModels[$item->id];
        });

        return view('quacks.index', [
            'quacks' => $feed
        ]);
    }
}
