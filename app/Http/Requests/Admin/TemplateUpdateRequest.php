<?php

namespace App\Http\Requests\Admin;

use App\Models\ResumeTemplate;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TemplateUpdateRequest extends FormRequest
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
            'key' => [
                'required',
                Rule::in(ResumeTemplate::AVAILABLE_KEYS),
                Rule::unique('resume_templates', 'key')->ignore($this->route('template')),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'recommended_roles' => ['nullable', 'array'],
            'recommended_roles.*' => ['string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999.99'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ];
    }
}
