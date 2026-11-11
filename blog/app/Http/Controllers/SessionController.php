<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return back()->withErrors(['password' => 'We were unable to authenticate using provided credentials'])->withInput();
        }

        $request->session()->regenerate();
        return redirect()->intended('/')->with('success', 'You have successfully logged in');

    }

  public function destroy(){
         Auth::logout();
         return redirect('/');
    }
}
