<?php

namespace Modules\Users\Http\Requests;

use Modules\Users\Entities\UserExperience;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserExperienceRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id'            => auth()->user()->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return UserExperience::$rules;
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
