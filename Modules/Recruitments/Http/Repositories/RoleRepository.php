<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Role;

/**
 * Class RoleRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class RoleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
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
        return Role::class;
    }
}
