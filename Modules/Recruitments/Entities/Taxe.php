<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxe extends Model
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    public $table = 'taxes';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'rate',
        'max_amout',
        'min_amount',
        'description',
        'created_by',
        'status_id',
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'max_amount'       => 'double',
        'min_amount'       => 'double',
        'description'       => 'string',
        
    ];

     public static $rules = [
        'created_by'  => 'required|integer',
        'description'       => 'required|string|max:120',
        'max_amount'       => 'required',
        'min_amount'       => 'required',
        'rate'       => 'required',
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
