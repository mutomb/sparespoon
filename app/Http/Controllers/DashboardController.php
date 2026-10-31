<?php

namespace App\Http\Controllers;

use App\Enums\ListingStatus;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the signed-in neighbor's listings and activity.
     */
    public function __invoke(Request $request): View
    {
        $user = $request->user();
        $status = ListingStatus::tryFrom((string) $request->query('status', ''));

        $listings = $user->listings()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $counts = [
            'all' => $user->listings()->count(),
            ListingStatus::Available->value => $user->listings()->where('status', ListingStatus::Available)->count(),
            ListingStatus::Reserved->value => $user->listings()->where('status', ListingStatus::Reserved)->count(),
            ListingStatus::Completed->value => $user->listings()->where('status', ListingStatus::Completed)->count(),
        ];

        return view('dashboard', [
            'listings' => $listings,
            'counts' => $counts,
            'selectedStatus' => $status,
            'statuses' => ListingStatus::cases(),
        ]);
    }
}
