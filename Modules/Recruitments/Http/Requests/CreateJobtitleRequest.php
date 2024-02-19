<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Jobtitle;

class CreateJobtitleRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
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
        return Jobtitle::$rules;
    }
}
