<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Farm;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Project;

/**
 * Class PaymentRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class FarmRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'size',
        'location',
        'created_by',
        'started_at',
        'ended_at'
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
        return Farm::class;
    }
}
