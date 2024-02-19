<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Taxe;

class CreateTaxeRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'created_by'             => Auth::user()->id,
            'rate'             => $this->rate/100,
        ]);
        // dd($this);
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
        return Taxe::$rules;
    }
}
