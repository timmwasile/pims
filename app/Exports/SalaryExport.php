<?php

namespace App\Exports;

use App\Models\Salary;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Hrms\Entities\Employee;
use Modules\Recruitments\Entities\Employee_Monthly_Deduction;
use Modules\Recruitments\Entities\Employee_Monthly_Payment;
use Modules\Recruitments\Entities\Loan_Transaction;
use Modules\Recruitments\Entities\Salary as EntitiesSalary;
use Modules\Recruitments\Entities\Standard;

class SalaryExport implements FromCollection, WithHeadings
{
    protected $data;
    /**
    * @return \Illuminate\Support\Collection
    */
public function __construct($data){
    $this->data = $data;
}  

    public function collection()
    {
        return collect($this->data);
     
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["id", "name","amount","bank_account","bank_name","payment_date"];
        // return ["ID", "Name", "Email"];
    }
}
