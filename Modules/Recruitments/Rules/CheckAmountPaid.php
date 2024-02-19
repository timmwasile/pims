<?php

namespace Modules\Recruitments\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Recruitments\Entities\Loan;

class CheckAmountPaid implements Rule
{
    protected $loan_id;
    protected $amount;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($amount, $loan_id)
    {
        $this->loan_id = $loan_id;
        $this->amount = $amount;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value > $this->amount ? true: false;
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */

    public function message()
    {
        return "The remaining Balance is less than amount to be paid " .number_format($this->amount,2). " Please verify" ;
    }
}