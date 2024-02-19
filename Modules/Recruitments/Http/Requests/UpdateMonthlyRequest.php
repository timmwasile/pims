<?php

namespace Modules\Recruitments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Monthly;

class UpdateMonthlyRequest extends FormRequest
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
        $rules = Monthly::$rules;

        return $rules;
    }
}
