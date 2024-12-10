<?php

namespace App\Http\Controllers;

use App\Models\Division; // Import the Division model
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = auth()->user();
        $divisions = Division::all(); // Fetch divisions from the database
        return view('profile.edit', compact('user', 'divisions'));
    }


    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'division_id' => 'nullable|exists:divisions,id',
        'birthday' => 'nullable|date',
        'password' => 'nullable|string|confirmed|min:8',
    ]);

    // Update user information
    $user->name = $request->name;
    $user->email = $request->email;
    $user->division_id = $request->division_id;
    $user->birthday = $request->birthday;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('profile.edit')->with('status', 'Profile updated successfully!');
}


    /**
     * Delete the user's account.
     */
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
