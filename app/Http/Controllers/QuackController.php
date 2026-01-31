<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuackRequest;
use App\Models\Quack;
use App\Models\Quashtag;

class QuackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('quacks.index', [
            'quacks' => Quack::with(['user'])->withCount(['quavs', 'requacks', 'quashtags'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quacks.create');
    }

    /**
     * Store a newly created resource in storage.
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
        return to_route('quacks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quack $quack)
    {
        return view('quacks.show', [
            'quack' => Quack::with(['user'])->withCount(['quavs', 'requacks'])->find($quack->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quack $quack)
    {
        $this->authorize('manage', $quack);

        return view('quacks.edit', [
            'quack' => $quack
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuackRequest $request, Quack $quack)
    {
        $this->authorize('manage', $quack);

        $quack->update($request->validated());
        return to_route('quacks.show', [$quack]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quack $quack)
    {
        $this->authorize('manage', $quack);

        $quack->delete();
        return to_route('quacks.index');
    }

    public function userQuacks(int $id)
    {
        $quacks = Quack::query()->select([
            'quacks.id',
            'quacks.user_id',
            'quacks.created_at as feed_date',
            'quack as feed_type',
            'NULL as requack_user_id'
        ])
            ->where('quacks.user_id', $id);

        $requacks = \DB::table('requacks')->join(
            'quacks',
            'requacks.quack_id',
            '=',
            'quacks.id',
        )->select('quacks.id', 'quacks.user_id', 'requacks.created_at as feed_date', 'requack', 'requacks.user_id')
            ->where('requacks.user_id', $id);


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

    public function quashtagQuacks(int $id)
    {
        return view('quacks.index', [
            'quacks' => Quack::with(['quashtags', 'user'])
            ->whereHas('quashtags', function ($q) use ($id) {
                $q->where('quashtag_id', $id);
            })
                ->withCount(['quavs', 'requacks'])
                ->latest()
                ->get()
        ]);
    }
}
