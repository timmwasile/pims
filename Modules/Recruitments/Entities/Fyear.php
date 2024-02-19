<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Entities\Admin;

class Fyear extends Model
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public $table = 'fyears';
    
   public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'created_by',
        'started_at',
        'ended_at',
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'name'       => 'string',
        
    ];

     public static $rules = [
        'created_by'  => 'required|integer',
        'name'       => 'required|unique:payments|string|max:24',
        'started_at'       => 'required',
        'ended_at'  => 'required',
    ];

   protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function createdBy(){
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
