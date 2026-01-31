<?php

namespace App\Http\Controllers;

use App\Models\Quashtag;
use App\Http\Requests\QuashtagRequest;

class QuashtagController extends Controller
{
    /**
     * Muestra todos los quashtags disponibles, ordenados por fecha de creación descendente.
     */
    public function index()
    {
        $quashtags = Quashtag::latest()->get();

        return view('quashtags.index', compact('quashtags'));
    }

    public function create()
    {
        return view('quashtags.create');
    }

    /**
     * Crea un nuevo quashtag a partir de los datos validados,
     * eliminando los espacios del nombre, y redirige al index.
     */
    public function store(QuashtagRequest $request)
    {
        $data = $request->validated();
        $data['name'] = str_replace(' ', '', $data['name']);

        Quashtag::create($data);
        
        return to_route('quashtags.index');
    }

    public function show(Quashtag $quashtag)
    {
        return view('quashtags.show', compact('quashtag'));
    }

    public function edit(Quashtag $quashtag)
    {
        return view('quashtags.edit', compact('quashtag'));
    }

    /**
     * Actualiza un quashtag con los datos validados,
     * eliminando los espacios del nombre, y redirige a su vista.
     */
    public function update(QuashtagRequest $request, Quashtag $quashtag)
    {
        $data = $request->validated();
        $data['name'] = str_replace(' ', '', $data['name']);

        $quashtag->update($data);
        
        return to_route('quashtags.show', [$quashtag]);
    }

    /**
     * Elimina un quashtag por su ID, y redirige al index.
     */
    public function destroy(string $id)
    {
        Quashtag::destroy($id);
        return to_route('quashtags.index');
    }
}
