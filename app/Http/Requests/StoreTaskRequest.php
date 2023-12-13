<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:App\Models\Task',
            'description' => '',
            'status_id' => 'required|exists:App\Models\TaskStatus,id',
            'created_by_id' => 'exists:App\Models\User,id',
            'assigned_to_id' => 'nullable|exists:App\Models\User,id',
            'labels' => '',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => __('strings.task exists'),
        ];
    }
}
