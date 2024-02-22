<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Project;

class UpdatePlotRequest extends FormRequest
{

     protected function prepareForValidation()
    {
       $payment_type = Payment::where('id',$this->payment_id)->first();
        $sqm_amount = Project::where('id',$this->project_id)->first();
        $dt1 = new DateTime($this->started_at);
        $started_at = $dt1->format("Y-m-d");
        $ended_at = date('Y-m-d', strtotime("+$this->duration months", strtotime($started_at)));

        $total_amount = $this->size *$sqm_amount->amount;

        $balance = floatval(preg_replace("/[^-0-9\.]/","",$total_amount) - preg_replace("/[^-0-9\.]/","",$total_amount)*$payment_type->discount/100) - floatval(preg_replace("/[^-0-9\.]/","",$this->paid_amount));
        if($this->payment_id ==1){
            $this->merge(['status_id' => 0, ]);
        }else{
            $this->merge(['status_id' => 1]);
        }

        $to_be_paid_amount = floatval(preg_replace("/[^-0-9\.]/","",$total_amount) - preg_replace("/[^-0-9\.]/","",$total_amount)*$payment_type->discount/100);
        $mpa = $to_be_paid_amount/$this->duration;

 $d1=new DateTime();
 $d2=new DateTime($ended_at);
 $Months = $d2->diff($d1);
 $howeverManyMonths = (($Months->y) * 12) + ($Months->m);
        $this->merge([
            'created_by'             => Auth::user()->id,
            'marketing_officer_id'  => $this->marketing_officer_id,
            'customer_id'  => $this->customer_id,
            'payment_id'  => $this->payment_id,
            'project_id'  => $this->project_id,
            'started_at'=>$started_at,
            'ended_at'=>$ended_at,
            'penalty'=>$this->penalty,
            'mpa'=>$mpa,
            'total_amount' =>floatval(preg_replace("/[^-0-9\.]/","",$total_amount)),
            'to_be_paid_amount' =>$to_be_paid_amount,
            'paid_amount'          =>floatval(preg_replace("/[^-0-9\.]/","",$this->paid_amount)),
            'balance'          =>floatval(preg_replace("/[^-0-9\.]/","",$balance )),
            'month_remaining' => $howeverManyMonths,
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
    // public function rules()
    // {
    //     $rules = Project::$rules;

    //     return $rules;
    // }
}
