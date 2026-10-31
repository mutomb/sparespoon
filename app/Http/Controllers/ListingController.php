<?php

namespace App\Http\Controllers;

use App\Enums\ListingCategory;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ListingController extends Controller
{
    /**
     * Browse available food near the signed-in neighbor.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $search = trim((string) $request->query('location', ''));
        $category = ListingCategory::tryFrom((string) $request->query('category', ''));
        $showAll = $request->boolean('all');
        $nearOnly = false;

        $listings = Listing::query()
            ->available()
            ->with('user')
            ->latest();

        if ($search !== '') {
            $listings->matchingLocation($search);
        } elseif (! $showAll && $user?->hasLocation()) {
            $listings->inLocation($user->postal_code, $user->neighborhood);
            $nearOnly = true;
        }

        if ($category) {
            $listings->where('category', $category);
        }

        $paginator = $listings->paginate(9)->withQueryString();

        return view('listings.index', [
            'listings' => $paginator,
            'categories' => ListingCategory::cases(),
            'search' => $search,
            'selectedCategory' => $category,
            'nearOnly' => $nearOnly,
            'showAll' => $showAll,
            'nearbyCount' => $nearOnly ? $paginator->total() : null,
            'communityListings' => Listing::available()->count(),
            'neighborCount' => User::query()->whereNotNull('neighborhood')->count(),
        ]);
    }

    /**
     * Show a single listing.
     */
    public function show(Listing $listing): View
    {
        $listing->load('user');

        $related = Listing::query()
            ->available()
            ->with('user')
            ->whereKeyNot($listing->getKey())
            ->where('category', $listing->category)
            ->latest()
            ->limit(3)
            ->get();

        return view('listings.show', [
            'listing' => $listing,
            'related' => $related,
        ]);
    }

    /**
     * Show the form for sharing a new listing.
     */
    public function create(): View
    {
        return view('listings.create');
    }

    /**
     * Store a newly shared listing.
     */
    public function store(StoreListingRequest $request): RedirectResponse
    {
        $listing = $request->user()->listings()->create($request->validated());

        return redirect()
            ->route('listings.show', $listing)
            ->with('status', 'Your food is on the shelf. Neighbors can find it now.');
    }

    /**
     * Show the form for editing a listing.
     */
    public function edit(Listing $listing): View
    {
        Gate::authorize('update', $listing);

        return view('listings.edit', ['listing' => $listing]);
    }

    /**
     * Update a listing.
     */
    public function update(UpdateListingRequest $request, Listing $listing): RedirectResponse
    {
        $listing->update($request->validated());

        return redirect()
            ->route('listings.show', $listing)
            ->with('status', 'Listing updated.');
    }

    /**
     * Remove a listing.
     */
    public function destroy(Listing $listing): RedirectResponse
    {
        Gate::authorize('delete', $listing);

        $listing->delete();

        return redirect()
            ->route('dashboard')
            ->with('status', 'Listing removed.');
    }
}
