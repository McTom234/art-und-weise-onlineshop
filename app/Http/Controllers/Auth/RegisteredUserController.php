<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('auth.register', ['categories' => $categories]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
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

        $user = new User();
        $user->forename = $request->forename;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $success = $user->save();

        $location = new Location();
        $location->street = $request->street;
        $location->street_number = $request->street_number;
        $location->postcode = $request->postcode;
        $location->city = $request->city;
        $location->user_id = $user->id;
        $success = $success && $location->save();

        if (!$success) {
            return redirect()->back()->withErrors('Error while creating user. Contact admin. Error#1001');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
