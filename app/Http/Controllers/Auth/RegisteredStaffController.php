<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\StaffRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class RegisteredStaffController extends Controller
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
    public function store(Request $request, StaffRepository $staffRepository): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'identification_no' => ['required', 'string', 'alpha_num', 'unique:'.User::class.',ic_no'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'identification_no' => $request->identification_no
        ]);

        $staffRepository->setBasicStaffProfile($user, $request);
        $user->syncRoles(['staff']);
        event(new Registered($user));

        Auth::login($user);

        if($user->hasRole('super-admin')){
            return redirect()->intended(route('dashboard', absolute: false));
        }elseif($user->hasRole('admin')){
            return redirect()->intended(route('dashboard', absolute: false));
        }elseif($user->hasRole('approval-admin')){
            return redirect()->intended(route('dashboard', absolute: false));
        }elseif($user->hasRole('staff')){
            return redirect()->intended(route('dashboard', absolute: false));
        }

        return redirect(route('dashboard', absolute: false));
    }
}
