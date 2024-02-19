<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Modules\Admins\Entities\AuditLog as EntitiesAuditLog;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function (Model $model) {
            self::audit('audit:created', $model, $model);
        });

        static::updated(function (Model $model) {
            $model->attributes = array_merge($model->getChanges(), ['id' => $model->id]);

            $original_data = $model->getOriginal();

            self::audit('audit:updated', $model, $original_data);
        });

        static::deleted(function (Model $model) {
            self::audit('audit:deleted', $model, $model);
        });
    }

    protected static function audit($description, $model, $original_data)
    {
        EntitiesAuditLog::create([
            'description'         => $description,
            'subject_id'          => $model->id ?? null,
            'subject_type'        => sprintf('%s#%s', get_class($model), $model->id) ?? null,
            'company_id'          => auth()->user()->company_id ?? null,
            'user_id'             => auth()->id() ?? null,
            'properties'          => $model ?? null,
            'original_properties' => $original_data ?? null,
            'host'                => request()->ip() ?? null,
        ]);
    }
}
