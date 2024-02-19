<?php

namespace Modules\Users\Entities;

use App\Traits\Auditable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSkill extends Model
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;
    // use Auditable;

    public $table = 'user_skills';

    protected $dates =[
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'user_id'
    ];

    public static $rules =[
        'user_id'                    => 'required|exists:users,id|integer',
        'title'                      => 'nullable|string|max:255|min:2',
    ];

    protected static function newFactory()
    {
        return \Modules\Users\Database\factories\UserSkillFactory::new();
    }
}

