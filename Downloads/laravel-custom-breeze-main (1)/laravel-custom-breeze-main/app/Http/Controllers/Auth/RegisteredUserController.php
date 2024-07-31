<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use McKenziearts\Notify\Facades\LaravelNotify;
use Illuminate\Support\Facades\Session;

class RegisteredUserController extends Controller
{

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',  'regex:/^[a-zA-Z0-9._%+-]+@(csi-corporation\.com|csi-maghreb\.com|csi-international\.com)$/', 'unique:'.User::class],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/', 'confirmed', Rules\Password::defaults()],
            //'g-recaptcha-response' => ['required', new ReCaptcha],
        ], [
            'name.required' => 'Le champ nom est requis.',
            'email.regex' => 'L\'adresse e-mail doit appartenir au domaine csi-corporation.com ou csi-maghreb.com ou csi-international.com',
            'username.required' => 'Le champ username est requis.',
            'password.regex' => 'Le mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre et faire au moins 6 caractères.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        //Session::flash('success', 'You are awesome, your data was successfully created!');
        //notify()->success('Laravel Notify is awesome!');
        notify()->success('You are awesome, your data was successfully created!');
        return redirect(RouteServiceProvider::HOME);
    }
}
