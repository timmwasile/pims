<?php

namespace Modules\Admins\Entities;

use App\Traits\Auditable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Database\factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;
    use Notifiable;

    // protected string $guard = 'admin';
    public $table = 'admins';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'deactivated_at',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'company_id',
        'email',
        'username',
        'password',
        'phone_no',
        'remember_token',
        'created_at',
        'updated_at',
        'deactivated_at',
        'deactivated_by',
        'deactivated_reason',
    ];

    protected static function newFactory()
    {
        return AdminFactory::new();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deactivated_at' => 'datetime',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name'     => 'required|string',
        'email'    => 'required|email',
        'phone_no' => 'required|string',

        'roles.*' => [
            'integer',
        ],
        'roles' => [
            'required',
            'array',
        ],
    ];

    public function roles()
    {
        return $this->belongsToMany('Modules\Recruitments\Entities\Role')->withTimestamps();
    }
    public function genderId(){
        return $this->belongsTo(Gender::class, 'gender_id');
    }
     public function companyId(){
        return $this->belongsTo(Company::class, 'company_id');
    }
}
