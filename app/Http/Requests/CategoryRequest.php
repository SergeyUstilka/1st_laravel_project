<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {

        switch ($this->method()) {
            case 'PUT':
                $rules = [
                    'name'=> 'required|unique:categories,slug,:slug\'',
                    'description'=>'min:20',
                ];
                break;

            default:
                $rules = [
                    'name'=> 'required|unique:categories',
                    'description'=>'min:20',
                ];
                break;
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required'=>'Название категории обязательно к заполнению',
            'name.unique'=>'Такое название категории уже существует',
            'description.min'=>'Описание должно быть не короче 20 символов',
        ];
    }
}
