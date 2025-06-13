<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'filters' => ['sometimes', 'array'],
            'filters.limit' => ['sometimes', 'int', 'min:1'],
            'filters.page' => ['sometimes', 'int', 'min:1'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
