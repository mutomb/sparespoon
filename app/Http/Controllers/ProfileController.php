<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the neighbor's profile and location settings.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    /**
     * Update the neighbor's profile and location.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'neighborhood' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
        ]);

        $validated['postal_code'] = Str::upper(trim($validated['postal_code']));

        $user->update($validated);

        return redirect()
            ->route('profile.edit')
            ->with('status', 'Your neighborhood is up to date.');
    }
}
