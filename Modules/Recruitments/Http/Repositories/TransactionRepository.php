<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Transaction;

/**
 * Class ActivityfileRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'created_by',
        'name',
        'number',
        'payment_date',
        'reference',

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
        return Transaction::class;
    }
}
