<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Entities\Admin;

class Monthly extends Model
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public $table = 'monthlies';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'employee_id',
        'payment_id',
        'created_by',
        'is_static',
        'transaction_type',
        'amount',
        'started_at',
        'ended_at'
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'employee_id'  => 'integer',
        'payment_id'  => 'integer',
        'amount'       => 'double',
    ];

     public static $rules = [
        'created_by'  => 'nullable',
        'employee_id'       => 'required|integer',
        'payment_id'       => 'required|integer',
        'amount'       => 'required',
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

    public function paymentId(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }

      public function createdBy(){
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
