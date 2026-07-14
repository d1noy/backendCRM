<?php

namespace App\Http\Requests\Panel;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'name' => 'required|max:50',
            'description' => 'required|max:150',
            'price' => 'required|numeric|min:10',
            'images' => ($this->product ?  'nullable' : 'required') . '|array|max:5|min:1',
            'images .*' => 'image|mimes:jpeg,png,jpg|max:' .(1024 * 3.5),
        ];
    }
}
