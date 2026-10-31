<?php

namespace App\Http\Requests;

use App\Enums\ListingCategory;
use App\Enums\ListingType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('listing')) ?? false;
    }

    /**
     * Normalize a giveaway so it can never carry a price.
     */
    protected function prepareForValidation(): void
    {
        $type = ListingType::tryFrom((string) $this->input('type'));

        if ($type === ListingType::Giveaway || blank($this->input('price'))) {
            $this->merge(['price' => 0]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:1000'],
            'category' => ['required', Rule::enum(ListingCategory::class)],
            'type' => ['required', Rule::enum(ListingType::class)],
            'price' => ['required', 'numeric', 'min:0', 'max:9999.99'],
            'quantity' => ['required', 'string', 'max:50'],
            'expiry_date' => ['required', 'date'],
            'pickup_instructions' => ['required', 'string', 'max:500'],
        ];
    }
}
