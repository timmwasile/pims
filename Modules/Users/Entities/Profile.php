<?php

namespace Modules\Users\Entities;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Profile extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens,  Notifiable;
    public $table = 'profiles';


    protected $fillable = [
        'address',
        'country',
        'dob',
        'facebook_url',
        'job_title',
        'linkedin_url',
        'nin',
        'phone_no',
        'photo',
        'twitter_url',
        'user_id',
        'website',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public static $rules = [
        'user_id'                    => 'required|exists:users,id|integer',
        'address'                    => 'nullable|string|max:120|min:2',
        'country'                    => 'required|string|max:60|min:2',
        'dob'                           => 'nullable|date',
        'job_title'                    => 'nullable|string|max:120|min:2',
        'facebook_url'                    => 'nullable|string|max:120|min:2',
        'linkedin_url'                    => 'nullable|string|max:120|min:2',
        'twitter_url'                    => 'nullable|string|max:120|min:2',
        'website'                    => 'nullable|string|max:120|min:2',
        'phone_no'                    => 'nullable|size:12|numeric|min:12',
        'nin'                    => 'required|max:23|text|min:20',
        'photo'                    => 'nullable|image|mimes:jpeg,png|size:1024',
    ];
    protected static function newFactory()
    {
        return \Modules\Users\Database\factories\ProfileFactory::new();
    }
}
