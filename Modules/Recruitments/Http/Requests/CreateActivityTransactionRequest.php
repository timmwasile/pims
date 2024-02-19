<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Activity;
use Modules\Recruitments\Rules\CheckBalance;

class CreateActivityTransactionRequest extends FormRequest
{
     protected function prepareForValidation()
    {
         $query=Activity::where('id', $this->id)->get()->first();
        $this->merge([
            'created_by'             => Auth::user()->id,
            'balance'                => $query->balance - $this->amount,
            'utilised'               => $query->utilised + $this->amount,
            'amount'               => $this->amount,
            'activity_id'               => $this->id,
            'number'               => 0,
        ]);
         $activity_id= $this->activity_id;
        $balance= $query->balance;
        $this->validate([
            'amount' => [new CheckBalance( $balance, $activity_id)]
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
    //     $rules = Activity::$rules;

    //     return $rules;
    // }
}
