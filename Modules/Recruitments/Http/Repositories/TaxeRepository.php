<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Taxe;

/**
 * Class TaxeRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class TaxeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'created_by',
        'rate',
        'max_amount',
        'min_amount'
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
        return Taxe::class;
    }
}
