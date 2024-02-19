<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Payment;
use Illuminate\Validation\Rule;

class CreatePaymentRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
        //     'name' => [
        //     'required',
        //     Rule::unique('payments')->ignore('company_id',auth()->user()->company_id),
        // ],
            'created_by'             => Auth::user()->id,
            'company_id'             => Auth::user()->company_id,
            'discount'             => $this->discount,
            'description'             => $this->description,
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
        return Payment::$rules;
    }
}
