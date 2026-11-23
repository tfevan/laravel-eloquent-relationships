<?php

declare(strict_types=1);

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReassignImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(['user', 'post'])],
            'id' => ['required', 'integer', 'min:1'],
        ];
    }
}