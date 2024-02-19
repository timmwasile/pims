<?php

namespace Modules\Recruitments\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Modules\Recruitments\Entities\Loan;
use Modules\Recruitments\Entities\Monthly;
use Modules\Recruitments\Entities\Payroll;
use Modules\Recruitments\Entities\Salary;
use Modules\Recruitments\Entities\Taxe;
use Modules\Recruitments\Rules\CheckIfSalaryIsCreated;

class CreateSalaryRequest extends FormRequest
{
    protected function prepareForValidation()
    {

          $payment = ($this->payment == 'on' ? true : false);
        if (!$payment) {
            $this->merge(['payment' => 0]); 
        } else {
            $this->merge(['payment' => 1]); 
        }

          $deduction = ($this->deduction == 'on' ? true : false);
        if (!$deduction) {
            $this->merge(['deduction' => 0]); 
        } else {
            $this->merge(['deduction' => 1]); 
        }
         $loan = ($this->loan == 'on' ? true : false);
        if (!$loan) {
            $this->merge(['loan' => 0]); 
        } else {
            $this->merge(['loan' => 1]); 
        }

       
        
         $begin_calculation = ($this->begin_calculation == 'on' ? true : false);
        if (!$begin_calculation) {
            $this->merge(['begin_calculation' => 0]); // Do not begin Calculation
        } else {
            $this->merge(['begin_calculation' => 1]); // Begin Calculation
        }
        
       
        $start_date_find = strtotime(date("Y-m-d", strtotime($this->payment_date)) . ", first day of this month");
        $start_date = date("Y-m-d",$start_date_find);

        $end_date_find = strtotime(date("Y-m-d", strtotime($this->payment_date)) . ", last day of this month");
        $end_date = date("Y-m-d",$end_date_find);
       

        $this->merge([
            'created_by'             => Auth::user()->id,
            'begin_calculation'             => $begin_calculation,
            'payment'             => $payment,
            'payment_date'             => $this->payment_date,
            'deduction'             => $deduction,
            'started_date'             => $start_date,
            'ended_date'             => $end_date,
            'started_at'             => $start_date,
            'ended_at'             => $end_date,
        ]);
        $this->validate([
            'started_at' => [new CheckIfSalaryIsCreated( $start_date, $end_date)]
        ]);
       
  
        
        if($payment==1){
      $Salaryquery=DB::table('salaries')->count();
      
            $inserts = [];
         
           $query =   DB::table('monthlies')->select('*')
           ->WHERE('transaction_type',1)
           ->whereBetween('started_at',[$start_date,$end_date])
           ->orWhere('is_static',0) 
           ->where('transaction_type',1)
           ->get()
           ;
            foreach($query as $data) {
            $inserts[] = [ 
                'employee_id' => $data->employee_id,
                'monthly_id' => $data->payment_id, 
                'amount' => $data->amount , 
                'started_at' => $start_date , 
                'ended_at' => $end_date,
                'salary_id' => $Salaryquery+1,
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s'), 
                ];
                
        }

        DB::table('employee_monthly_payment')->insert($inserts);
        }
        //inserts new data into standards
        if($begin_calculation==1){
            $Salaryquery=DB::table('salaries')->count();
         
            $inserts = [];
            $query = Payroll::select('employee_id','paye','nhif','nssf','basic_pay')
            ->get();
            foreach($query as $data) {
            $inserts[] = [ 
                'employee_id' => $data->employee_id,
                'basic' => $data->basic_pay , 
                'paye' => $data->paye , 
                'nhif' => $data->nhif , 
                'nssf' => $data->nssf , 
                'started_at' => $start_date , 
                'ended_at' => $end_date,
                'salary_id' => $Salaryquery+1,
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s'), 
                ];
        }

        DB::table('standards')->insert($inserts);
        }
        //end
        if($deduction==1){
           //initialize array
           $Salaryquery=DB::table('salaries')->count();
          
            $inserts = [];
    $query =   DB::table('monthlies')->select('*')
           ->WHERE('transaction_type',0)
           ->whereBetween('started_at',[$start_date,$end_date])
           ->orWhere('is_static',0) 
           ->where('transaction_type',0)
           ->get()
           ;
            foreach($query as $data) {
            $inserts[] = [ 
                'employee_id' => $data->employee_id,
                'monthly_id' => $data->payment_id, 
                'amount' => $data->amount , 
                'started_at' => $start_date , 
                'ended_at' => $end_date,
                'salary_id' => $Salaryquery+1,
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s'), 
                ];
        }
        DB::table('employee_monthly_deduction')->insert($inserts);
        }

         if($loan ==1){
           //initialize array
           $Salaryquery=DB::table('salaries')->count();
          
            $inserts = [];
            $query = Loan::where('loan_balance', '>', 0)
            ->select('id','description','employee_id','loan_balance','pmt')
            ->get();
            foreach($query as $data) {
            $inserts[] = [ 
                'loan_id' => $data->id,
                'description' => $data->description,
                'employee_id' => $data->employee_id,
                'balance' => $data->loan_balance, 
                'pmt' => $data->pmt , 
                'started_at' => $start_date , 
                'ended_at' => $end_date,
                'created_by' => Auth::user()->id,
                'salary_id' => $Salaryquery+1,
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s'), 
                ];
            $updates =[
                'loan_balance' => $data->loan_balance- $data->pmt
            ];
                           
        DB::table('loans')->where('id',$data->id)->update($updates);
                 
        }
        DB::table('loan_transaction')->insert($inserts);

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
        return Salary::$rules;
    }
}
