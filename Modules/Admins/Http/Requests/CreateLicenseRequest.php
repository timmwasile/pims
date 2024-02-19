<?php

namespace Modules\Admins\Http\Requests;

use Auth;
use Hash;
use Modules\Admins\Entities\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Admins\Entities\Company;
use Modules\Admins\Entities\License as EntitiesLicense;
use PharIo\Manifest\License;
use Str;

class CreateLicenseRequest extends FormRequest
{
    protected function prepareForValidation()
    {
         $status_id = ($this->status_id == 'on' ? true : false);
        if (!$status_id) {
            $this->merge(['status_id' => 0]); 
        } else {
            $this->merge(['status_id' => 1]); 
        }
        $this->merge([
            'created_by' => auth()->user()->id,
            'company_id' => $this->company_id,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
            'license_key' => $this->license_key,
            'status_id' =>$this->status_id,
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
        return EntitiesLicense::$rules;
    }
}
