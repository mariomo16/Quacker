<?php

namespace App\Http\Controllers;

class FeedController extends Controller
{
    public function index()
    {
        $quacks = auth()->user()->feed();

        return view('quacks.index', compact('quacks'));
    }
}
