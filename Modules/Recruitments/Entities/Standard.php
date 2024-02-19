<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Entities\Admin;

class Standard extends Model
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public $table = 'standards';
    
   public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'amount',
        'salary_id',
        'employee_id',
        'standard_type',
        'created_by',
        'salary_id',
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        
    ];

     public static $rules = [
        'created_by'  => 'required|integer',
        'name'  => 'nullable',
        'standard_type'  => 'nullable',
        'amount'  => 'nullable',
        'created_at'  => 'nullable',
        'updated_at'  => 'nullable',
        'deleted_at'  => 'nullable',
    ];

   protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function createdBy(){
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function payMent()
    {
        return $this->belongsTo(Payment::class, 'monthly_id');
    }

    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
