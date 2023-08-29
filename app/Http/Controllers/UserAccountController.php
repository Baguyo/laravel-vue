<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/Create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
            ]
        ));
        // $user->save();
        Auth::login($user);
        event(new Registered($user));
 
        return redirect()->route('listing.index')->with('success', 'account successfully created.');
    }
}
