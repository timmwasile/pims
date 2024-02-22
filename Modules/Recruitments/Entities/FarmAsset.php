<?php

namespace Modules\Recruitments\Entities;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Entities\Company;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FarmAsset extends Model implements HasMedia
{
    use HasFactory;
    use Auditable;
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    public $table = 'farm_assets';

      protected $appends = [
        'permits',
    ];


    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'number',
        'company_id',
        'map_number',
        'customer_id',
        'payment_id',
        'project_id',
        'marketing_officer_id',
        'description',
        'size',
        'to_be_paid_amount',
        'total_amount',
        'paid_amount',
        'balance',
        'duration',
        'created_by',
        'status_id',
        'started_at',
        'ended_at',
        'penalty',
        'month_remaining',
        'mpa',
    ];
     protected $casts = [
        'id'          => 'integer',
        'created_by'  => 'integer',
        'customer_id'  => 'integer',
        'payment_id'  => 'integer',
        'payment_id'  => 'integer',
        'total_amount'       => 'double',
        'paid_amount'       => 'double',
        'balance'       => 'double',
        'mpa'       => 'double',
    ];

     public static $rules = [
        'created_by'  => 'nullable',
        'description'       => 'nullable|string|max:120',
        'to_be_paid_amount'       => 'required',
        'total_amount'       => 'nullable',
        'paid_amount'       => 'required',
        'map_number'       => 'required',
        'balance'       => 'required',
        'mpa'       => 'nullable',
        'duration'       => 'nullable|between:0,99.99',
        'month_remaining'       => 'nullable|between:0,99.99',
        'started_at'  => 'nullable',
        'ended_at'  => 'nullable',
        'created_at'  => 'nullable',
        'updated_at'  => 'nullable',
        'deleted_at'  => 'nullable',
        'permits.*' => 'nullable',

    ];

public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPermitsAttribute()
    {
        return $this->getMedia('permits');
    }



   protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function customerId(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function farmId(){
        return $this->belongsTo(Farm::class, 'farm_id');
    }
     public function paymentId(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
     public function createdBy(){
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function marketingOfficerId(){
        return $this->belongsTo(MarketingOfficer::class, 'marketing_officer_id');
    }
     public function companyId(){
        return $this->belongsTo(Company::class, 'company_id');
    }
}
