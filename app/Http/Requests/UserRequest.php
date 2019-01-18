<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                    'email'=> 'required|unique:users,id,:id\'',
                    'password'=>'required|min:3',
                    'name'=>'required',

                ];
                break;

            default:
                $rules = [
                    'email'=> 'required|unique:users',
                    'password'=>'required|min:3',
                    'name'=>'required',
                ];
                break;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'email.required'=>'Поле  Email обязательно к заполнению',
            'email.unique'=>'Поле  Email должно быть уникальным',
            'name.required'=>'Поле  Имя обязательно к заполнению',
            'password.required'=>'Поле Пароль обязательно к заполнению',
            'password.min'=>' Пароль должен быть не короче 3 символов',
        ];
    }
}
