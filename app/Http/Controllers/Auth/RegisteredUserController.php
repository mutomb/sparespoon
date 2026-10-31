<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Register a new neighbor and sign them in.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'email' => Str::lower(trim((string) $request->input('email'))),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'neighborhood' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
        ]);

        $validated['postal_code'] = Str::upper(trim($validated['postal_code']));

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('listings.index')
            ->with('status', 'Welcome to SpareSpoon. Your neighborhood is set!');
    }
}
