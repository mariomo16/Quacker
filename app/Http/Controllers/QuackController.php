<?php

namespace App\Http\Controllers;

use App\Models\Quack;
use App\Models\Quashtag;
use App\Http\Requests\QuackRequest;

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
}
