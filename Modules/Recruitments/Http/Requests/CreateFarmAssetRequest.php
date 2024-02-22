<?php

namespace Modules\Recruitments\Http\Requests;

use App\Rules\CheckFarmNumberIfExist;
use App\Rules\CheckFarmSize;
use App\Rules\CheckPlotNumberIfExist;
use App\Rules\CheckProjectSize;
use Auth;
use DateTime;
use DB;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Recruitments\Entities\Customer;
use Modules\Recruitments\Entities\Farm;
use Modules\Recruitments\Entities\FarmAsset;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Entities\Project;

use function app\bootstrap\transactionNumber;

class CreateFarmAssetRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $payment_type = Payment::where('id',$this->payment_id)->first();
        $sqm_amount = Farm::where('id',$this->project_id)->first();
        $projectSize =$sqm_amount->size;

        $current_size = $this->size;
        $map_number = $this->map_number;
        $of_project_id=$this->project_id;

        $dt1 = new DateTime($this->started_at);
        $started_at = $dt1->format("Y-m-d");
        $ended_at = date('Y-m-d', strtotime("+$this->duration months", strtotime($started_at)));
        $total_amount = floatval(preg_replace("/[^-0-9\.]/","",$this->size)) *floatval(preg_replace("/[^-0-9\.]/","",$sqm_amount->amount));

        $balance = floatval(preg_replace("/[^-0-9\.]/","",$total_amount) - preg_replace("/[^-0-9\.]/","",$total_amount)*$payment_type->discount/100) - floatval(preg_replace("/[^-0-9\.]/","",$this->paid_amount));
         $to_be_paid_amount = floatval(preg_replace("/[^-0-9\.]/","",$total_amount) - preg_replace("/[^-0-9\.]/","",$total_amount)*$payment_type->discount/100);
        $mpa = $to_be_paid_amount/$this->duration;
        $this->validate([
            'project_id' => [new CheckFarmSize( $projectSize, $current_size)],
            'map_number' => [new CheckFarmNumberIfExist($map_number, $of_project_id)]
        ]);

        // cash payment
        if($this->payment_id ==1){

            $this->merge([
                'status_id' => 0,
                'size'          =>floatval(preg_replace("/[^-0-9\.]/","",$this->size )),

                'balance' => 0,
                'paid_amount'          =>floatval(preg_replace("/[^-0-9\.]/","",$to_be_paid_amount)),
                'mpa'=>0,
                'to_be_paid_amount' =>$to_be_paid_amount,
            ]);
        }
        // Down Payment
        elseif($this->payment_id ==2){
            $this->merge([
                'status_id' => 1,
                'balance'          =>floatval(preg_replace("/[^-0-9\.]/","",$balance )),
                'size'          =>floatval(preg_replace("/[^-0-9\.]/","",$this->size )),
                'paid_amount'          =>$total_amount*0.3,
                'to_be_paid_amount' =>((($total_amount-$this->paid_amount)-($total_amount*$payment_type->discount/100)+($this->paid_amount))),
                'mpa' =>(($total_amount-($total_amount*0.3))-($total_amount*$payment_type->discount/100))/$this->duration,
                'balance'=> ($total_amount-($total_amount*0.3))-($total_amount*$payment_type->discount/100),
            ]);
        }else{
            $this->merge([
                'status_id' => 1,
                'size'          =>floatval(preg_replace("/[^-0-9\.]/","",$this->size )),

                'balance'          =>floatval(preg_replace("/[^-0-9\.]/","",$balance )),
                'paid_amount'          =>0,
                'to_be_paid_amount' =>((($total_amount-$this->paid_amount)-($total_amount*$payment_type->discount/100)+($this->paid_amount))),
                'mpa' =>$total_amount/$this->duration,
                'balance'=> $total_amount,
            ]);
        }
        $d1=new DateTime();
        $d2=new DateTime($ended_at);
        $Months = $d2->diff($d1);
        $howeverManyMonths = (($Months->y) * 12) + ($Months->m);
        $this->merge([
            'created_by'             => Auth::user()->id,
            'company_id'             => Auth::user()->company_id,
            'marketing_officer_id'  => $this->marketing_officer_id,
            'customer_id'  => $this->customer_id,
            'payment_id'  => $this->payment_id,
            'project_id'  => $this->project_id,
            'started_at'=>$started_at,
            'ended_at'=>$ended_at,
            'penalty'=>0,
            'total_amount' =>floatval(preg_replace("/[^-0-9\.]/","",$total_amount)),
            'month_remaining' => $howeverManyMonths,
            'size'          =>floatval(preg_replace("/[^-0-9\.]/","",$this->size )),

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
        return FarmAsset::$rules;
    }
}
