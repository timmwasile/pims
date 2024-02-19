<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Entities\Company;

class Project extends Model
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public $table = 'projects';
    
   public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'location',
        'description',
        'size',
        'amount',
        'initial',
        'number_of_plots',
        'code',
        'created_by',
        'company_id',
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'amount'       => 'double',

        
    ];

     public static $rules = [
        'name'  => 'required|string',
        'location'  => 'string',
        'description'  => 'string',
        'initial'  => 'required|string',
        'amount'  => 'nullable',
        'number_of_plots'  => 'string',
        'code'  => 'string',
        'created_by'  => 'required|integer',
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

    public function plotTotal(){
        return $this->belongsTo(Plot::class, 'size');
    }
     public function companyId(){
        return $this->belongsTo(Company::class, 'company_id');
    }
}
