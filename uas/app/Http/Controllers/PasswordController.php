<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('/auth/change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Password changed successfully!');
    }
}
