<?php

namespace App\Http\Controllers;

use App\Models\Division; 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = auth()->user();
        $divisions = Division::all(); 
        
        return view('profile.edit', compact('user', 'divisions'));
    }


    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'division_id' => 'required|integer',
        'birthday' => 'required|date',
        'role_id' => 'required|integer',
        'password' => 'required', 
    ]);

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'The provided password is incorrect.']);
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->division_id = $request->division_id;
    $user->birthday = $request->birthday;
    $user->role_id = $request->role_id;

    $user->save();

    return redirect()->route('profile.edit')->with('status', 'Profile updated successfully!');
}

public function destroy(Request $request): RedirectResponse
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
}
}
