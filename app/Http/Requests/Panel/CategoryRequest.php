<?php

namespace App\Http\Requests\Panel;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'max:25',
                    function ($attribute, $value, $fail) {
                        if(!$this->validStr('йцукеёнгшщзхфывапролджэячсмитьбю -', $value)){
                            $fail('Ошибка');
                        }
                    }
                ],
            'description' => [
                'nullable',
                'max:100',
                function ($attribute, $value, $fail) {
                    if(!$this->validStr('йцукеёнгшщзхфывапролджэячсмитьбю -.,:;', $value)){
                        $fail('Ошибка');
                    }
                }
             ],
        ];
    }

    public function validStr($validSymbols, $str)
    {
        $arr = str_split(mb_strtolower($str));

        foreach ($arr as $k => $v) {
            if(mb_strpos($validSymbols, $v) === false){
                return false;
            }
        }

        return true;
    }
}
