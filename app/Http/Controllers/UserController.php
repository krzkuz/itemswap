<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function create() : View {
        return view('users.register');
    }

    public function store(Request $request) : RedirectResponse {
        $formFields = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect()
            ->route('home')
            ->with('message', 'You have created an account');
    }

    public function login() : View {
        return view('users.login');
    }

    public function authenticate(Request $request) : RedirectResponse {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect()
                ->route('home')
                ->with('message', 'You are now logged in');
        }
        else{
            return back()
                ->withErrors(['email'=> 'Invalid credentials'])
                ->onlyInput('email');
        }
    }

    public function logout(Request $request) : RedirectResponse {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('message', 'You have been logged out');
    }

    public function edit() : View {
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request) : RedirectResponse {
        $formFields = $request->validate([
            'first_name' => ['required', 'alpha'],
            'last_name' => ['required', 'alpha'],
            'country' => ['required', 'alpha'],
            'city' => ['required', 'alpha'],
            'address' => ['required'],
        ]);
        
        $user = auth()->user();
        $user->update($formFields);

        return redirect()
            ->route('home')
            ->with('message', 'You have successfully updated your profile');
    }
}
