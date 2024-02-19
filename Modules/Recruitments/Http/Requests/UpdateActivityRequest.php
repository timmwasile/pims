<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Activity;

class UpdateActivityRequest extends FormRequest
{
     protected function prepareForValidation()
    {
         $query=Activity::where('id', $this->id)->get()->first();
        $this->merge([
            'created_by'             => Auth::user()->id,
            'budget'             => $this->budget+$query->budget,
            'balance'             => $query->balance + $this->budget,
            'created_by'             => Auth::user()->id,
        ]);
// dd($query);
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
