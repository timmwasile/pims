<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan_Transaction extends Model
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public $table = 'loan_transaction';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'loan_amount',
        'description',
        'loan_balance',
        'employee_id',
        'deduction_amount',
        'rate',
        'duration',
        'created_by',
        'status_id',
        'salary_id',
        'started_at',
        'ended_at',
        'salary_id',
        'pmt',
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'amount'       => 'double',
        'deduction_amount'       => 'double',
        'pmt'       => 'double',
    ];

     public static $rules = [
        'created_by'  => 'nullable',
        'description'       => 'required|string|max:120',
        'loan_amount'       => 'required',
        'duration'       => 'required|between:0,99.99',
        'started_at'  => 'nullable',
        'ended_at'  => 'nullable',
        'created_at'  => 'nullable',
        'updated_at'  => 'nullable',
        'deleted_at'  => 'nullable',
    ];

   protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function employeeId(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
