<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Permission;

/**
 * Class PermissionRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class PermissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'
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
        return Permission::class;
    }
}
