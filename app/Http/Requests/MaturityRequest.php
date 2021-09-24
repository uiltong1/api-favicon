<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaturityRequest extends FormRequest
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
        $validation['service_id'] = 'required';
        $validation['date_maturity'] = 'required';
        $validation['status'] = 'required';

        switch(request()->method()){
            case 'POST':

                break;
            case 'PUT':

                break;
        }

        return $validation;
    }

    public function messages()
    {
        return [
            'service_id.required' => 'O Serviço não foi informado.',
            'date_maturity.required' => 'A data de pagamento do serviço não foi informada.',
            'status.required' => 'Status do pagamento não informado.'
        ];
    }
}
