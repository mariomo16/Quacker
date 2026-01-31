<?php

namespace App\Http\Controllers;

use App\Models\Quack;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    public function feed()
    {
        $userId = auth()->id();

        // Quacks propios del usuario y de los usuarios que sigue
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

        // Requacks realizados por el usuario y por los usuarios que sigue
        $requacks = DB::table('requacks')->join(
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

        // Unión de quacks y requacks y orden por fecha descendente
        $feed = DB::query()
            ->fromSub($quacks->unionAll($requacks), 'feed')
            ->orderByDesc('feed_date')
            ->get();

        // Cargar relaciones y contadores de los quacks
        $quackModels = Quack::with(['user', 'requacks'])
            ->withCount(['quavs', 'requacks'])
            ->whereIn('id', $feed->pluck('id'))
            ->get()
            ->keyBy('id');

        // Mapear los resultados del feed a los modelos Eloquent
        $feed = $feed->map(function ($item) use ($quackModels) {
            return $quackModels[$item->id];
        });

        // Retornar la vista con el feed
        return view('quacks.index', ['quacks' => $feed]);
    }
}
