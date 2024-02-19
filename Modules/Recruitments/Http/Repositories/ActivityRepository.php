<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Activity;
use Modules\Recruitments\Entities\Activityfile;
use Modules\Recruitments\Entities\Payroll;

/**
 * Class ActivityfileRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class ActivityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'created_by',
        'name',
        'budget',
        'balance',
        'utilised',

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
        return Activity::class;
    }
}
