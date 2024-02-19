<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Monthly;

class CreateMonthlyRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $transaction_type = ($this->transaction_type == 'on' ? true : false); 
          if (!$transaction_type) {
            $this->merge(['transaction_type' => 1]); // the type is Payment
        } else{
            $this->merge(['transaction_type' => 0]); // the type is Deduction
        }
        
        $is_static = ($this->is_static == 'on' ? true : false);
        if (!$is_static) {
            $this->merge(['is_static' => 0]); // user
        } else {
            $this->merge(['is_static' => 1]); // supervisor
        }
        if($this->transaction_type == 0){
            $this->merge([
            'created_by'             => Auth::user()->id,
            'payment_id'             => (integer)$this->deductions,
            'employee_id'             => (integer)$this->employees,
            'amount'          =>floatval(preg_replace("/[^-0-9\.]/","",$this->amount)),
            'transaction_type'             => (integer)$this->transaction_type,
        ]);


        }else{
            $this->merge([
            'created_by'             => Auth::user()->id,
            'payment_id'             => (integer)$this->payments,
            'amount'          =>floatval(preg_replace("/[^-0-9\.]/","",$this->amount)),
            'employee_id'             => (integer)$this->employees,
            'transaction_type'             => (integer)$this->transaction_type,
        ]);

        }
        
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
        return Monthly::$rules;
    }
}
