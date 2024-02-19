<?php

namespace Modules\Users\Http\Requests;

use Modules\Users\Entities\UserEducation;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserEducationRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id'            => auth()->user()->id,
            'education_level_id' => $this->education_level_id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  UserEducation::$rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
