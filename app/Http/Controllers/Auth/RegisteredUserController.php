<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('auth.register', ['categories' => $categories]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'forename' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'street_number' => ['required', 'string', 'max:50'],
            'postcode' => ['required', 'numeric', 'digits:5'],
            'city' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'forename' => $request->forename,
            'surname' => $request->surname,

            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $location = Location::create([
            'street' => $request->street,
            'street_number' => $request->street_number,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'user_id' => $user->id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
