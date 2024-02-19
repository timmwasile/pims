<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Payroll;

/**
 * Class PayrollRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class PayrollRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'created_by',
        'basic_pay',
        'paye',
        'net_pay',
        'nssf',
        'nhif',
       
        'employee_id'
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
