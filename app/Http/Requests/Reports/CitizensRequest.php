<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class CitizensRequest extends FormRequest
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
            'title' => ['required','string','max:255'],
            'description' => ['required','string','max:255'],
            'address' => ['required','string','max:255','unique:reports,address'],
            'state' => ['required','string','max:255'],
            'lat' => ['required','string','max:15','unique:reports,lat'],
            'long' => ['required','string','max:15', 'unique:reports,long']
        ];
    }

     /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'description.required' => 'The description is required.',
            'address.required' => 'The address is required.',
            'address.unique' => 'Some citizens have already reported this road.',
            'state.required' => 'The state is required.',
            'lat.required' => 'The latitude is required.',
            'lat.unique' => 'Some citizens have already reported this road.',
            'long.required' => 'The longitude is required.',
            'long.unique' => 'Some citizens have already reported this road.',
        ];
    }
}
