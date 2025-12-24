<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        // Xác thực
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:3'],
        ]);


        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return redirect()->intended(
                $user->role === 'ADMIN' ? route('admin.dashboard') : route('home')
            );
        } else {
            abort(404);
        }
    }
}
