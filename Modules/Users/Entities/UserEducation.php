<?php

namespace Modules\Users\Entities;

use App\Traits\Auditable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserEducation extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;
    // use Auditable;

    public $table = 'user_educations';

    protected $fillable = [
        'user_id',
        'education_level_id',
        'started_at',
        'ended_at',
        'country',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $rules = [
        'user_id'                    => 'required|exists:users,id|integer',
        'education_level_id'         => 'required|exists:education_levels,id|integer',
        'country'                    => 'nullable|string|max:255|min:2',
        'ended_at'                  => 'nullable|date',
        'started_at'                 => 'nullable|date',
    ];

    protected static function newFactory()
    {
        return \Modules\Users\Database\factories\UserEducationFactory::new();
    }
}
