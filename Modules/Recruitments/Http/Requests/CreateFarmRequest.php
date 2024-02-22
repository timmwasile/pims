<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Farm;

class CreateFarmRequest extends FormRequest
{
    protected function prepareForValidation()
    {

        $this->merge([
            'created_by'                => Auth::user()->id,
            'company_id'                => Auth::user()->company_id,
            'name'                      => $this->name,
            'description'               => $this->description,
            'location'                  => $this->location,
            'size'                      => floatval(preg_replace("/[^-0-9\.]/","",$this->size)),
            'amount'                    =>floatval(preg_replace("/[^-0-9\.]/","",$this->amount)),

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
        return Farm::$rules;
    }
}
