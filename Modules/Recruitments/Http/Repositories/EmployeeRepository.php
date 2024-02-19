<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Employee;

/**
 * Class EmployeeRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class EmployeeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'created_by',
        'title',
        'description',
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
        return Employee::class;
    }
}
