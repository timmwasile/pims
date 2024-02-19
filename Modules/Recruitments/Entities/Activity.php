<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Entities\Admin;

class Activity extends Model
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public $table = 'activities';
    
   public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'description',
        'created_by',
        'budget',
        'utilised',
        'balance',
        'fyear_id'
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'name'       => 'string',
        'description'       => 'string',
        'budget'       => 'double',
        'utilised'       => 'double',
        'balance'       => 'double',
        
    ];

     public static $rules = [
        'created_by'  => 'required|integer',
        'name'       => 'required|string|max:60',
        'description'       => 'string|max:120',
        'budget'       => 'required',
    ];

   protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function createdBy(){
        return $this->belongsTo(Admin::class, 'created_by');
    }

     public function Fyear(){
        return $this->belongsTo(Fyear::class, 'fyear_id');
    }
}
