<?php

namespace Modules\Admins\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    public $table = 'licenses';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'created_by',
        'started_at',
        'ended_at',
        'status_id',
        'license_key',

    ];
    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'license_key'     => 'nullable|string|min:3|max:50',
        'ended_at'     => 'required',
        'started_at'     => 'required',
        
    ];

     public function companyId(){
        return $this->belongsTo(Company::class, 'company_id');
    }
}
