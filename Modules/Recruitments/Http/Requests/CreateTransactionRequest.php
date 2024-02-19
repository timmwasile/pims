<?php

namespace Modules\Recruitments\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Customer;
use Modules\Recruitments\Entities\Loan;
use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Entities\Project as EntitiesProject;
use Modules\Recruitments\Rules\CheckAmountPaid;

class CreateTransactionRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $data = Plot::where('id',$this->id)->first();
        $customer = Customer::where('id',$data->customer_id)->first();
        $project = EntitiesProject::where('id',$data->project_id)->first();
        $this->merge([
            'created_by'=>auth()->user()->id,
            'company_id'=>auth()->user()->company_id,
            'amount'=>floatval(preg_replace("/[^-0-9\.]/","",$this->mpa)),
            'customer_id'=>$data->customer_id,
            'customer'=>$customer->name,
            'project'=>$project->name,
            'description'=>$this->description,
            'file_name'=>now()->timestamp.'_'.$this->permits,
            'payment_date'=>$this->payment_date,
            'reference'=>$this->reference,
            'project_id'=>$data->project_id,
            'plot_id'=>$data->id,
            'plot'=>$data->number,

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

   
}
