<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Customer;

class CreateCustomerRequest extends FormRequest
{
    protected function prepareForValidation()
    {

        $this->merge([
            'created_by'             => Auth::user()->id,
            'company_id'             => Auth::user()->company_id,
            'name'             => $this->name,
            'address'             => $this->address,
            'mobile'             => $this->mobile,
            'description'             => $this->description,
            'nida'             => $this->nida,
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
        return Customer::$rules;
    }
}
