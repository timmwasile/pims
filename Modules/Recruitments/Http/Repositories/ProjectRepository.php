<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Project;

/**
 * Class PaymentRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class ProjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'size',
        'location',
        'number_of_plots',
        'code',
        'initial',
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
        return Project::class;
    }
}
