<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Hash;
use Modules\Recruitments\Entities\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Modules\Admins\Entities\Admin;

class CreateUpdateProfileRequest extends FormRequest
{

     protected function prepareForValidation()
    {

        $this->merge([
            'company_id' => auth()->user()->company_id,
            'password' => $this->password,
            'new_password' => $this->new_password,
            'confirm_password' => $this->confirm_password,
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
        return  [
            'new_password' => 'required|string|min:8|max:48',
            'confirm_password' => 'required|string|min:8|max:48'
            ];
    }
}
