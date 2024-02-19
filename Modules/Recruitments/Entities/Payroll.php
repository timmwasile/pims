<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public $table = 'payrolls';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'basic_pay',
        'description',
        'nssf',
        'employee_id',
        'net_pay',
        'nhif',
        'paye',
        'created_by',
        'status_id',
        'started_at',
        'ended_at',
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'employee_id'  => 'integer',
        'paye'       => 'double',
        'nhif'       => 'double',
        'nssf'       => 'double',
        'basic_pay'       => 'double',
        'net_pay'       => 'double',
    ];

     public static $rules = [
        'created_by'  => 'nullable',
        'employee_id'  => 'required',
        'description'       => 'required|string|max:120',
        'basic_pay'       => 'required',
        'nhif'       => 'required',
        'nssf'       => 'required',
        'net_pay'       => 'required',
        'paye'       => 'required',
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
