<?php

namespace Modules\Admins\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admins\Entities\Admin;
use Str;

class UpdateAdminRequest extends FormRequest
{
    protected function prepareForValidation()
    {

        $this->merge([
            'name' => Str::lower($this->name),
            'company_id' => $this->company_id,
            'email' => Str::lower($this->email),
            'username' => Str::lower($this->email),
            'gender' => Str::lower($this->gender),
            'phone_no' => $this->phone_no,
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
    //     $rules = Admin::$rules;

    //     return $rules;
    // }
}
