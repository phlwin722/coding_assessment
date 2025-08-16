<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovieRequest extends FormRequest
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
        $id = $this->input('id'); // Get ID from request

        return [
            'id' => '',
            'title' => [
                'required',
                Rule::unique('movies', 'title')->ignore($id),
            ],
            'description' => [
                'required',
                Rule::unique('movies', 'description')->ignore($id),
            ],
            'price' => 'required|numeric',
            'release_date' => 'required|date',
        ];
    }
}
