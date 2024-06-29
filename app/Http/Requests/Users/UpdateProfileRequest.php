<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'address' => ['required','string','max:255'],
            'state' => ['required','string','max:255'],
            'zip_code' => ['required','string','max:50'],
            'phone' => ['required','string','max:15'],
            'identity' => ['required','string','max:15'],
            'gender' => ['required','IN:L,P'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'identity_image' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ];
    }
}
