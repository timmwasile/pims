<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Salary;

/**
 * Class PaymentRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class SalaryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Salary::class;
    }
}
