<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Payroll;
use Modules\Recruitments\Entities\Payslip;

/**
 * Class PaymentRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class PayslipRepository extends BaseRepository
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
        return Payroll::class;
    }
}
