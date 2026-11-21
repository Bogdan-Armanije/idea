<?php

namespace App\Http\Controllers;

use App\Notifications\EmailChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{


    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request){
        $user = auth()->user();
        $oldEmail = $user->email;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users','email')->ignore(Auth::user()->id)],
            'password' => ['nullable', Password::defaults()],
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password ?? $user->password,
        ]);



        if($oldEmail != $request->email){
            Notification::route('mail',$oldEmail)->notify(new EmailChanged($user,$oldEmail));
        }

        return redirect('/ideas')->with('success', 'Your profile has been updated.');
    }


}
