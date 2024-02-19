<?php

namespace Modules\Admins\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admins\Entities\Company;
use Str;

class UpdateCompanyRequest extends FormRequest
{
    protected function prepareForValidation()
    {

        $this->merge([
            'name' => Str::lower($this->name),
            'description' => Str::lower($this->description),
            'email' => Str::lower($this->email),
            'phone_no' => $this->phone_no,
            'location' => Str::lower($this->location),
            'contact_person' =>Str::lower( $this->contact_person),
            'owner' => Str::lower($this->owner),
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
    // public function rules()
    // {
    //     $rules = Company::$rules;

    //     return $rules;
    // }
}
