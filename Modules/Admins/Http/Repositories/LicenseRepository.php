<?php

namespace Modules\Admins\Http\Repositories;

use Modules\Admins\Entities\License;

/**
 * Class LicenseRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class LicenseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'started_at',
        'ended_at',
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
        return License::class;
    }
}
