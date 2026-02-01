<?php

namespace App\Http\Controllers;

use App\Models\Quashtag;

class QuashtagQuackController extends Controller
{
    public function index(int $id)
    {
        $quashtag = Quashtag::find($id);
        $quacks = $quashtag->quacks()
            ->with(['user', 'quashtags'])
            ->latest()
            ->get();

        return view('quacks.index', compact('quacks'));
    }
}
