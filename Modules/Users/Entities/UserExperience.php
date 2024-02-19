<?php

namespace Modules\Users\Entities;

use App\Traits\Auditable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserExperience extends Model
{
    use HasFactory;
    // use Auditable;
    use HasApiTokens;
    use SoftDeletes;
    use Notifiable;

    public $table       = 'user_experiences';

    protected $fillable = [
        'user_id',
        'title',
        'company_name',
        'started_at',
        'ended_at',
    ];

    protected $dates =[
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $rules =[
        'user_id'                          => 'required|exists:users,id|integer',
        'title'                            => 'required|string|max:255|min:3',
        'company_name'                     => 'required|string|max:255|min:3',
        'ended_at'                         => 'nullable|date',
        'endend_at'                        => 'nullable|date',
        'started_at'                       => 'nullable|date',
    ];

    protected static function newFactory()
    {
        return \Modules\Users\Database\factories\UserExperienceFactory::new();
    }
}

