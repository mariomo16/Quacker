<?php

namespace App\Http\Controllers;

use App\Models\Quack;
use App\Models\Quashtag;
use App\Http\Requests\QuackRequest;
use Illuminate\Support\Facades\DB;

class QuackController extends Controller
{
    /**
     * Muestra todos los Quacks con sus usuarios, quashtags
     * y contadores de quavs y requacks, ordenados del más reciente al más antiguo.
     */
    public function index()
    {
        $quacks = Quack::with(['user', 'quashtags'])->withCount(['quavs', 'requacks'])->latest()->get();

        return view('quacks.index', compact('quacks'));
    }

    public function create()
    {
        return view('quacks.create');
    }

    /**
     * Almacena un nuevo Quack y asocia los quashtags detectados.
     */
    public function store(QuackRequest $request)
    {
        preg_match_all('/#(\w+)/u', $request->validated()['content'], $matches);
        $quashtagNames = array_unique($matches[1]);

        $quashtags = [];
        foreach ($quashtagNames as $quashtagName) {
            $quashtags[] = Quashtag::firstOrCreate([
                'name' =>
                    $quashtagName
            ]);
        }

        $quack = Quack::create($request->validated() + ['user_id' => auth()->id()]);
        if (!empty($quashtags)) {
            $quack->quashtags()->saveMany($quashtags);
        }
        return to_route('feed');
    }

    /**
     * Muestra un Quack con su usuario y contadores de quavs y requacks.
     */
    public function show(Quack $quack)
    {
        $quack->load('user')->loadCount(['quavs', 'requacks']);

        return view('quacks.show', compact('quack'));
    }

    public function edit(Quack $quack)
    {
        $this->authorize('manage', $quack);

        return view('quacks.edit', compact('quack'));
    }

    /**
     * Actualiza un Quack autorizado y redirige a su vista.
     */
    public function update(QuackRequest $request, Quack $quack)
    {
        $this->authorize('manage', $quack);

        $quack->update($request->validated());

        return to_route('quacks.show', [$quack]);
    }

    /**
     * Elimina un Quack autorizado y redirige al index
     */
    public function destroy(Quack $quack)
    {
        $this->authorize('manage', $quack);

        $quack->delete();

        return to_route('quacks.index');
    }

    /**
     * Devuelve el feed de un usuario, combinando sus quacks y requacks,
     * con relaciones y contadores cargados, ordenados por fecha.
     */
    public function userQuacks(int $id)
    {
        // Quacks propios del usuario
        $quacks = Quack::query()->select([
            'quacks.id',
            'quacks.user_id',
            'quacks.created_at as feed_date',
            'quack as feed_type',
            'NULL as requack_user_id'
        ])->where('quacks.user_id', $id);

        // Requacks realizados por el usuario
        $requacks = DB::table('requacks')->join(
            'quacks',
            'requacks.quack_id',
            '=',
            'quacks.id',
        )->select(
                'quacks.id',
                'quacks.user_id',
                'requacks.created_at as feed_date',
                'requack',
                'requacks.user_id'
            )->where('requacks.user_id', $id);

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

    /**
     * Muestra todos los quacks asociados a un quashtag específico,
     * incluyendo usuario, relaciones de quashtags y contadores.
     */
    public function quashtagQuacks(int $id)
    {
        $quacks = Quack::with(['quashtags', 'user'])
            ->withCount(['quavs', 'requacks'])
            ->whereHas('quashtags', function ($q) use ($id) {
                $q->where('quashtag_id', $id);
            })
            ->latest()
            ->get();

        return view('quacks.index', compact('quacks'));
    }
}
