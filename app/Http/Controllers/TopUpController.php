<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('topup.index', compact('user'));
    }

    public function store()
    {
        $user = Auth::user();
        
        $user->wallet += 100;
        $user->save();

        return redirect()->route('topup.index')->with('success', 'Successfully added 100 coins to wallet.');
    }
}