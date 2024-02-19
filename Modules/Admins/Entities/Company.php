<?php

namespace Modules\Admins\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Company extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    use InteractsWithMedia;

    public $table = 'companies';

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
        'name',
        'description',
        'owner',
        'contact_person',
        'phone_no',
        'email',
        'location',

    ];
    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name'              => 'required|string|min:3|max:50',
        'description'       => 'nullable|string|min:3|max:50',
        'location'          => 'nullable|string|min:3|max:50',
        'email'             => 'nullable|string|min:3|max:50',
        'owner'             => 'nullable|string|min:3|max:50',
        'contact_person'    => 'nullable|string|min:3|max:50',
        'logo'              =>   'nullable|file|mimes:jpeg,jpg,png',

    ];
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaCollection('logo');
    }

    public function getPermitsAttribute()
    {
        return $this->getMedia('logo');
    }
}
