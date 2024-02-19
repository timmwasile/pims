<?php

namespace Modules\Recruitments\Http\Requests;

use Modules\Recruitments\Entities\Permission;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $this->merge([
            'title'             => $this->title,
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
        $rules = Permission::$rules;

        return $rules;
    }
}
