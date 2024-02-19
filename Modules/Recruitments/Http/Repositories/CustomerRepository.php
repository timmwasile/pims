<?php

namespace Modules\Recruitments\Http\Repositories;

use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Customer;

/**
 * Class PaymentRepository.
 *
 * @version June 22, 2022, 4:58 pm UTC
 */
class CustomerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'description',
        'nida',
        'mobile',
        'created_by',
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
        return Customer::class;
    }
}
