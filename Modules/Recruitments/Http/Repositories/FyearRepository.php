<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Fyear;
use Modules\Recruitments\Entities\Fyearfile;
use Modules\Recruitments\Entities\Payroll;

/**
 * Class FyearfileRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class FyearRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'created_by',
        'name',
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
        return Fyear::class;
    }
}
