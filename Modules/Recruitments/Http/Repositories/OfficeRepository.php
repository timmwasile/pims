<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Office;

/**
 * Class OfficeRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class OfficeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'created_by',
        'name',
        'description'
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
        return Office::class;
    }
}
