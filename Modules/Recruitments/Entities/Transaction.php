<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Entities\Company;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Transaction extends Model  implements HasMedia
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    public $table = 'transactions';
    
   public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'number',
        'company_id',
        'file_name',
        'customer',
        'plot',
        'project',
        'description',
        'created_by',
        'amount',
        'plot_id',
        'customer_id',
        'project_id',
        'reference',
        'payment_date',
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'customer_id'  => 'integer',
        'project_id'  => 'integer',
        'plot_id'  => 'integer',
        'reference'       => 'string',
        'description'       => 'string',
        'amount'       => 'double',
        
    ];

     public static $rules = [
        'created_by'  => 'required|integer',
        'description'       => 'required|string|max:180',
        'reference'       => 'required|string|max:60',
        'number'       => 'nullable',
        'payment_date'       => 'nullable',
        'amount'       => 'required',
        'plot_id'       => 'required',
    ];

   protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function createdBy(){
        return $this->belongsTo(Admin::class, 'created_by');
    }

     public function customerId(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function plotId(){
        return $this->belongsTo(Plot::class, 'plot_id');
    }
      public function projectId(){
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function companyId(){
        return $this->belongsTo(Company::class, 'company_id');
    }

     public function getFileNameAttribute()
    {
        return $this->getMedia('file_name');
    }

}
