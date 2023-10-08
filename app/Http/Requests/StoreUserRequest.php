<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        return [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'  => 'required|email|unique:users,email',
            'mobile'  => 'required|unique:users,mobile',
            'role_id' => 'required|exists:roles,id',
            'departments' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'username' => 'required|unique:users,username',
        ];
    }
}
