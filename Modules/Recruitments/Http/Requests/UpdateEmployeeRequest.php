<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Employee;

class UpdateEmployeeRequest extends FormRequest
{

    
    protected function prepareForValidation()
    {
        
        $this->merge([
            'created_by'             => Auth::user()->id,
              'basic_salary' =>      floatval(preg_replace("/[^-0-9\.]/","",$this->basic_salary)),
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
    //     $rules = Employee::$rules;

    //     return $rules;
    // }
}
