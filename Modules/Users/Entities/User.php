<?php

namespace Modules\Users\Entities;

use App\Traits\Auditable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use Auditable;
    use HasFactory;
    use Notifiable;
    use softDeletes;

    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email_verified_at',
        'email',
        'remember_token',
        'password',
        'created_at',
        'updated_at',
        'disabled_at',
        'disabled_by',
        'disabled_reason',
        'is_admin',
    ];

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
        'email_verified_at' => 'datetime',
    ];
    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name'     => 'required|string|min:3|max:50',
        'username' => 'require|string|unique:users,username',
        'email'    => 'required|email|unique:users,email',
        'password' => [
            'required',
            'min:8',
            'regex:/^.(?=.{3,})(?=.[a-zA-Z])(?=.[0-9])(?=.[\d\x])(?=.[!$#%]).$/',
        ],
        'disabled_by'     => 'required|integer|exists:users,id',
        'disabled_reason' => 'nullable|text',
        'is_admin'        => 'nullable|boolean',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'disabled_at',
    ];
}
