<?php

declare(strict_types=1);

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
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
        $presence = $this->isMethod('PATCH') ? 'sometimes' : 'required';

        return [
            'name' => [$presence, 'string', 'max:50', Rule::unique('tags', 'name')->ignore($this->route('tag'))],
        ];
    }
}