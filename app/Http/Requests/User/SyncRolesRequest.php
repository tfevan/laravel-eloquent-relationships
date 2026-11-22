<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SyncRolesRequest extends FormRequest
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
            'roles' => ['present', 'array'],
            'roles.*.role_id' => ['required', 'integer', 'distinct', 'exists:roles,id'],
            'roles.*.expires_at' => ['nullable', 'date'],
        ];
    }
}