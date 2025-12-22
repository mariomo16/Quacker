<?php

namespace App\Http\Controllers;

use App\Models\Quack;
use Illuminate\Http\Request;

class QuackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('quacks.index', [
            'quacks' => Quack::latest()->get()
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
    public function store(Request $request)
    {
        $request->validate(
            [

                'content' => 'required|max:280'
            ],
            [

                'content.required' => 'Este campo es obligatorio',
                'content.max' => 'Máximo 280 caracteres'
            ]
        );

        $data = $request->all();
        $data['user_id'] = auth()->id();

        Quack::create($data);
        return redirect('/quacks');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quack $quack)
    {
        return view('quacks.show', [
            'quack' => $quack
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
    public function update(Request $request, Quack $quack)
    {
        $this->authorize('manage', $quack);

        $request->validate(
            [
                'content' => 'required|max:280'
            ],
            [
                'content.required' => 'Este campo es obligatorio',
                'content.max' => 'Máximo 280 caracteres'
            ]
        );

        $quack->update($request->all());
        return redirect('/quacks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quack $quack)
    {
        $this->authorize('manage', $quack);

        $quack->delete();
        return redirect('/quacks');
    }
}
