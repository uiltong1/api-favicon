<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        $validation['ds_service'] = 'max:500';
        $validation['date_init'] = 'required';
        
        switch(request()->method()){
            case 'PUT': 
                $validation['name'] = 'required|max:256';
            break;

            case 'POST':
                $validation['name'] = 'required|max:255|unique:services';
            break;
        }

        return $validation;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome do serviço não informado.',
            'name.max' => 'Nome não pode conter mais que 256 caracteres.',
            'name.unique' => 'Já existe um serviço com este nome.',
            'ds_service.max' => 'Descrição do serviço não pode conter mais que 500 caracteres.',
            'date_init.required' => 'Data de inicio não foi informada.'
        ];
    }
}
