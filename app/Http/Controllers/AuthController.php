<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class AuthController extends Controller
{
    public function create()
    {
        return inertia('Auth/Login');
    }

    public function store(Request $request)
    {
        

        if(!FacadesAuth::attempt($request->validate([
            // 'username' => 'required|string|email', => use username for login credentials
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]), true  )){
            throw ValidationValidationException::withMessages([
                'email' => 'Authentication failed'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('listing.index'));
    }

    public function destroy(Request $request)
    {
        FacadesAuth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('listing.index');
    }
}
