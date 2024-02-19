<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Bankfile;
use Modules\Recruitments\Entities\Payroll;

/**
 * Class BankfileRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class BankfileRepository extends BaseRepository
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
