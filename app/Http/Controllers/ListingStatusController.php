<?php

namespace App\Http\Controllers;

use App\Enums\ListingStatus;
use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ListingStatusController extends Controller
{
    /**
     * Move a listing between available, reserved, and completed.
     */
    public function update(Request $request, Listing $listing): RedirectResponse
    {
        Gate::authorize('update', $listing);

        $validated = $request->validate([
            'status' => ['required', Rule::enum(ListingStatus::class)],
        ]);

        $status = ListingStatus::from($validated['status']);

        $listing->update(['status' => $status]);

        return back()->with('status', match ($status) {
            ListingStatus::Available => 'Listing is back on the shelf.',
            ListingStatus::Reserved => 'Listing marked as reserved.',
            ListingStatus::Completed => 'Listing marked as completed. Nice one!',
        });
    }
}
