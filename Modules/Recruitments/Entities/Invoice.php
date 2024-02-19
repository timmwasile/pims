<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
      use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;
    public $table = 'invoices';
    public const CREATED_AT = 'created_at'; 
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'description',
        'customer_name',
        'payment_method',
        'invoice_no',
        'invoice_date',
        'derivered_date',
        'amount',
        'created_by',
        
    ];
      protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'description'       => 'string',
        'amount'       => 'double',
        'invoice_no'       => 'string',
    ];
    public static $rules = [
        'created_by'  => 'required',
        'customer_name'       => 'required|string|max:120',
        'description'       => 'required|string|max:120',
        'amount'       => 'required',
        'invoice_no'       => 'required',
        'invoice_date'  => 'nullable',
        'derivered_date'  => 'nullable',
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
  
}
