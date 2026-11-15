<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{

    public function create(){
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:60', 'min:3'],
            'email' => ['required','email','string','max:60',Rule::unique('users', 'email')],
            'password' => ['required','string','min:6','max:60'],
        ]);

        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Registration Successful!');
    }

}
