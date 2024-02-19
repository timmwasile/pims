<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\MarketingOfficer;

/**
 * Class MarketingOfficerRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class MarketingOfficerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'description',
        'nida',
        'mobile',
        'created_by',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return MarketingOfficer::class;
    }
}
