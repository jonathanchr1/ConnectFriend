<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'field_of_work_interests' => ['required', 'array', 'min:3'],
            'field_of_work_interests.*' => ['string'],
            'linkedin_username' => ['required', 'regex:/^https:\/\/www\.linkedin\.com\/in\/[a-zA-Z0-9-]+$/'],
            'mobile_number' => ['required', 'numeric'],
            'profession' => ['required', 'string', 'max:255'],
        ]);

        $user->update([
            'field_of_work_interests' => json_encode($request->field_of_work_interests),
            'linkedin_username' => $request->linkedin_username,
            'mobile_number' => $request->mobile_number,
            'profession' => $request->profession,
        ]);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
}