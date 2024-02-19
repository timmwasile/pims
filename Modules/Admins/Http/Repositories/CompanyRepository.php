<?php

namespace Modules\Admins\Http\Repositories;

use Modules\Admins\Entities\Company;

/**
 * Class CompanyRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class CompanyRepository extends BaseRepository
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
        return Company::class;
    }
}
