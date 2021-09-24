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
        $validation = array();
        $validation['name'] = 'required|max: 255';
        $validation['password'] = 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/';

        switch(request()->method()){
            case 'PUT':
                $validation['email'] = 'required';
                break;
                
            case 'POST':
                $validation['email'] = 'required|max:255|unique:users';
            break;
        }

        return $validation;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome obrigatório.',
            'name.max' => 'Nome deve conter no máximo 255 caracteres.',
            'email.required' => 'Email não informado.',
            'email.email' => 'Email não é válido.',
            'email.unique' => 'Email já cadastrado.',
            'password.required' => 'Senha não foi informada.',
            'password.regex' => 'A senha deve conter no mínimo oito caracteres, pelo menos, uma letra maiúscula, uma letra minúscula, um número e um caractere especial'
        ];
    }
}
