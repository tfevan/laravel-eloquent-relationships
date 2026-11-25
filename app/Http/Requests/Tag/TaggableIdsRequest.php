<?php

declare(strict_types=1);

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class TaggableIdsRequest extends FormRequest
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
        $table = $this->route('type') === 'video' ? 'videos' : 'posts';

        return [
            'ids' => ['present', 'array'],
            'ids.*' => ['integer', 'distinct', "exists:{$table},id"],
        ];
    }
}