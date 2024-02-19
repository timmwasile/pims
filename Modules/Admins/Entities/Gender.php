<?php

namespace Modules\Admins\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    // protected string $guard = 'admin';
    public $table = 'genders';

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
        'title'

    ];







    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'title'     => 'required|string|min:3|max:50'

    ];
}
