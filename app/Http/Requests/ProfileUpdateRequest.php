<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            'telephone' => ['nullable', 'string', 'max:255'], // Assuming telephone is a string of max length 255
            'gender' => ['nullable', 'in:male,female'], // Validation for specific allowed values
          /*   'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'], // Image files only
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx'], // File types PDF, DOC, DOCX only */
            'bio' => ['nullable', 'string'], // Assuming bio is a text field with no max length
            'title' => ['nullable', 'string', 'max:255'], // Assuming title is a short string
            'location' => ['nullable', 'string', 'max:255'], // Assuming location is a short string
            'skills' => ['nullable', 'string'], // Assuming skills is a text field with no max length
            'experience' => ['nullable', 'string'], // Assuming experience is a text field with no max length
            'no_of_employees' => ['nullable', 'integer', 'min:1'], // Assuming this should be a positive integer
            'role' => ['in:admin,candidate,employer'] // Validation for specific allowed values
        ];
    }
}
