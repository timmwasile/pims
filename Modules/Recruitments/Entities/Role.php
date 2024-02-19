<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class role.
 *
 * @version June 22, 2022, 4:58 pm UTC
 *
 * @property int    $created_by
 * @property string $title
 * @property string $description
 */
class Role extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'roles';

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $fillable = [
        'title'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'title'  => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'title'  => 'required|string|max:120',
        'created_at'  => 'nullable',
        'updated_at'  => 'nullable',
        'deleted_at'  => 'nullable',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function permissions()
    {
        return $this->belongsToMany('Modules\Recruitments\Entities\Permission');
    }
}
