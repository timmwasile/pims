<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admins\Entities\Admin;

/**
 * Class jobtitle.
 *
 * @version June 22, 2022, 4:58 pm UTC
 *
 * @property int    $created_by
 * @property string $name
 * @property string $description
 */
class JobTitle extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'jobtitles';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $fillable = [
        'name',
        'description',
        'created_by'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'name'  => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name'  => 'required|string|max:120',
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
