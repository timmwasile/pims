<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Entities\Admin;

class Employee extends Model
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public $table = 'employees';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'number',
        'dob',
        'employment_date',
        'email',
        'jobtitle_id',
        'office_id',
        'basic_salary',
        'phone_no',
        'bank_id',
        'bank_account',
        'gender_id',
        'created_by',
        'status_id'
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'office_id'  => 'integer',
        'basic_salary'  => 'float',
        'jobtitle_id'  => 'integer',
        'gender_id'  => 'integer',
        'bank_id'  => 'integer',
        'name'       => 'string',
    ];

     public static $rules = [
        'created_by'  => 'nullable',
        'dob'  => 'required',
        'employment_date'=>'required',
        'basic_salary'=>'required',
        'office_id'  => 'required',
        'bank_id'  => 'required',
        'jobtitle_id'  => 'required',
        'gender_id'  => 'required',
        'bank_account'       => 'required|unique:employees,bank_account|string|max:30',
        'name'       => 'required|unique:employees,name|string|max:120',
        'email'       => 'required|unique:employees,email|string|max:30',
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
    
     public function OfficeName(){
        return $this->belongsTo(Office::class, 'office_id');
    }
     public function BankName(){
        return $this->belongsTo(Bank::class, 'bank_id');
    }
     public function GenderName(){
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function JobtitleName(){
        return $this->belongsTo(JobTitle::class, 'jobtitle_id');
    }
}
