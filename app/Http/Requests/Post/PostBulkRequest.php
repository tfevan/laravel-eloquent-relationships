<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostBulkRequest extends FormRequest
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
            'posts' => ['required', 'array', 'min:1'],
            'posts.*.title' => ['required', 'string', 'max:255'],
            'posts.*.body' => ['required', 'string'],
        ];
    }
}