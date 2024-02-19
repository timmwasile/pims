<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Monthly;

/**
 * Class MonthlyRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class MonthlyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'employee_id',
        'payment_id',
        'amount',
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
        return Monthly::class;
    }
}
