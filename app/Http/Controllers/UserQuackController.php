<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserQuackController extends Controller
{
    public function index(int $id)
    {
        $user = User::find($id);
        $quacks = $user->activity();

        return view('quacks.index', compact('quacks'));
    }
}
