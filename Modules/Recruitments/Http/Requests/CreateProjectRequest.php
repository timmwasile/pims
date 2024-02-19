<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Modules\Recruitments\Entities\Project;

class CreateProjectRequest extends FormRequest
{
    protected function prepareForValidation()
    {

        $this->merge([
            'created_by'             => Auth::user()->id,
            'company_id'             => Auth::user()->company_id,
            'name'             => $this->name,
            'location'             => $this->location,
            'size'             => floatval(preg_replace("/[^-0-9\.]/","",$this->size)),
            'number_of_plots'             => $this->number_of_plots,
            'initial'             => $this->initial,
            'code'             => $this->code,
            'amount' =>floatval(preg_replace("/[^-0-9\.]/","",$this->amount)),

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
        return Project::$rules;
    }
}
