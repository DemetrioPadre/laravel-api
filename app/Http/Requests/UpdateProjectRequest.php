<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'exists:technologies,id',

        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.required' => 'Il Titolo è obbligatorio',
            'title.string' => 'Il Titolo deve essere testuale',
            'title.max' => 'Il Titolo può essere di :max caratteri',
            'content.required' => 'Il Contenuto è obbligatorio',
            'content.string' => 'Il Content deve essere testuale',
        ];
    }
}
