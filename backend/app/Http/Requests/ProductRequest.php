<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Whoops\Run;

class ProductRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                "max:255",
                Rule::unique('products', 'name')->ignore($id)
            ],
            'category' => 'required|string|max:255',
            'description' => [
                'required',
                'string',
                Rule::unique('products', 'description')->ignore($id)
            ],
            'date_time' => 'required|date',
        ];
    }
}
