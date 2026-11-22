<?php

declare(strict_types=1);

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class SyncUsersRequest extends FormRequest
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
            'users' => ['present', 'array'],
            'users.*.user_id' => ['required', 'integer', 'distinct', 'exists:users,id'],
            'users.*.expires_at' => ['nullable', 'date'],
        ];
    }
}