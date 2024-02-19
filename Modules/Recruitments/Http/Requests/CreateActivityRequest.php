<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Activity;

class CreateActivityRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'created_by'             => Auth::user()->id,
            'budget'             => floatval(preg_replace("/[^-0-9\.]/","",$this->budget)),
            'balance'             => floatval(preg_replace("/[^-0-9\.]/","",$this->budget)),
            'utilised'             => 0,
            'created_by'             => Auth::user()->id,

        ]);

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Activity::$rules;
    }
}
