<?php

namespace App\Http\Controllers;

use App\Models\Quack;

class FeedController extends Controller
{
    public function feed()
    {
        return view('quacks.feed', [
            'quacks' => Quack::with(['user'])->withCount(['quavs', 'requacks'])->latest()->get()
        ]);
    }
}
