<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
           'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Task title is required',
            'status.in' => 'Invalid status selected'
        ];
    }
}
