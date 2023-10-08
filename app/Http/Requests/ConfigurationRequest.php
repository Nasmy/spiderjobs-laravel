<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ConfigurationRequest extends FormRequest
{
    use ApiResponse;
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
        return [
            //'configuration_key' => 'required',
            //'configuration_value' => 'required'
        ];
    }

    /*public function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->all();
        throw new HttpResponseException($this->sendError($message, 401));
    }*/
}
