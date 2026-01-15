<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuashtagRequest;
use App\Models\Quashtag;

class QuashtagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('quashtags.index', [
            'quashtags' => Quashtag::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quashtags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuashtagRequest $request)
    {
        Quashtag::create($request->validated());
        return redirect('/quashtags');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quashtag $quashtag)
    {
        return view('quashtags.show', [
            'quashtag' => $quashtag
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quashtag $quashtag)
    {
        return view('quashtags.edit', [
            'quashtag' => $quashtag
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuashtagRequest $request, Quashtag $quashtag)
    {
        $quashtag->update($request->validated());
        return redirect('/quashtags');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Quashtag::destroy($id);
        return redirect('/quashtags');
    }
}
