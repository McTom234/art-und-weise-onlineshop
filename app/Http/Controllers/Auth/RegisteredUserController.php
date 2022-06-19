<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     *
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

        $location = Location::where('street', '=', $request->get('street'))
            ->orWhere('street_number', '=', $request->get('street_number'))
            ->orWhere('postcode', '=', $request->get('postcode'))
            ->orWhere('city', '=', $request->get('city'))
            ->get();

        if ($location->count() > 0)
        {
            $location = $location->first();
        }
        else
        {
            $location = new Location();
            $location->street = $request->get('street');
            $location->street_number = $request->get('street_number');
            $location->postcode = $request->get('postcode');
            $location->city = $request->get('city');
            $success = $location->save();

            if (!$success) {
                return redirect()->back()->withErrors('Error while creating location. Contact admin. Error#Registration1');
            }
        }

        $user = new User();
        $user->forename = $request->get('forename');
        $user->surname = $request->get('surname');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->location_id = $location->id;
        $success = $user->save();

        if (!$success) {
            return redirect()->back()->withErrors('Error while creating location. Contact admin. Error#Registration2');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
