<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutStoreRequest extends FormRequest
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
            'resume_template_id' => ['required', 'integer', 'exists:resume_templates,id'],
            'method' => ['required', Rule::in(['gcash', 'maya', 'grab_pay', 'card', 'qrph'])],
            'customer_name' => ['nullable', 'string', 'max:255'],
            'customer_email' => ['nullable', 'email', 'max:255'],
        ];
    }
}
