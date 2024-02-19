<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Entities\Company;

class Payment extends Model
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public $table = 'payments';
    
   public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'company_id',
        'description',
        'discount',
        'created_by',
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'name'       => 'string',
        'discount'       => 'integer',
        'description'       => 'string',
        
    ];

//     $module_id = $request->get('module_id');
//  $rules = [
//      'name' => 'unique:tags,name,NULL,id,modul_id,'.$module_id
//  ]

     public static $rules = [
        'created_by'  => 'required|integer',
        'name'       => 'required|string|max:24',
        'description'       => 'required|string|max:120',
        'discount'       => 'required|integer',
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
     public function companyId(){
        return $this->belongsTo(Company::class, 'created_by');
    }
}
