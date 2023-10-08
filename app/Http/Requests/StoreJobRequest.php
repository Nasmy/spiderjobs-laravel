<?php

namespace App\Http\Requests;

use App\WorkPlace;
use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'job_category_id' => 'required|exists:job_category,id',
            'country' => 'required|exists:countries,country_name',
            'work_place_type' => 'required|in:'.WorkPlace::toString(),
            'emp_type_id' => 'required|exists:employment_types,id',
            'experience_level_id' => 'required|exists:experience_levels,id',
            'department_id' => 'required|exists:departments,id',
            'expiration_at' => 'required|date',
            'status' => 'required'

        ];

        if(in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['job_apply_url'] = 'sometimes|required';
        }

        return $rules;
    }
}
