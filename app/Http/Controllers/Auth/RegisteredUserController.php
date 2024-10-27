<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserPreRegisterMailable;
use App\Mail\UserRegisterMailable;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view("auth.register");
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "first_name" => ["required", "string", "max:255"],
            "last_name" => ["required", "string", "max:255"],
            "departments" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "string",
                "lowercase",
                "email",
                "max:255",
                "unique:" . User::class,
            ],
            "password" => ["required", "confirmed", Rules\Password::defaults()],
        ]);

        $user = User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "departments" => $request->departments,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $email = User::where('is_admin', true)->value('email');

        event(new Registered($user));

        // Auth::login($user);

        Mail::to($email)->send(new UserRegisterMailable($user->first_name, $user->last_name, $user->email, $user->departments));
        Mail::to($user->email)->send(new UserPreRegisterMailable($user->first_name, $user->last_name));

        return redirect()->route('login')->with('status', 'El registro fue exitoso, te enviaremos un email cuando el Admin haya verificado tu identidad.');

        // return redirect(route("dashboard", absolute: false));
    }
}
