@php
    $editing = isset($listing) && $listing;
    $categories = \App\Enums\ListingCategory::cases();
    $types = \App\Enums\ListingType::cases();
    $currentType = old('type', $editing ? $listing->type->value : \App\Enums\ListingType::Giveaway->value);
    $priceValue = old('price', $editing ? $listing->price : 0);
@endphp

<form
    method="POST"
    action="{{ $editing ? route('listings.update', $listing) : route('listings.store') }}"
    data-listing-form
    class="space-y-6"
>
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    @if ($errors->any())
        <div class="flex items-start gap-3 rounded-2xl border border-clay-200 bg-clay-50 px-4 py-3.5 text-sm text-clay-700" role="alert">
            <svg class="mt-0.5 size-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
            </svg>
            <p>Almost there — please check the highlighted fields below.</p>
        </div>
    @endif

    <section class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm sm:p-8">
        <div class="flex items-center gap-3">
            <span class="grid size-10 place-items-center rounded-2xl bg-sage-100 text-lg" aria-hidden="true">🥕</span>
            <div>
                <h2 class="font-display text-xl font-semibold text-stone-900">The food</h2>
                <p class="text-sm text-stone-500">What are you passing on?</p>
            </div>
        </div>

        <div class="mt-6 space-y-5">
            <x-form.field label="Title" name="title" required hint="Keep it clear and friendly, like “Six fresh eggs” or “Half a sourdough loaf”.">
                <x-form.input
                    name="title"
                    :value="old('title', $editing ? $listing->title : '')"
                    placeholder="Six fresh eggs from our hens"
                    maxlength="120"
                    required
                    autofocus
                />
            </x-form.field>

            <div class="grid gap-5 sm:grid-cols-2">
                <x-form.field label="Category" name="category" required>
                    <x-form.select name="category" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->value }}" @selected(old('category', $editing ? $listing->category->value : '') === $category->value)>
                                {{ $category->emoji() }} {{ $category->label() }}
                            </option>
                        @endforeach
                    </x-form.select>
                </x-form.field>

                <x-form.field label="Type" name="type" required hint="Giveaways show as free, even if you set a price.">
                    <x-form.select name="type" data-type-field required>
                        @foreach ($types as $type)
                            <option value="{{ $type->value }}" @selected($currentType === $type->value)>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </x-form.select>
                </x-form.field>
            </div>

            <div class="grid gap-5 sm:grid-cols-3">
                <div data-price-wrap>
                    <x-form.field label="Price" name="price" :required="true" hint="Set 0 for free.">
                        <div class="relative">
                            <span class="pointer-events-none absolute left-4 top-[1.85rem] -translate-y-1/2 text-sm text-stone-400">$</span>
                            <x-form.input
                                name="price"
                                type="number"
                                step="0.01"
                                min="0"
                                max="9999.99"
                                :value="$priceValue"
                                class="pl-8"
                                data-price-field
                            />
                        </div>
                    </x-form.field>
                </div>

                <x-form.field label="Quantity" name="quantity" required hint="Amount or number of portions.">
                    <x-form.input
                        name="quantity"
                        :value="old('quantity', $editing ? $listing->quantity : '')"
                        placeholder="2 bunches"
                        maxlength="50"
                        required
                    />
                </x-form.field>

                <x-form.field label="Best before" name="expiry_date" required>
                    <x-form.input
                        name="expiry_date"
                        type="date"
                        :value="old('expiry_date', $editing ? $listing->expiry_date->format('Y-m-d') : now()->addDays(5)->format('Y-m-d'))"
                        required
                    />
                </x-form.field>
            </div>
        </div>
    </section>

    <section class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm sm:p-8">
        <div class="flex items-center gap-3">
            <span class="grid size-10 place-items-center rounded-2xl bg-sage-100 text-lg" aria-hidden="true">🏡</span>
            <div>
                <h2 class="font-display text-xl font-semibold text-stone-900">The handoff</h2>
                <p class="text-sm text-stone-500">Help a neighbor find you and collect it easily.</p>
            </div>
        </div>

        <div class="mt-6 space-y-5">
            <x-form.field label="Description" name="description" required hint="Where it came from, how ripe it is, or anything a neighbor should know.">
                <x-form.textarea
                    name="description"
                    rows="5"
                    maxlength="1000"
                    placeholder="Our tomato plants went wild this week. These are ripe and ready — a mix of cherry and plum tomatoes."
                    required
                >{{ old('description', $editing ? $listing->description : '') }}</x-form.textarea>
            </x-form.field>

            <x-form.field label="Pickup instructions" name="pickup_instructions" required hint="A porch, a doorstep, a time window — whatever makes pickup simple.">
                <x-form.textarea
                    name="pickup_instructions"
                    rows="4"
                    maxlength="500"
                    placeholder="Porch pickup any time before 8pm. The box will be by the front door — please don't ring the bell."
                    required
                >{{ old('pickup_instructions', $editing ? $listing->pickup_instructions : '') }}</x-form.textarea>
            </x-form.field>
        </div>
    </section>

    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">
        <x-button :href="$editing ? route('listings.show', $listing) : route('listings.index')" variant="ghost" size="md">
            Cancel
        </x-button>

        <x-button size="md">
            {{ $editing ? 'Save changes' : 'Put it on the shelf' }}
            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 4.99a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.968H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
            </svg>
        </x-button>
    </div>
</form>
