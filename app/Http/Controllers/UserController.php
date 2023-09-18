<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function create(){
        return view('users.register');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect()->route('home')->with('message', 'You have created an account');
    }

    public function login(){
        return view('users.login');
    }

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect()->route('home')->with('message', 'You are now logged in');
        }
        else{
            return back()
                ->withErrors(['email'=> 'Invalid credentials'])
                ->onlyInput('email');
        }
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('message', 'You have been logged out');
    }

    public function edit(){
        $user = auth()->user();
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request){
        $formFields = $request->validate([
            'first_name' => ['required', 'alpha'],
            'last_name' => ['required', 'alpha'],
            'country' => ['required', 'alpha'],
            'city' => ['required', 'alpha'],
            'address' => ['required'],
        ]);
        $user = auth()->user();
        $user->update($formFields);

        return redirect()->route('home')->with('message', 'You have successfully updated your profile');
    }
}
