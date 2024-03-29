<?php

namespace Modules\Admins\Http\Repositories;

use Modules\Admins\Entities\Admin;

/**
 * Class AdminRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class AdminRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'username',
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
        return Admin::class;
    }
}
