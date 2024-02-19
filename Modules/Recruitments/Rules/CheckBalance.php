<?php

namespace Modules\Recruitments\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Recruitments\Entities\Loan;

class CheckBalance implements Rule
{
    protected $activity_id;
    protected $balance;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($balance, $activity_id)
    {
        $this->activity_id = $activity_id;
        $this->balance = $balance;

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
        return $value <= $this->balance ? true: false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */

    public function message()
    {
        return "The amount to be expensed exceed the remaining Balance of " .number_format($this->balance,2). " Please verify" ;
    }
}