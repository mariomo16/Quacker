<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuackRequest;
use App\Models\Quack;

class QuackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('quacks.index', [
            'quacks' => Quack::with(['user'])->withCount(['quavs', 'requacks'])->latest()->get()
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
        Quack::create($request->validated() + ['user_id' => auth()->id()]);
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

    public function feed()
    {
        return view('quacks.feed', [
            'quacks' => Quack::with(['user'])->withCount(['quavs', 'requacks'])->latest()->get()
        ]);
    }

    public function userQuacks(int $id)
    {
        return view('users.userQuacks', [
            'user_id' => $id,
            'quacks' => Quack::with(['user'])->withCount(['quavs', 'requacks'])->latest()->get()
        ]);
    }
}
